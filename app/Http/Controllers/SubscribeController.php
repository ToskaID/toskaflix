<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            'auth',
        ];
    }

    public function show()
    {
        $plans = Plan::all();
        return view('subscribe.show-plans',compact('plans'));

    }

    public function plan(Plan $plan)
    {
        $user = Auth::user();
        return view('subscribe.plan',compact('plan','user'));

    }

    public function checkout(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $plan  = Plan::findOrFail($request->plan_id);
        $user->memberships()->create([
            'plan_id' => $plan->id,
            'active' => true,
            'start_date' => now(),
            'end_date' => now()->addDays($plan->duration)
        ]);

        return redirect()->route('subscribe.success');
    }

    public function success()
    {
        return view('subscribe.success');
    }
}
