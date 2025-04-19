<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdertController extends Controller
{
    public function index() {
        return view('admin.order.index');
    }
    
    public function order_detail() {
        return view('admin.order.order-detail');
    }
}
