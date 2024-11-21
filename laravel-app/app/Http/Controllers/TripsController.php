<?php

namespace App\Http\Controllers;

use App\Models\Trips;
use Exception;
use Illuminate\Http\Request;

class TripsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $trips = Trips::all();
            return response()->json($trips);
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
        return view('trips.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
           'boardingPlace' => 'required|string|max:255',
           'landingPlace' => 'required|string|max:255',
           'numberReservation' => 'required|integer|min:1',
           'startDate' => 'required|date|before_or_equal:endDate',
           'endDate' => 'required|date|after_or_equal:startDate',
           'transportId' => 'required|exists:trips,id',
        ]);

         try {

            $trips = Trips::create($data);

            return response()->json([
                'message' => 'trips created successfully',
                'trips' => $trips,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the trips',
                'error' => $e->getMessage(),
            ], 500);
        }


    }

    /**
     * Display the specified resource.
     */
    public function show(Trips $trips)
    {
        try{
            if(!$trips) {
                return response()->json([
                    'message' => 'trips not found'
                ], 404);
            }

            return response()->json($trips, 201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the trips',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trips $trips)
    {
        return view('trips.edit', compact($trips));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Trips $trips)
    {
        $data = $request->validate([
           'boardingPlace' => 'required|string|max:255',
           'landingPlace' => 'required|string|max:255',
           'numberReservation' => 'required|integer|min:1',
           'startDate' => 'required|date|before_or_equal:endDate',
           'endDate' => 'required|date|after_or_equal:startDate',
           'transportId' => 'required|exists:transport,id',
        ]);

        try{
            if (!$trips) {
                return response()->json([
                    'message' => 'Trips not found'

                ], 404);
            }

            $trips->update($data);

            return response()->json([
                'message' => 'Trips updated succesfully',
                'trips' => $trips,
            ], 201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the Trips',
                'error' => $e->getMessage()
            ], 500);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trips $trips)
    {
        try{
            if(!$trips){
                return response()->json(['message'=>'Trips not found'], 404);
            }
            $trips->delete();
            return response()->json([
                'message' => 'Trips deleted successfully',
            ],201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the Trips',
                'error' => $e->getMessage()
            ], 500);
        }

    }
}
