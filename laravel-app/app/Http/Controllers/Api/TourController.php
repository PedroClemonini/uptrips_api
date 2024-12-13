<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTourRequest;
use Exception;
use Illuminate\Support\Facades\DB;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Tour::all();
        return response()->json($response, 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTourRequest $request)
    {
        try {
            // Use transação para garantir consistência
            $tour = DB::transaction(function () use ($request) {
                return Tour::create($request->validated());
            });

            return response()->json([
                'message' => 'tour created successfully',
                'destination' => $tour,
            ], 201);
        } catch (\Exception $e) {
            // Retorne uma mensagem amigável em caso de erro
            return response()->json([
                'message' => 'Failed to create tour',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tour $tour)
    {
        try {
            if ($tour != null) {
                return response()->json($tour, 200);
            } else {
                return response()->json([
                    'message' => 'An error occured while retrieving the hosting',
                ], 404);
            }
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occured while retrieving the feedback',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tour $tour)
    {
        $data = $request->validated();

        DB::transaction(function () use ($tour, $data) {
            $tour->update($data);
        });
        return response()->json(['message' => 'Tour Updated Sucessfully', 'tour' => $tour]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        try {
            DB::transaction(function () use ($tour) {
                $tour->delete();
            });
            return response()->json([
                'message' => 'Tour deleted successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete tour',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
