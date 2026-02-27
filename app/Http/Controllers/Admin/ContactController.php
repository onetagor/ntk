<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of contacts.
     */
    public function index(Request $request)
    {
        $query = Contact::with('repliedBy')->latest();

        // Filter by status if provided
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        $contacts = $query->paginate(15);
        $pendingCount = Contact::where('status', 'pending')->count();
        
        return view('admin.contacts.index', compact('contacts', 'pendingCount'));
    }

    /**
     * Display the specified contact.
     */
    public function show($id)
    {
        $contact = Contact::with('repliedBy')->findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }

    /**
     * Store reply to contact.
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'admin_reply' => 'required|string|max:5000',
        ]);

        $contact = Contact::findOrFail($id);
        
        $contact->update([
            'admin_reply' => $request->admin_reply,
            'status' => 'replied',
            'replied_at' => now(),
            'replied_by' => Auth::guard('admin')->id(),
        ]);

        // Here you can send email to the user with the reply
        // Mail::to($contact->email)->send(new ContactReplyMail($contact));

        $toster = array(
            'message' => 'Reply sent successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.contacts.show', $id)->with($toster);
    }

    /**
     * Update contact status.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,replied,archived',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update(['status' => $request->status]);

        $toster = array(
            'message' => 'Status updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($toster);
    }

    /**
     * Remove the specified contact.
     */
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        $toster = array(
            'message' => 'Contact deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.contacts.index')->with($toster);
    }

    /**
     * Export contacts to CSV.
     */
    public function export(Request $request)
    {
        $query = Contact::with('repliedBy');

        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        $contacts = $query->get();

        $filename = 'contacts_' . date('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($contacts) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Name', 'Email', 'Phone', 'Message', 'Status', 'Replied By', 'Replied At', 'Created At']);

            foreach ($contacts as $contact) {
                fputcsv($file, [
                    $contact->id,
                    $contact->name,
                    $contact->email,
                    $contact->phone,
                    $contact->message,
                    $contact->status,
                    $contact->repliedBy->name ?? 'N/A',
                    $contact->replied_at ? $contact->replied_at->format('Y-m-d H:i:s') : 'N/A',
                    $contact->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
