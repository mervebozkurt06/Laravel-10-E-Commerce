<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Mail\CategoryCreated;
use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Notifications\CategoryCreatedNotification;
use App\Notifications\ProductCreatedNotification;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class CategoryController extends Controller
{
    private $roleManager;

    public function __construct()
    {
        $roleManager = Role::manager();
        $this->roleManager = $roleManager;
    }

    public function index()
    {

        $categories = Category::all();

        return view('category.index', [
            'categories' => $categories,
            'roleManager' => $this->roleManager
        ]);

    }

    public function show(string $id)
    {
        $category = Category::find($id);
        $datalist = Product::where('category_id', $id)->get();
        return view('category.product_list', [
            'datalist' => $datalist,
            'category' => $category
        ]);
    }


    public function create()
    {
        $this->authorize('update', $this->roleManager);
        return view('category.create');
    }


    public function store(StoreCategoryRequest $request)
    {
        $this->authorize('create', $this->roleManager);

        DB::beginTransaction();
        try {
            $input = $request->all();
            $category = Category::create($input);
            DB::commit();

            $users = User::where('role_id', '=', $this->roleManager->id)
                ->where('id', '!=', \auth()->id())
                ->whereNull('deleted_at')
                ->get();

            //Notification::send($users, new CategoryCreatedNotification($category->name, Auth::user()->name));
            Mail::to($users)->queue(new CategoryCreated(Auth::user()->name, $category->name));

        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            return back()->withError('Category could not stored')->withInput();
        }

        return redirect()->route('category')->with('success', 'Category created successfully.');
    }


    public function edit(Category $category, $id)
    {
        $this->authorize('update', $this->roleManager);
        try {
            $category = Category::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            return back()->withError('Category not found by Id: ' . $id)->withInput();
        }

        return view('category.edit', [
            'category' => $category
        ]);
    }


    public function update(StoreCategoryRequest $request, Category $category, $id)
    {

        $this->authorize('update', $this->roleManager());

        DB::beginTransaction();
        try {
            $data = Category::findOrFail($id);
            $data->name = $request->input('name');
            $data->update();
            DB::commit();
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            return back()->withError('Category could not updated')->withInput();
        }

        return redirect()->route('category')->with('success', 'Category Has Been updated successfully');

    }


    public function destroy(Category $category, $id)
    {
        $this->authorize('delete', $this->roleManager);

        DB::beginTransaction();
        try {
            $category = Category::find($id);
            $category->delete();
            DB::commit();
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            return back()->withError('Category could not deleted')->withInput();
        }

        return redirect()->route('category')
            ->with('success', 'Category deleted successfully');
    }
}
