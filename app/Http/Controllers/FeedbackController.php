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
        $feedbacks = Feedback::with(['order', 'user'])->get();
        return view('admin.feedback.index', compact('feedbacks'));
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
        return view('admin.feedback', compact('feedback'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedback $feedback)
    {
        $request->validate([
            'message' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $feedback->update([
            'message' => $request->message,
            'rating' => $request->rating,
        ]);

        return redirect()->route('admin.feedback')->with('success', 'Feedback updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedback $feedback)
    {
        try {
            $feedback->delete();

            return redirect()->route('admin.feedback.index')->with('success', 'Category successfully deleted');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}
