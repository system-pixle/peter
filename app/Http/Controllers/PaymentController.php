<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Student;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index($student_id)
    {
        $student = Student::with('payments')->findOrFail($student_id);
        return view('finance.payments.index', compact('student'));
    }

    public function store(Request $request, $student_id)
    {
        $request->validate([
            'amount_paid' => 'required|numeric|min:1',
            'term' => 'nullable|string|max:255',
            'payment_date' => 'required|date',
            'payment_method' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
        ]);

        Payment::create([
            'student_id' => $student_id,
            'amount_paid' => $request->amount_paid,
            'term' => $request->term,
            'payment_date' => $request->payment_date,
            'payment_method' => $request->payment_method,
            'remarks' => $request->remarks,
        ]);

        return redirect()->route('finance.payments.index', $student_id)
            ->with('success', 'Payment recorded successfully.');
    }

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!in_array(auth()->user()->role, ['admin', 'director'])) {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    }
}