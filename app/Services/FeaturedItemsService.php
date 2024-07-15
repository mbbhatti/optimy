<?php

namespace App\Services;

use App\Repositories\MissionRepository;
use App\Repositories\CampaignRepository;
use Illuminate\Support\Collection;

class FeaturedItemsService
{
    public function __construct(
        protected MissionRepository $missionRepository,
        protected CampaignRepository $campaignRepository
    ) {
    }

    /**
     * @return Collection
     */
    public function getFeaturedItems(): Collection
    {
        $recentMissions = $this->missionRepository->getRecentMissions();
        $popularFundraisers = $this->campaignRepository->getPopularFundraisers();

        $featuredItems = collect();

        // Map recent missions
        $featuredItems = $featuredItems->merge($recentMissions->map(function ($mission) {
            return [
                'type' => 'missions',
                'title' => $mission->title,
                'description' => $mission->description,
                'image_url' => $mission->image_url,
            ];
        }));

        // Map popular campaigns
        return $featuredItems->merge($popularFundraisers->map(function ($fundraiser) {
            return [
                'type' => 'fundraiser',
                'title' => $fundraiser->title,
                'description' => $fundraiser->description,
                'image_url' => $fundraiser->image_url,
            ];
        }));
    }
}
