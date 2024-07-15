<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mission;
use App\Repositories\MissionRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MissionController extends Controller
{
    /**
     * @param MissionRepository $missionRepository
     */
    public function __construct(protected MissionRepository $missionRepository)
    {
    }

    /**
     * Show list
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $missions = $this->missionRepository->getAllMissions();

        return view('admin.missions.index', compact('missions'));
    }

    /**
     * Show create form
     * s
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.missions.create');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'goal_amount' => 'required|numeric|min:0',
            'organization' => 'required|string',
            'image_url' => 'required|image',
        ]);

        $this->missionRepository->save($validated, $request);

        return redirect()->route('missions.index')->with('success', 'Mission created successfully.');
    }

    /**
     * Show edit page
     *
     * @param Mission $mission
     *
     * @return Application|Factory|View
     */
    public function edit(Mission $mission)
    {
        return view('admin.missions.edit', compact('mission'));
    }

    /**
     * Update record
     *
     * @param Request $request
     * @param Mission $mission
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Mission $mission)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'goal_amount' => 'required|numeric|min:0',
            'status' => 'required',
            'organization' => 'required|string',
        ]);

        $mission->update($request->all());

        return redirect()->route('missions.index')->with('success', 'Mission updated successfully.');
    }

    /**
     * Delete record
     *
     * @param Mission $mission
     *
     * @return RedirectResponse
     */
    public function destroy(Mission $mission)
    {
        $mission->donations()->delete();
        $mission->delete();

        return redirect()->route('missions.index')->with('success', 'Mission deleted successfully.');
    }
}
