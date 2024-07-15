<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Repositories\CampaignRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    /**
     * @param CampaignRepository $campaignRepository
     */
    public function __construct(protected CampaignRepository $campaignRepository)
    {
    }

    /**
     * Get campaign list
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $campaigns = $this->campaignRepository->getAllCampaigns();

        return view('admin.campaigns.index', compact('campaigns'));
    }

    /**
     * Update status
     *
     * @param Request $request
     * @param Campaign $campaign
     *
     * @return RedirectResponse
     */
    public function updateStatus(Request $request, Campaign $campaign)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $campaign->update(['status' => $request->status]);

        return redirect()->route('admin.campaigns.index')->with('success', "Fundraiser {$request->status} successfully.");
    }
}

