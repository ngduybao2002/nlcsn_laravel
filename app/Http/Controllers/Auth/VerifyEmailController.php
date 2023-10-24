<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            $request->session()->flash('success', 'Sign Up Success!');
            return $this->getRedirect($request);
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
            $request->session()->flash('success', 'Sign Up Success!');
            return $this->getRedirect($request);
        } else {
            $request->session()->flash('error', 'Failed to verify email!');
            return redirect()->back();
        }
    }

    private function getRedirect($request)
    {
        switch ($request->role) {
            case "Student":
                return redirect()->intended(RouteServiceProvider::HOME_s.'?verified=1');
            case "Teacher":
                return redirect()->intended(RouteServiceProvider::HOME_t.'?verified=1');
            default:
                return redirect()->intended(RouteServiceProvider::HOME_a.'?verified=1');
        }
    }
}