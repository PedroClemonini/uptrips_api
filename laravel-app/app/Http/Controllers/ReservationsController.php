<?php

namespace App\Http\Controllers;

use App\Models\Reservations;
use Exception;
use Illuminate\Http\Request;

class ReservationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $reservations = Reservations::all();
            return response()->json($reservations);
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
        return view('reservations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'tripDate' => 'required|date',
            'startDate' => 'required|date|before_or_equal:endDate',
            'endDate' => 'required|date|after_or_equal:startDate',
            'totalPriceInCents' => 'required|integer|min:0',
            'status' => 'nullable|in:Pending,Confirmed,Cancelled,InProgress,Completed',
            'observations' => 'nullable|string',
            'packageId' => 'required|exists:packages,id',
            'customerId' => 'required|exists:users,id',
        ]);

        try {

            $reservation = Reservations::create($data);

            return response()->json([
                'message' => 'Reservation created successfully',
                'reservation' => $reservation,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the reservation',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservations $reservations)
    {
        try{
            if(!$reservations) {
                return response()->json([
                    'message' => 'Reservation not found'
                ], 404);
            }

            return response()->json($reservations, 201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the reservations',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservations $reservations)
    {
        return view('reservations.edit', compact($reservations));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservations $reservations)
    {
       $data = $request->validate([
            'tripDate' => 'required|date',
            'startDate' => 'required|date|before_or_equal:endDate',
            'endDate' => 'required|date|after_or_equal:startDate',
            'totalPriceInCents' => 'required|integer|min:0',
            'status' => 'nullable|in:Pending,Confirmed,Cancelled,InProgress,Completed',
            'observations' => 'nullable|string',
            'packageId' => 'required|exists:packages,id',
            'customerId' => 'required|exists:users,id',
        ]);

        try{
            if (!$reservations) {
                return response()->json([
                    'message' => 'Reservation not found'

                ], 404);
            }

            $reservations->update($data);

            return response()->json([
                'message' => 'Reservation updated succesfully',
                'level' => $reservations,
            ], 201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the Reservation',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservations $reservations)
    {
        try{
            if(!$reservations){
                return response()->json(['message'=>'Reservation not found'], 404);
            }
            $reservations->delete();
            return response()->json([
                'message' => 'Reservation deleted successfully',
            ],201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the Reservation',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
