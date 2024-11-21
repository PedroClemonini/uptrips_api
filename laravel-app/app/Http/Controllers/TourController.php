<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use Exception;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $tour = Tour::all();
            return response()->json($tour);
        }catch(Exception $e){
            return response()->json([
                'error' => 'An error occurred when try to return this',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tour.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
           'tourName' => 'required|string|max:255',
           'description' => 'required|string',
           'duration' => 'required|date_format:Y-m-d H:i:s',
           'price' => 'required|integer|min:0',
           'availableDate' => 'required|date',
           'tourId' => 'required|exists:reservations,id',
        ]);

        try {

            $tour = Tour::create($data);

            return response()->json([
                'message' => 'tour created successfully',
                'tour' => $tour,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the tour',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tour $tour)
    {
        try{
            if(!$tour) {
                return response()->json([
                    'message' => 'tour not found'
                ], 404);
            }

            return response()->json($tour, 201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the tour',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tour $tour)
    {
        return view('tour.edit', compact($tour));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tour $tour)
    {
        $data = $request->validate([
           'tourName' => 'required|string|max:255',
           'description' => 'required|string',
           'duration' => 'required|date_format:Y-m-d H:i:s',
           'price' => 'required|integer|min:0',
           'availableDate' => 'required|date',
           'reservationId' => 'required|exists:reservations,id',
        ]);

        try{
            if (!$tour) {
                return response()->json([
                    'message' => 'Tour not found'

                ], 404);
            }

            $tour->update($data);

            return response()->json([
                'message' => 'Tour updated succesfully',
                'tour' => $tour,
            ], 201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the Tour',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        try{
            if(!$tour){
                return response()->json(['message'=>'Tour not found'], 404);
            }
            $tour->delete();
            return response()->json([
                'message' => 'Tour deleted successfully',
            ],201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the Tour',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
