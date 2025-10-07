<?php

namespace App\Http\Controllers;

use App\Mail\CustomerMessage;
use App\Models\Customer;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client as TwilioClient;

class MessageController extends Controller
{
    public function create(Request $request)
    {
        $customerIds = $request->input('customer_ids', []);
        $customers = Customer::whereIn('id', $customerIds)->get();
        
        return view('messages.create', compact('customers', 'customerIds'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_ids' => 'required|array',
            'customer_ids.*' => 'exists:customers,id',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'type' => 'required|in:email,sms',
        ]);

        $sentCount = 0;
        $failedCount = 0;

        foreach ($validated['customer_ids'] as $customerId) {
            $customer = Customer::find($customerId);
            $status = 'pending';
            
            // Send email if type is email
            if ($validated['type'] === 'email') {
                try {
                    Mail::to($customer->email)->send(
                        new CustomerMessage($validated['subject'], $validated['body'])
                    );
                    $status = 'sent';
                    $sentCount++;
                } catch (\Exception $e) {
                    $status = 'failed';
                    $failedCount++;
                }
            } else {
                // Send SMS using Twilio
                try {
                    // Create Twilio HTTP client with SSL verification disabled
                    $httpClient = new \Twilio\Http\CurlClient([
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_SSL_VERIFYHOST => false
                    ]);
                    
                    $twilio = new TwilioClient(
                        config('services.twilio.sid'),
                        config('services.twilio.token'),
                        null,
                        null,
                        $httpClient
                    );
                    
                    $twilio->messages->create(
                        $customer->contact,
                        [
                            'from' => config('services.twilio.from'),
                            'body' => $validated['body']
                        ]
                    );
                    $status = 'sent';
                    $sentCount++;
                } catch (\Exception $e) {
                    \Log::error('SMS sending failed: ' . $e->getMessage());
                    $status = 'failed';
                    $failedCount++;
                }
            }
            
            Message::create([
                'customer_id' => $customerId,
                'subject' => $validated['subject'],
                'body' => $validated['body'],
                'type' => $validated['type'],
                'status' => $status,
                'sent_at' => $status === 'sent' ? now() : null,
            ]);
        }

        $message = "Message sent to {$sentCount} customer(s) successfully.";
        if ($failedCount > 0) {
            $message .= " {$failedCount} failed.";
        }

        return redirect()->route('customers.index')->with('success', $message);
    }
}
