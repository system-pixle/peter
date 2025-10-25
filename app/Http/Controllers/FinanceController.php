<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\FeeBreakdown;
use App\Models\Student;
use App\Models\Employee;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;


class FinanceController extends Controller
{

    
    // Finance Dashboard
    public function index()
    {
        $totalCollected = Fee::sum('amount_paid');
        $totalDue = Fee::sum('amount_due');
        $balance = $totalDue - $totalCollected;
        $employeeCount = Employee::count();

        return view('finance.index', compact('totalCollected', 'totalDue', 'balance', 'employeeCount'));
    }

    // Manage Fees
    public function manageFees()
    {
        $fees = Fee::with('student')->latest()->get();
        $students = Student::all();
        return view('finance.manage-fees', compact('fees', 'students'));
    }

    public function createFee()
    {
        $students = Student::all();
        return view('finance.create-fee', compact('students'));
    }

    public function storeFee(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount_due' => 'required|numeric',
            'amount_paid' => 'required|numeric',
            'term' => 'required|string',
        ]);

        Fee::create($request->all());
        return redirect()->route('finance.fees')->with('success', 'Fee record added successfully.');
    }

    public function editFee($id)
    {
        $fee = Fee::findOrFail($id);
        $students = Student::all();
        return view('finance.edit-fee', compact('fee', 'students'));
    }

    public function updateFee(Request $request, $id)
    {
        $fee = Fee::findOrFail($id);
        $fee->update($request->all());
        return redirect()->route('finance.fees')->with('success', 'Fee record updated.');
    }

    public function destroyFee($id)
    {
        Fee::findOrFail($id)->delete();
        return back()->with('success', 'Fee record deleted.');
    }

    // Manage Breakdown
    public function manageBreakdowns()
    {
        $breakdowns = FeeBreakdown::latest()->get();
        return view('finance.manage-breakdowns', compact('breakdowns'));
    }

    public function storeBreakdown(Request $request)
    {
        $request->validate([
            'term' => 'required|string',
            'description' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        FeeBreakdown::create($request->all());
        return back()->with('success', 'Fee breakdown added successfully.');
    }

    public function destroyBreakdown($id)
    {
        FeeBreakdown::findOrFail($id)->delete();
        return back()->with('success', 'Fee breakdown removed.');
    }

    // Student Reports
    public function studentReport($id)
    {
        $student = Student::findOrFail($id);
        $fees = Fee::where('student_id', $id)->get();
        $totalPaid = $fees->sum('amount_paid');
        $totalDue = $fees->sum('amount_due');
        $balance = $totalDue - $totalPaid;
        $breakdowns = FeeBreakdown::where('term', $fees->first()->term ?? 'Term 1')->get();

        return view('finance.student-report', compact('student', 'fees', 'totalPaid', 'totalDue', 'balance', 'breakdowns'));
    }

    public function printStudentReport($id)
    {
        $student = Student::findOrFail($id);
        $fees = Fee::where('student_id', $id)->get();
        $totalPaid = $fees->sum('amount_paid');
        $totalDue = $fees->sum('amount_due');
        $balance = $totalDue - $totalPaid;
        $breakdowns = FeeBreakdown::where('term', $fees->first()->term ?? 'Term 1')->get();

        $pdf = \PDF::loadView('finance.print-student-report', compact('student', 'fees', 'totalPaid', 'totalDue', 'balance', 'breakdowns'));
        return $pdf->download($student->name . '_fee_report.pdf');
    }

public function printBreakdown($term)
{
    // Fetch all fee breakdowns for the selected term
    $breakdowns = \App\Models\FeeBreakdown::where('term', $term)->get();

    if ($breakdowns->isEmpty()) {
        return redirect()->back()->with('error', 'No breakdowns found for ' . $term);
    }

    // Calculate total amount for that term
    $totalAmount = $breakdowns->sum('amount');

    // Optional: format data for display or PDF
    $data = [
        'term' => $term,
        'breakdowns' => $breakdowns,
        'totalAmount' => $totalAmount,
    ];

    // If you want to return a view (HTML)
    return view('finance.print_breakdown', $data);

    // OR if you plan to generate a PDF later, we can add PDF export here.
}


public function studentPayments($studentId)
{
    $student = \App\Models\Student::with('schoolclass')->findOrFail($studentId);
    $fees = \App\Models\Fee::where('student_id', $studentId)->get();

    $totalDue = $fees->sum('amount_due');
    $totalPaid = $fees->sum('amount_paid');
    $balance = $totalDue - $totalPaid;

    return view('finance.student-payments', compact('student', 'fees', 'totalDue', 'totalPaid', 'balance'));
}

public function storePayment(Request $request, $studentId)
{
    $request->validate([
        'term' => 'required|string',
        'amount_paid' => 'required|numeric|min:1',
        'payment_date' => 'required|date',
    ]);

    $fee = \App\Models\Fee::where('student_id', $studentId)
        ->where('term', $request->term)
        ->first();

    if (!$fee) {
        // Create a new fee record if not found
        $fee = \App\Models\Fee::create([
            'student_id' => $studentId,
            'term' => $request->term,
            'amount_due' => 0,
            'amount_paid' => 0,
        ]);
    }

    // Update the amount paid
    $fee->amount_paid += $request->amount_paid;
    $fee->payment_date = $request->payment_date;
    $fee->save();

    return redirect()->route('finance.payments.index', $studentId)
                     ->with('success', 'Payment recorded successfully!');
}



}