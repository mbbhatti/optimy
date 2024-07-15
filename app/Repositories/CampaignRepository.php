<?php

namespace App\Repositories;

use App\Models\Campaign;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CampaignRepository
{
    /**
     * Get all records with associated user
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return Campaign::whereIn('status', ['active', 'approved'])->with('user')->get();
    }

    /**
     * Get campaigns with pagination
     *
     * @param int $perPage
     *
     * @return LengthAwarePaginator
     */
    public function getAllCampaigns(int $perPage = 10): LengthAwarePaginator
    {
        return Campaign::paginate($perPage);
    }

    /**
     * Get campaign by id
     *
     * @param int $id
     *
     * @return Campaign
     */
    public function findCampaignById(int $id): Campaign
    {
        return Campaign::findOrFail($id);
    }

    /**
     * Get latest records with three default entries
     *
     * @param int $limit
     *
     * @return Collection
     */
    public function getPopularFundraisers(int $limit = 3): Collection
    {
        return Campaign::orderBy('created_at', 'desc')
            ->whereIn('status', ['active', 'approved'])
            ->take($limit)
            ->get();
    }

    /**
     * Create campaign
     *
     * @param array $validatedData
     * @param Request $request
     *
     * @return Campaign
     */
    public function save(array $validatedData, Request $request): Campaign
    {
        $request->image_url->move(public_path('images'), $request->image_url->getClientOriginalName());

        $campaign = new Campaign($validatedData);
        $campaign->image_url = 'images/' . $request->image_url->getClientOriginalName();
        $campaign->user_id = auth()->id();
        $campaign->save();

        return $campaign;
    }

    /**
     * Get count of active campaigns.
     *
     * @return int
     */
    public function getActiveCampaignCount(): int
    {
        return Campaign::whereIn('status', ['active', 'approved'])->count();
    }
}
