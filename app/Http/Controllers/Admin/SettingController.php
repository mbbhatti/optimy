<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Repositories\SettingRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * @param SettingRepository $settingRepository
     */
    public function __construct(protected SettingRepository $settingRepository)
    {
    }

    /**
     * Get setting list
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $settings = $this->settingRepository->getAllSettings();

        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Show setting create form
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.settings.create');
    }

    /**
     * Save setting
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|unique:settings,key',
            'value' => 'required',
        ]);

        $this->settingRepository->save($request->all());

        return redirect()->route('admin.settings.index')->with('success', 'Setting added successfully');
    }

    /**
     * Show setting edit form
     *
     * @param Setting $setting
     *
     * @return Application|Factory|View
     */
    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', compact('setting'));
    }

    /**
     * Update setting
     *
     * @param Request $request
     * @param Setting $setting
     *
     * @return RedirectResponse
     */
    public function update(Request $request, Setting $setting)
    {
        $setting->update($request->all());

        return redirect()->route('admin.settings.index')->with('success', 'Setting updated successfully');
    }
}
