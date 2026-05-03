<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function index()
    {
        // Check if admin is accessing
        if (auth()->check() && auth()->user()->is_admin) {
            $feedback = Feedback::with('user')->latest()->paginate(10);
            return view('admin.feedback.index', compact('feedback'));
        }

        $feedback = Feedback::with('user')->latest()->paginate(10);
        return view('feedback.index', compact('feedback'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
        }

        Feedback::create($validated);

        return back()->with('success', 'Thank you for your feedback!');
    }

    public function show(Feedback $feedback)
    {
        $this->authorize('view', $feedback);
        return view('feedback.show', compact('feedback'));
    }

    public function update(Request $request, Feedback $feedback)
    {
        $this->authorize('update', $feedback);

        $validated = $request->validate([
            'status' => 'required|in:pending,read,replied',
            'admin_reply' => 'required_if:status,replied|nullable|string',
        ]);

        $feedback->update($validated);

        return redirect()->route('feedback.show', $feedback)
            ->with('success', 'Feedback updated successfully.');
    }

    public function destroy(Feedback $feedback)
    {
        $this->authorize('delete', $feedback);

        $feedback->delete();

        return redirect()->route('feedback.index')
            ->with('success', 'Feedback deleted successfully.');
    }
}