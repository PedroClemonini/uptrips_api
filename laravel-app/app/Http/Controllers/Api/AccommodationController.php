<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccommodationRequest;
use App\Models\Accommodation;
use App\Models\Hosting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccommodationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Hosting $hosting_id)
    {
        try {
            var_dump($hosting_id->id);
          //  $accommodations = Accommodation::where('hosting_id', $hosting_id->id)->get();
           // return response()->json($accommodations);
        } catch(\Exception $e) {
            return response()->json([
                       'message' => 'An error occurred while retrieving accommodations',
                       'error' => $e->getMessage(),
                   ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAccommodationRequest $request)
    {
        try {
            // Use transação para garantir consistência
            $hosting = DB::transaction(function () use ($request) {
                return Accommodation::create($request->validated());
            });

            return response()->json([
                'message' => 'Accommodation created successfully',
                'destination' => $hosting,
            ], 201);
        } catch (\Exception $e) {
            // Retorne uma mensagem amigável em caso de erro
            return response()->json([
                'message' => 'Failed to create accommodation',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Accommodation $accommodation)
    {
        try {
            return response()->json($accommodation, 200);

        } catch(\Exception $e) {
            return response()->json([
                'message' => 'An error occured while retrieving the feedback',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Accommodation $accommodation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accommodation $accommodation)
    {
        //
    }
}
