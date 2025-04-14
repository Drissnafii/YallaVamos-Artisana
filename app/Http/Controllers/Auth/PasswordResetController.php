<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class PasswordResetController extends Controller {
    // Afficher le formulaire de demande
    public function showLinkRequestForm() {
        return view('auth.forgot-password');
    }

    // Envoyer le lien
    public function sendResetLinkEmail(Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    // Afficher le formulaire de réinitialisation
    public function showResetForm(Request $request, $token) {
        return view('auth.reset-password', [
            'token' => $token,
            'email' => $request->email
        ]);
    }

    // Traiter la réinitialisation
    public function reset(Request $request) {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:8',
            ]);

            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user, $password) {
                    $user->forceFill([
                        'password' => bcrypt($password)
                    ])->save();
                }
            );

            if ($status === Password::PASSWORD_RESET) {
                return redirect()->route('login')->with('status', __('Your password has been reset successfully!'));
            }

            // If we reach here, there was an issue with the reset token or email
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => __($status)]);
        } catch (ValidationException $e) {
            // Catch validation errors and redirect back with them
            return back()->withErrors($e->errors())->withInput($request->only('email'));
        } catch (\Exception $e) {
            // Catch any other errors
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['error' => 'An unexpected error occurred. Please try again.']);
        }
    }
}
