<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use Illuminate\Http\Request;

class FeeReportController extends Controller
{
    public function index()
    {
        // Overall stats
        $total_due = Fee::sum('amount_due');
        $total_paid = Fee::sum('amount_paid');
        $total_balance = $total_due - $total_paid;

        // Group by term
        $term_summary = Fee::selectRaw('term, SUM(amount_due) as due, SUM(amount_paid) as paid')
            ->groupBy('term')
            ->get();

        return view('fees.report', compact('total_due', 'total_paid', 'total_balance', 'term_summary'));
    }
}
