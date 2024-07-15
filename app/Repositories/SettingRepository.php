<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SettingRepository
{
    /**
     * Get paginated settings.
     *
     * @param int $perPage
     *
     * @return LengthAwarePaginator
     */
    public function getAllSettings($perPage = 10): LengthAwarePaginator
    {
        return Setting::paginate($perPage);
    }

    /**
     * Create a new setting.
     *
     * @param array $data
     * @return \App\Models\Setting
     */
    public function save(array $data)
    {
        return Setting::create($data);
    }
}
