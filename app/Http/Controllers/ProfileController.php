<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        return view('user.profile.index', compact('user'));
    }

    // public function cancel($orderId)
    // {
    //     try {
    //         // Mencari order berdasarkan ID
    //         $order = Order::findOrFail($orderId);

    //         // Cek apakah status order adalah 'pending'
    //         if ($order->status !== 'pending') {
    //             return redirect()->back()->with('error', 'Only pending orders can be canceled.');
    //         }

    //         // Mengubah status order menjadi 'canceled'
    //         $order->status = 'canceled';
    //         $order->save();

    //         // Mengarahkan kembali dengan pesan sukses
    //         return redirect()->back()->with('success', 'Order has been canceled.');
    //     } catch (\Exception $e) {
    //         // Jika terjadi error, kembalikan pesan error
    //         return redirect()->back()->with('error', 'An error occurred while canceling the order: ' . $e->getMessage());
    //     }
    // }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
