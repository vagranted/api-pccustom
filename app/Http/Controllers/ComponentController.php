<?php

namespace App\Http\Controllers;

use App\Http\Resources\ComponentResource;
use App\Models\Component;
use App\Http\Requests\StoreComponentRequest;
use App\Http\Requests\UpdateComponentRequest;
use App\Models\ComponentType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ComponentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['index', 'show']);
        $this->authorizeResource(Component::class, 'component');
    }

    public function index()
    {
        return ComponentResource::collection(Component::all());
    }


    public function store(StoreComponentRequest $request)
    {
        $payloadCollection = $request->collect();
        $componentTypeTitle = $payloadCollection->pull('type');
        $componentType = ComponentType::where('title', $componentTypeTitle)->first();
        $payloadCollection->put('component_type_id', $componentType->id);
        $component = Component::create($payloadCollection->toArray());
        return new ComponentResource($component);
    }

    public function show(Component $component)
    {
        return new ComponentResource($component);
    }

    public function update(UpdateComponentRequest $request, Component $component)
    {
        $payload = $request->validated();
        $component->update($payload);
        return new ComponentResource($component);
    }

    public function destroy(Component $component)
    {
        $component->delete();
        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
