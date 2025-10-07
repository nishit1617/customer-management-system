<?php

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('customers.index');
    }
    // Redirect to login page which now has registration link
    return redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Customer routes
    Route::resource('customers', CustomerController::class);
    
    // Conversation routes
    Route::get('customers/{customer}/conversations/create', [ConversationController::class, 'create'])->name('conversations.create');
    Route::post('customers/{customer}/conversations', [ConversationController::class, 'store'])->name('conversations.store');
    Route::get('customers/{customer}/conversations/{conversation}/edit', [ConversationController::class, 'edit'])->name('conversations.edit');
    Route::put('customers/{customer}/conversations/{conversation}', [ConversationController::class, 'update'])->name('conversations.update');
    Route::delete('customers/{customer}/conversations/{conversation}', [ConversationController::class, 'destroy'])->name('conversations.destroy');
    
    // Message routes
    Route::get('messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('messages', [MessageController::class, 'store'])->name('messages.store');
});

require __DIR__.'/auth.php';
