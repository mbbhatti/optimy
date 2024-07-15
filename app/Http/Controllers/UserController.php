<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Show profile page
     *
     * @return Application|Factory|View
     */
    public function profile()
    {
        $user = Auth::user();

        $donations = Donation::where('user_id', $user->id)
            ->where(function ($query) {
                $query->whereNotNull('campaign_id')
                    ->orWhereNotNull('mission_id');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $campaigns = Campaign::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->where('status', 'active')
            ->get();

        $donationData = $donations->groupBy(function($date) {
            return Carbon::parse($date->created_at)->format('Y-m');
        })->map(function($row) {
            return $row->sum('amount');
        })->toArray();

        $donationData = collect($donationData)->map(function ($amount, $date) {
            return [
                'date' => $date,
                'amount' => $amount,
            ];
        })->values()->all();

        return view('user.profile', compact('donations', 'campaigns', 'donationData'));
    }

    /**
     * Update profile
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('profile', ['activeTab' => 'profile-information'])
            ->with('success', 'Profile updated successfully!');
    }
}
