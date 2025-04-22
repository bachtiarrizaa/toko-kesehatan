<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Feedback;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $users = User::all();
        $totalUsers = $users->count();
    
        $category = Category::all();
        $totalCategory = $category->count();
    
        $product = Product::all();
        $totalProduct = $product->count();
    
        $order = Order::all();
        $totalOrder = $order->count();

        $feedback = Feedback::all();
        $totalFeedback = $feedback->count();
    
        $totalRevenue = Order::where('status', 'accepted')->sum('total_price');
    
        return view('admin.index', compact('users', 'totalUsers', 'totalCategory', 'totalProduct', 'totalOrder', 'totalRevenue', 'totalFeedback'));
    }    

    public function userView() {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }
}
