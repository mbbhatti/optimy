<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CampaignRepository;
use App\Repositories\DonationRepository;
use App\Repositories\MissionRepository;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class AdminController extends Controller
{
    /**
     * @param DonationRepository $donationRepository
     * @param UserRepository $userRepository
     * @param MissionRepository $missionRepository
     * @param CampaignRepository $campaignRepository
     */
    public function __construct(
        protected DonationRepository $donationRepository,
        protected UserRepository $userRepository,
        protected MissionRepository $missionRepository,
        protected CampaignRepository $campaignRepository
    ) {
    }

    /**
     * Show dashboard page
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $totalDonations = $this->donationRepository->getTotalDonationAmount();
        $activeMissionsCount = $this->missionRepository->getActiveMissionCount();
        $activeFundraisersCount = $this->campaignRepository->getActiveCampaignCount();

        return view('admin.dashboard.index', compact(
            'totalDonations',
            'activeMissionsCount',
            'activeFundraisersCount'
        ));
    }
}
