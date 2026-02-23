<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Statistic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StatisticController extends Controller
{
    public function index()
    {
        $statistics = Statistic::orderBy('order')->get();
        return view('admin.cms.statistics.index', compact('statistics'));
    }

    public function create()
    {
        return view('admin.cms.statistics.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|string|max:50',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('statistics', 'public');
        }

        Statistic::create($data);

        return redirect()->route('admin.statistics.index')->with('success', 'Statistic created successfully!');
    }

    public function edit(Statistic $statistic)
    {
        return view('admin.cms.statistics.edit', compact('statistic'));
    }

    public function update(Request $request, Statistic $statistic)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'value' => 'required|string|max:50',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'order' => 'nullable|integer',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('icon')) {
            if ($statistic->icon) {
                Storage::delete('public/' . $statistic->icon);
            }
            $data['icon'] = $request->file('icon')->store('statistics', 'public');
        }

        $statistic->update($data);

        return redirect()->route('admin.statistics.index')->with('success', 'Statistic updated successfully!');
    }

    public function destroy(Statistic $statistic)
    {
        if ($statistic->icon) {
            Storage::delete('public/' . $statistic->icon);
        }
        $statistic->delete();

        return redirect()->route('admin.statistics.index')->with('success', 'Statistic deleted successfully!');
    }
}
