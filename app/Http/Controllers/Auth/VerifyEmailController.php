<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
        $user = User::findOrFail($id);

    if (! hash_equals(sha1($user->email), $hash)) {
        abort(403);
    }

    if ($user->hasVerifiedEmail()) {
        return redirect(route('home', ['verified' => 1]));
    }

    $user->markEmailAsVerified();

    return redirect(route('home', ['verified' => 1]));
    }
}
