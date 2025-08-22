<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;

class VerifyEmailController extends Controller
{
    /**
     * Mark the given user's email address as verified.
     */
    public function __invoke(Request $request, $id, $hash): RedirectResponse
    {
        $user = User::findOrFail($id);

        // Check hash from email
        if (! hash_equals(sha1($user->getEmailForVerification()), (string) $hash)) {
            abort(403, 'Invalid signature.');
        }

        // Already verified
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('home', ['verified' => 1]);
        }

        // Mark as verified
        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->route('home', ['verified' => 1]);
    }
}
