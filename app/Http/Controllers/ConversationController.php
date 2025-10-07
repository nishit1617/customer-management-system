<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Customer;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Customer $customer)
    {
        return view('conversations.create', compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'conversation_time' => 'required|date',
            'medium' => 'required|in:call,email,sms,meeting,other',
            'notes' => 'nullable|string',
        ]);

        $customer->conversations()->create($validated);

        return redirect()->route('customers.show', $customer)
            ->with('success', 'Conversation added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer, Conversation $conversation)
    {
        return view('conversations.edit', compact('customer', 'conversation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer, Conversation $conversation)
    {
        $validated = $request->validate([
            'conversation_time' => 'required|date',
            'medium' => 'required|in:call,email,sms,meeting,other',
            'notes' => 'nullable|string',
        ]);

        $conversation->update($validated);

        return redirect()->route('customers.show', $customer)
            ->with('success', 'Conversation updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer, Conversation $conversation)
    {
        $conversation->delete();

        return redirect()->route('customers.show', $customer)
            ->with('success', 'Conversation deleted successfully.');
    }
}
