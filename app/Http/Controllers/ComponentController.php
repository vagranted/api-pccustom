<?php

namespace App\Http\Controllers;

use App\Models\Component;
use App\Http\Requests\StoreComponentRequest;
use App\Http\Requests\UpdateComponentRequest;
use App\Models\ComponentType;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ComponentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreComponentRequest $request)
    {
        $payloadCollection = $request->collect();
        $componentTypeTitle = $payloadCollection->pull('type');
        $componentType = ComponentType::where('title', $componentTypeTitle)->first();
        $payloadCollection->put('component_type_id', $componentType->id);
        $component = Component::create($payloadCollection->toArray());
        return $component->toArray();
    }

    /**
     * Display the specified resource.
     */
    public function show(Component $component)
    {
        return $component->toArray();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComponentRequest $request, Component $component)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Component $component)
    {
        $component->delete();
        return new JsonResponse([], Response::HTTP_NO_CONTENT);
    }
}
