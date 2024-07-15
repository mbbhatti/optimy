<?php

namespace App\Repositories;

use App\Models\Donation;
use App\Models\User;
use Carbon\Carbon;

class DonationRepository
{
    /**
     * Create | Update donation
     *
     * @param array $data
     *
     * @return int
     */
    public function createDonation(array $data): int
    {
        $donation = Donation::create($data);

        return $donation->id;
    }

    /**
     * Get total donations, average donation amount, and count within date range.
     *
     * @param Carbon $startDate
     * @param Carbon $endDate
     *
     * @return array
     */
    public function getDonationsData(Carbon $startDate, Carbon $endDate): array
    {
        $total = Donation::whereBetween('created_at', [$startDate, $endDate])->sum('amount');
        $average = Donation::whereBetween('created_at', [$startDate, $endDate])->average('amount');
        $count = Donation::whereBetween('created_at', [$startDate, $endDate])->count();

        return compact('total', 'average', 'count');
    }

    /**
     * Get user engagement and active users within date range.
     *
     * @param Carbon $startDate
     * @param Carbon $endDate
     *
     * @return array
     */
    public function getEngagementData(Carbon $startDate, Carbon $endDate): array
    {
        $userEngagement = Donation::whereBetween('created_at', [$startDate, $endDate])->count();
        $activeUsers = User::whereHas('donations', function ($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        })->count();

        return compact('userEngagement', 'activeUsers');
    }

    /**
     * Get total donation amount within date range.
     *
     * @return float
     */
    public function getTotalDonationAmount(): float
    {
        return Donation::sum('amount');
    }
}
