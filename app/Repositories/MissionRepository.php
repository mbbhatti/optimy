<?php

namespace App\Repositories;

use App\Models\Mission;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class MissionRepository
{
    /**
     * Get all missions.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return Mission::where('status', 'active')->get();
    }

    /**
     * Get missions with pagination
     *
     * @param int $perPage
     *
     * @return LengthAwarePaginator
     */
    public function getAllMissions(int $perPage = 10): LengthAwarePaginator
    {
        return Mission::where('status', 'active')->paginate($perPage);
    }

    /**
     * Get mission by id
     *
     * @param int $id
     *
     * @return Mission
     */
    public function findMissionById(int $id): Mission
    {
        return Mission::findOrFail($id);
    }

    /**
     * Get latest missions with three default entries
     *
     * @param int $limit
     *
     * @return Collection
     */
    public function getRecentMissions(int $limit = 3): Collection
    {
        return Mission::orderBy('created_at', 'desc')
            ->where('status', 'active')
            ->take($limit)
            ->get();
    }

    /**
     * Create a new mission.
     *
     * @param array $validatedData
     * @param Request $request
     *
     * @return Mission
     */
    public function save(array $validatedData, Request $request): Mission
    {

        $request->image_url->move(public_path('images'), $request->image_url->getClientOriginalName());

        $mission = new Mission($validatedData);
        $mission->image_url = 'images/' . $request->image_url->getClientOriginalName();
        $mission->save();

        return $mission;
    }

    /**
     * Get count of active missions.
     *
     * @return int
     */
    public function getActiveMissionCount(): int
    {
        return Mission::where('status', 'active')->count();
    }
}
