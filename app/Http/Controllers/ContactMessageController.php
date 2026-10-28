<?php
namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    // Display the contact form
    public function create()
    {
        return view('customer.contact');
    }

    // Save customer complaint
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'complaint' => 'required|string|max:5000',
        ]);

        ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'complaint' => $request->complaint,
        ]);

        return back()->with('success', 'Your complaint has been submitted successfully!');
    }

    // Display complaints in admin dashboard
    public function index()
    {
        $complaints = ContactMessage::latest()->get();

        return view('admin.complaints.index', compact('complaints'));
    }

    // Mark complaint as resolved or unresolved
    public function toggleResolved($id)
    {
        $complaint = ContactMessage::findOrFail($id);

        $complaint->update([
            'is_resolved' => !$complaint->is_resolved,
        ]);

        return back()->with('success', 'Complaint status updated successfully!');
    }
}
