<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

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
        try {
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'message' => 'required|string',
                'rating' => 'required|integer|min:1|max:5',
            ]);
    
            Feedback::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'message' => $request->message,
                'rating' => $request->rating,
            ]);
    
            return back()->with('success', 'Feedback berhasil dikirim!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menyimpan feedback: ' . $e->getMessage());
        }
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
