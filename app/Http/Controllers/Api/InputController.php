<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\InputRequest\StoreInputRequest;
use App\Http\Requests\InputRequest\UpdateInputRequest;
use App\Http\Resources\InputResource;
use App\Models\Input;

class InputController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inputs = auth()->user()->inputs()->with('user')->get();

        return response()->json([
            'inputs' => InputResource::collection($inputs),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInputRequest $request)
    {
        $validated = $request->validated();

        $input = Input::create([
            ...$validated,
            'user_id' => auth()->id(),
        ]);

        $input->load('user');

        return response()->json([
            'message' => 'Blueprint created successfully.',
            'Input' => InputResource::make($input),
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Input $input)
    {
        $this->authorize('view', $input);

        $input->load('user');

        return response()->json([
            'Input' => InputResource::make($input),
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInputRequest $request, Input $input)
    {
        $this->authorize('update', $input);

        $validated = $request->validated();

        $input->update($validated);

        $input->load('user');

        return response()->json([
            'message' => 'Blueprint updated successfully.',
            'Input' => InputResource::make($input),
        ], 200);
    }

    /**
     * Archive the specified resource from storage.
     */
    public function archive(Input $input)
    {
        $this->authorize('archive', $input);

        $input->delete();

        return response()->json([
            'message' => 'Input archived successfully.',
        ], 200);
    }

    public function restore(Input $input)
    {
        $this->authorize('restore', $input);

        $input->restore();

        $input->load('user');

        return response()->json([
            'message' => 'Input restored successfully.',
            'Input' => InputResource::make($input),
        ], 200);
    }

    public function forceDelete(Input $input)
    {
        $this->authorize('forceDelete', $input);

        $input->forceDelete();

        return response()->json([
            'message' => 'Input deleted successfully.',
        ], 200);
    }

    public function archived()
    {
        $archived_Inputs = auth()->user()->inputs()->onlyTrashed()->with('user')->get();

        return response()->json([
            'archived-Inputs' => InputResource::collection($archived_Inputs),
        ], 200);
    }
}
