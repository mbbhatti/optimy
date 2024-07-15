<?php

namespace App\Http\Controllers;

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
    public function __construct(
        protected CampaignRepository $campaignRepository,
    ) {
    }

    /**
     * Show campaign form
     *
     * @return Application|Factory|View
     */
    public function show()
    {
        return view('campaigns.create');
    }

    /**
     * Save campaign
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'goal_amount' => 'required|numeric',
            'image_url' => 'required|image',
        ]);

        $this->campaignRepository->save($validated, $request);

        return redirect()->route('profile', ['activeTab' => 'created-campaigns'])
            ->with('success', 'Campaign created successful!');
    }

    /**
     * Show campaigns edit form
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        $campaign = $this->campaignRepository->findCampaignById($id);

        return view('campaigns.edit', compact('campaign'));
    }

    /**
     * Update campaign
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'goal_amount' => 'required|numeric|min:1',
        ]);

        $campaign = $this->campaignRepository->findCampaignById($id);
        $campaign->update($request->all());

        return redirect()->route('profile', ['activeTab' => 'created-campaigns'])
            ->with('success', 'Campaign updated successful!');
    }

    /**
     * Delete campaign
     *
     * @param Campaign $campaign
     *
     * @return RedirectResponse
     */
    public function delete(Campaign $campaign)
    {
        $campaign->donations()->delete();
        $campaign->delete();

        return redirect()->route('profile', ['activeTab' => 'created-campaigns'])
            ->with('success', 'Campaign deleted successful!');
    }
}

