<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pin;
use App\Models\PinCategory;
use App\Http\Requests\CreatePinRequest;
use App\Http\Requests\UpdatePinRequest;

class PinController extends Controller
{
    public function create()
    {
        return view('admin.shared.add-pin', [
            'pinCategories' => PinCategory::all()
        ]);
    }

    public function store(CreatePinRequest $request)
    {
        Pin::create($request->validated());

        return redirect()->route('admin.dashboard')->with('success', 'Pin created successfully');
    }

    public function edit(Pin $pin)
    {
        return view('admin.shared.edit-pin', [
            'pin' => $pin,
            'pinCategories' => PinCategory::all()
        ]);
    }

    public function update(Pin $pin, UpdatePinRequest $request)
    {
        $request->validated();

        $pin->update($request->validated());

        return redirect()->route('admin.dashboard')->with('success', 'Pin updated successfully');
    }

    public function destroy(Pin $pin)
    {
        $pin->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Pin deleted successfully');
    }
}
