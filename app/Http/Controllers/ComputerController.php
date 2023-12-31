<?php

namespace App\Http\Controllers;

use App\Http\Resources\ComputerResource;
use App\Models\Computer;
use App\Http\Requests\StoreComputerRequest;
use App\Http\Requests\UpdateComputerRequest;
use App\Models\ComputerComponent;
use App\Models\Component;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class ComputerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->authorizeResource(Computer::class, 'computer');
    }

    public function index()
    {
        return ComputerResource::collection(Computer::all());
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
        return new ComputerResource($computer);
    }

    public function update(UpdateComputerRequest $request, Computer $computer)
    {
        $components = $request->input('components');
        $title = $request->input('title');

        if(isset($components)) {
            $oldComputerComponents = ComputerComponent::where('computer_id', $computer->id)->get();
            foreach ($oldComputerComponents as $computerComponent) $computerComponent->delete();

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
        } else if($title) {
            $computer->update(['title' => $title]);
        }

        return new ComputerResource($computer);
    }

    public function destroy(Computer $computer)
    {
        $computer->delete();
        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
