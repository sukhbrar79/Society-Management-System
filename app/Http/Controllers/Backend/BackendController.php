<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Fetch real data from your database
        $totalComplaints = \Modules\Complaint\Models\Complaint::count();
        $pendingComplaints = \Modules\Complaint\Models\Complaint::where('status', 'pending')->count();
        $resolvedComplaints = \Modules\Complaint\Models\Complaint::where('status', 'resolved')->count();
        $closedComplaints = \Modules\Complaint\Models\Complaint::where('status', 'closed')->count();

        
        $totalResidents = \App\Models\User::whereHas('roles', function($query) {
            $query->where('name', 'resident');
        })->count();
        $freeParkings = \Modules\Parking\Models\Parking::whereNotIn('id', function ($query) {
            $query->select('parking_id')
                  ->from('parking_allocations')
                  ->where('status', 'Active');
        })->count();
        $pendingInvoices = \Modules\Invoice\Models\Invoice::where('status', 'Pending')->count();
        $overdueInvoices = \Modules\Invoice\Models\Invoice::where('status', 'Overdue')->count();

        return view('backend.index', compact('totalComplaints', 'pendingComplaints', 'resolvedComplaints', 'closedComplaints', 'totalResidents', 'freeParkings', 'pendingInvoices', 'overdueInvoices'));
    }
}
