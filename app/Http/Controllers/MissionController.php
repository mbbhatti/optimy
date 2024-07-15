<?php

namespace App\Http\Controllers;

use App\Repositories\CampaignRepository;
use App\Repositories\MissionRepository;
use App\Services\FeaturedItemsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MissionController extends Controller
{
    /**
     * @param MissionRepository $missionRepository
     * @param CampaignRepository $campaignRepository
     * @param FeaturedItemsService $featuredItemsService
     */
    public function __construct(
        protected MissionRepository    $missionRepository,
        protected CampaignRepository   $campaignRepository,
        protected FeaturedItemsService $featuredItemsService
    ) {
    }

    /**
     * Show mission page
     *
     * @param Request $request
     *
     * @return Application|Factory|View
     */
    public function show(Request $request)
    {
        $featuredItems = $this->featuredItemsService->getFeaturedItems();
        $missions = $this->missionRepository->all();
        $fundraisers = $this->campaignRepository->all();

        if ($request->has('search')) {
            $search = $request->input('search');

            $missions = $missions->filter(function ($mission) use ($search) {
                return stripos($mission->title, $search) !== false;
            });

            $fundraisers = $fundraisers->filter(function ($fundraiser) use ($search) {
                return stripos($fundraiser->title, $search) !== false;
            });
        }

        return view('missions.show', compact('missions', 'fundraisers', 'featuredItems'));
    }
}
