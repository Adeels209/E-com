<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Analytics;
use Spatie\Analytics\Period;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function markAsRead()
    {
        Auth::guard('admin')->user()->notifications->markAsRead();
        $count = Auth::guard('admin')->user()->unreadNotifications->count();
        return response()->json(['status'=>200, 'count'=>$count]);
    }

    public function index()
    {
        return view('admin::index');
    }

}
