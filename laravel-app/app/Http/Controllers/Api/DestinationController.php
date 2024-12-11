<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDestinationRequest;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $data = Destination::all();
            return response()->json($data, 201);
        } catch (\Exception $e) {
            // Retorne uma mensagem amigável em caso de erro
            return response()->json([
                'message' => 'Failed to create destination',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDestinationRequest $request)
    {
     try {
            // Use transação para garantir consistência
            $destination = DB::transaction(function () use ($request) {
                return Destination::create($request->validated());
            });

            return response()->json([
                'message' => 'Destination created successfully',
                'destination' => $destination,
            ], 201);
        } catch (\Exception $e) {
            // Retorne uma mensagem amigável em caso de erro
            return response()->json([
                'message' => 'Failed to create destination',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDestinationRequest $request, Destination $destination)
    {

        $data = $request->validated();

        DB::transaction(function () use ($destination, $data) {
            $destination->update($data);
        });
        return response()->json(['message' => 'Updated Sucessfully', 'destination' => $destination]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        try{
            return response()->json($destination, 200);

        }catch(\Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the feedback',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $Destination)
    {
        //
    }
}
