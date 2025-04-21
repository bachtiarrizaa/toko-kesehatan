<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // try {
        //     if (auth()->user()->role == 'admin') {
        //         $feedbacks = Feedback::with(['user', 'product'])->latest()->get();
        //         return view('admin.feedback.index', compact('feedbacks'));
        //     } else {
        //         $feedbacks = Feedback::with('product')
        //             ->where('user_id', auth()->id())
        //             ->latest()
        //             ->get();
        //         return view('user.product.feedback', compact('feedbacks'));
        //     }
        // } catch (\Exception $e) {
        //     // Bisa diarahkan ke halaman error atau tampilkan pesan flash
        //     return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        // }
    }

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
        // dd($request->all()); 
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        Feedback::create([
            'user_id' => Auth::id(),
            'order_id' => $request->order_id,
            'message' => $request->message,
            'rating' => $request->rating,
        ]);

        return redirect()->back()->with('success', 'Ulasan berhasil dikirim!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Feedback $feedback)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feedback $feedback)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        //
    }
}
