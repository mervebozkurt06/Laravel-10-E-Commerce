<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();


        return redirect()->back();
    }

    public function markOneAsRead($id = null)
    {

        DB::table('notifications')->where('id', '=', $id)->update(['read_at' => Carbon::now()]);


        return redirect()->back();
    }


}
