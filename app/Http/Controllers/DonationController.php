<?php

namespace App\Http\Controllers;

use App\Repositories\CampaignRepository;
use App\Repositories\DonationRepository;
use App\Repositories\MissionRepository;
use App\Services\MissionService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DonationController extends Controller
{
    /**
     * @param MissionRepository $missionRepository
     * @param CampaignRepository $campaignRepository
     * @param DonationRepository $donationRepository
     */
    public function __construct(
        protected MissionRepository $missionRepository,
        protected CampaignRepository $campaignRepository,
        protected DonationRepository $donationRepository,
        protected MissionService $missionService
    ) {
    }

    /**
     * Show donation form for mission
     *
     * @param int $id
     *
     * @return Application|Factory|View
     */
    public function showMissionDonation(int $id)
    {
        $mission = $this->missionRepository->findMissionById($id);

        return view('donation.mission', compact('mission'));
    }

    /**
     * Process the donation to a missions.
     *
     * @param Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function donateToMission(Request $request, int $id)
    {
        $request->validate([
            'amount' => 'required_without:custom_amount|nullable',
            'custom_amount' => 'required_if:amount,custom|numeric|min:1|nullable',
            'is_recurring' => 'required|boolean',
            'payment_method' => 'required|string',
        ]);

        $lastInsertedId = $this->donationRepository->createDonation([
            'user_id' => Auth::user()->id,
            'mission_id' => $id,
            'amount' => $request->amount === 'custom' ? $request->custom_amount : $request->amount,
            'is_recurring' => $request->is_recurring,
        ]);

        if ($lastInsertedId) {
            return redirect()->back()->with('success', 'Mission donation successful!');
        }

        return redirect()->back()->with('error', 'Mission donation Failed!');
    }

    /**
     * show donation form for campaign
     *
     * @param int $id
     *
     * @return Application|Factory|View
     */
    public function showFundraiserDonation(int $id)
    {
        $fundraiser = $this->campaignRepository->findCampaignById($id);

        return view('donation.fundraiser', compact('fundraiser'));
    }

    /**
     * Process the donation to a fundraiser.
     *
     * @param Request $request
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function donateToFundraiser(Request $request, int $id)
    {
        $request->validate([
            'amount' => 'required_without:custom_amount|nullable',
            'custom_amount' => 'required_if:amount,custom|numeric|min:1|nullable',
            'is_recurring' => 'required|boolean',
            'payment_method' => 'required|string',
        ]);

        $lastInsertedId = $this->donationRepository->createDonation([
            'user_id' => Auth::user()->id,
            'campaign_id' => $id,
            'amount' => $request->amount === 'custom' ? $request->custom_amount : $request->amount,
            'is_recurring' => $request->is_recurring,
        ]);

        if ($lastInsertedId) {
            return redirect()->back()->with('success', 'Fundraiser donation successful!');
        }

        return redirect()->back()->with('error', 'Fundraiser donation Failed!');
    }

    /**
     * show donation page
     *
     * @return Application|Factory|View
     */
    public function show()
    {
        $missions = $this->missionRepository->all() ?? $this->missionService->fetchMissions();
        $fundraisers = $this->campaignRepository->all();

        return view('donation.show', compact('missions', 'fundraisers'));
    }
}

