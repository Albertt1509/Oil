<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Log;

#[Title('forget-password')]
class ForgotPasswordPage extends Component
{
    public $email;
    
    public function save()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email|max:255',
        ]);

        // Log email to debug
        Log::info('Email entered: ' . $this->email);

        try {
            $status = Password::sendResetLink(['email' => $this->email]);

            if ($status === Password::RESET_LINK_SENT) {
                session()->flash('success', 'Password link has been sent to your email');
                $this->email = '';
            } else {
                Log::error('Failed to send reset link. Status: ' . $status);
                session()->flash('error', 'Failed to send reset link');
            }
        } catch (\Exception $e) {
            Log::error('Exception caught: ' . $e->getMessage());
            session()->flash('error', 'An error occurred while sending reset link');
        }
    }

    public function render()
    {
        return view('livewire.auth.forgot-password-page');
    }
}
