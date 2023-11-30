<?php

namespace App\Http\Controllers;

use App\Http\Resources\ComputerResource;
use App\Models\Computer;
use App\Http\Requests\StoreComputerRequest;
use App\Http\Requests\UpdateComputerRequest;
use App\Models\ComputerComponent;
use App\Models\Component;
use Illuminate\Validation\ValidationException;

class ComputerController extends Controller
{
    public function index()
    {
        //
    }

    public function store(StoreComputerRequest $request)
    {
        $components = $request->input('components');
        $title = $request->input('title');

        $computer = Computer::create(['title' => $title]);

        foreach ($components as $componentId) {
            if(!is_numeric($componentId)) {
                throw ValidationException::withMessages([
                    'components' => 'Value must be numeric'
                ]);
            } else if(!$component = Component::where('id', $componentId)->first()) {
                throw ValidationException::withMessages([
                    'components' => 'Component id does not exists'
                ]);
            }

            ComputerComponent::create([
                'computer_id' => $computer->id,
                'component_id' => $component->id
            ]);
        }

        return new ComputerResource($computer);
    }

    public function show(Computer $computer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComputerRequest $request, Computer $computer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Computer $computer)
    {
        //
    }
}
