<?php

namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\settings\PaymentSetting;
use Illuminate\Http\Request;

class PaymentSettingsController extends Controller
{
    public function index()
    {
        $payment = PaymentSetting::first(); // always one record
        return view('settings.payment.index', compact('payment'));
    }

   public function store(Request $request)
{
    $validated = $request->validate([
        'standard_invoices' => 'nullable|in:Yes,No',
        'recurring_invoices' => 'nullable|in:Yes,No',
        'use_available_credits' => 'nullable|in:Yes,No',
        'use_unapplied_payments' => 'nullable|in:Yes,No',
        'manual_payment_email' => 'nullable|in:Yes,No',
        'online_payment_email' => 'nullable|in:Yes,No',
        'mark_paid_payment_email' => 'nullable|in:Yes,No',
        'payment_email_to_all_contacts' => 'nullable|in:Yes,No',
        'manual_overpayments' => 'nullable|in:Yes,No',
        'allow_overpayment' => 'nullable|in:Yes,No',
        'allow_underpayment' => 'nullable|in:Yes,No',
        'client_initiated_payments' => 'nullable|in:Yes,No',
        'one_page_checkout' => 'nullable|in:Yes,No',
        'unlock_documents' => 'nullable|in:Yes,No',
        'payment_type' => 'nullable|in:Cash,Check,Credit Card,Bank Transfer,Other,PayPal',
        'auto_bill_on' => 'nullable|in:Send Date,Due Date',
        'expense_payment_type' => 'nullable|in:Cash,Check,Credit Card,Bank Transfer,Other',
        'quote_valid_until' => 'nullable|numeric',
    ]);

    $payment = PaymentSetting::first();
    $payment ? $payment->update($validated) : PaymentSetting::create($validated);

    if ($request->ajax()) {
        return view('settings.payment.index', [
            'payment' => PaymentSetting::first()
        ])->with('success', 'Settings saved successfully!');
    }

    return redirect()->route('settings.index')->with('success', 'Settings saved successfully!');
}

}
