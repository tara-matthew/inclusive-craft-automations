<?php

namespace App\Http\Controllers;

use App\Http\Requests\VerifyPinRequest;
use Illuminate\Http\RedirectResponse;

class VerifyPinController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(VerifyPinRequest $request): RedirectResponse
    {
        if ($request->input('pin') !== config('app.pin')) {
            return back()->withErrors(['pin' => 'The PIN you entered is incorrect.']);
        }

        $request->session()->put('pin_verified', true);

        return redirect()->intended(route('appointments.create'));
    }
}
