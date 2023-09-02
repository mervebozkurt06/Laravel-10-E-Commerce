<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Role;
use App\Models\User;
use App\Notifications\ProductCreatedNotification;
use Exception;
use Faker\Core\File;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    private $roleManager;

    public function __construct()
    {
        $roleManager = Role::manager();
        $this->roleManager = $roleManager;
    }

    public function index()
    {
        $products = Product::all();

        return view('product.index', [
            'products' => $products,
            'roleManager' => $this->roleManager
        ]);

    }

    public function create()
    {
        $this->authorize('create', $this->roleManager);

        try {
            $categories = Category::all();
        } catch (ModelNotFoundException $exception) {
            return back()->withError('Product create page could not open')->withInput();
        }

        return view('product.create', [
            'categories' => $categories
        ]);
    }


    public function store(StoreProductRequest $request)
    {
        $this->authorize('create', $this->roleManager);

        DB::beginTransaction();
        try {
            $data = new Product();
            $data->name = $request->input('name');
            $data->category_id = $request->input('category_id');
            $data->description = $request->input('description');
            $data->price = intval($request->input('price'));
            $data->image = Storage::putFile('images', $request->file('image'));
            $data->save();
            DB::commit();


            $users = User::where('role_id', '=', $this->roleManager->id)
                ->where('id', '!=', \auth()->id())
                ->whereNull('deleted_at')
                ->get();
            Notification::send($users, new ProductCreatedNotification($data->name, Auth::user()->name));


        } catch (ModelNotFoundException $exception) {
            return back()->withError('Product could not stored')->withInput();
        }

        return redirect()->route('product')
            ->with('success', 'Product created successfully.');
    }


    public function edit(Product $product, $id)
    {
        $this->authorize('update', $this->roleManager);

        try {
            $categories = Category::all();
            $product = Product::find($id);
        } catch (ModelNotFoundException $exception) {
            return back()->withError('Product edit page could not open')->withInput();
        }
        return view('product.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }


    public function update(StoreProductRequest $request, Product $product, $id)
    {
        $this->authorize('update', $this->roleManager);

        DB::beginTransaction();
        try {
            $data = Product::find($id);
            $data->name = $request->input('name');
            $data->category_id = $request->input('category_id');
            $data->description = $request->input('description');
            $data->price = intval($request->input('price'));
            if ($request->hasFile('image')) {
                Storage::delete('/' . $data->image);
                $data->image = Storage::putFile('images', ($request->file('image')));
            }
            $data->update();
            DB::commit();
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            return back()->withError('Product could not updated')->withInput();
        }


        return redirect()->route('product')->with('success', 'Product Has Been updated successfully');
    }


    public function destroy(Product $product, $id)
    {
        $this->authorize('delete', $this->roleManager);

        DB::beginTransaction();
        try {
            // Is the product available any cart?
            $carts = Cart::where('product_id', $id)->get();
            if ($carts->count() > 0) {
                throw new Exception('Product can not delete when cart has that product already!');
            }

            $product = Product::find($id);
            Storage::delete('/' . $product->image);
            $product->delete();
            DB::commit();

        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            return back()->withError('Product could not deleted')->withInput();
        }

        return redirect()->route('product')
            ->with('success', 'Product deleted successfully');
    }


}
