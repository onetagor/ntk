<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::latest()->paginate(20);
        return view('admin.cms.newsletters.index', compact('newsletters'));
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return redirect()->route('admin.newsletters.index')->with('success', 'Newsletter subscriber deleted successfully!');
    }

    public function export()
    {
        $newsletters = Newsletter::where('status', 1)->pluck('email')->toArray();
        $filename = 'newsletters_' . date('Y-m-d') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($newsletters) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Email']);
            foreach ($newsletters as $email) {
                fputcsv($file, [$email]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
