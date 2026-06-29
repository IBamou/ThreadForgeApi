<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlueprintRequest\StoreBlueprintRequest;
use App\Http\Requests\BlueprintRequest\UpdateBlueprintRequest;
use App\Http\Resources\BlueprintResource;
use App\Models\Blueprint;

class BlueprintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blueprints = auth()->user()->blueprints()->with('user')->get();

        return response()->json([
            'blueprints' => BlueprintResource::collection($blueprints),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlueprintRequest $request)
    {
        $validated = $request->validated();

        $blueprint = Blueprint::create([
            ...$validated,
            'user_id' => auth()->id(),
        ]);

        $blueprint->load('user');

        return response()->json([
            'message' => 'Blueprint created successfully.',
            'blueprint' => BlueprintResource::make($blueprint),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blueprint $blueprint)
    {
        $this->authorize('view', $blueprint);

        $blueprint->load('user');

        return response()->json([
            'blueprint' => BlueprintResource::make($blueprint),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBlueprintRequest $request, Blueprint $blueprint)
    {
        $this->authorize('update', $blueprint);

        $validated = $request->validated();

        $blueprint->update($validated);

        $blueprint->load('user');

        return response()->json([
            'message' => 'Blueprint updated successfully.',
            'blueprint' => BlueprintResource::make($blueprint),
        ], 200);
    }

    /**
     * Archive the specified resource from storage.
     */
    public function archive(Blueprint $blueprint)
    {
        $this->authorize('archive', $blueprint);

        $blueprint->delete();

        return response()->json([
            'message' => 'Blueprint archived successfully.',
        ], 200);
    }

    public function restore(Blueprint $blueprint)
    {
        $this->authorize('restore', $blueprint);

        $blueprint->restore();

        $blueprint->load('user');

        return response()->json([
            'message' => 'Blueprint restored successfully.',
            'blueprint' => BlueprintResource::make($blueprint),
        ], 200);
    }

    public function forceDelete(Blueprint $blueprint)
    {
        $this->authorize('forceDelete', $blueprint);

        $blueprint->forceDelete();

        return response()->json([
            'message' => 'Blueprint deleted successfully.',
        ], 200);
    }

    public function archived()
    {
        $archived_blueprints = auth()->user()->blueprints()->onlyTrashed()->with('user')->get();

        return response()->json([
            'archived-blueprints' => BlueprintResource::collection($archived_blueprints),
        ], 200);
    }
}
