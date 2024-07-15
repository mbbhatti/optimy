<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\CampaignRepository;
use App\Repositories\DonationRepository;
use App\Repositories\MissionRepository;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ReportController extends Controller
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
     * Show report page
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.reports.index');
    }

    /**
     * Generate report based on date
     *
     * @param Request $request
     *
     * @return Application|Factory|View
     */
    public function generate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date)->startOfDay();
        $endDate = Carbon::parse($request->end_date)->endOfDay();

        $donationsData = $this->donationRepository->getDonationsData($startDate, $endDate);
        $engagementData = $this->donationRepository->getEngagementData($startDate, $endDate);
        $performanceData = [
            'total_users' => $this->userRepository->getUserCount(),
            'active_missions' => $this->missionRepository->getActiveMissionCount(),
            'active_fundraisers' => $this->campaignRepository->getActiveCampaignCount(),
        ];

        return view('admin.reports.index', compact('donationsData', 'engagementData', 'performanceData'));
    }
}
