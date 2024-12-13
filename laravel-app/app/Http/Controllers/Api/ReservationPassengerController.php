<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReservationPassenger;
use Illuminate\Http\Request;

class ReservationPassengerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = reservationPassenger::all();
            return response()->json($data, 201);
        } catch (\Exception $e) {
            // Retorne uma mensagem amigável em caso de erro
            return response()->json([
                'message' => 'There is no reservation for this passenger',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ReservationPassenger $reservationPassenger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReservationPassenger $reservationPassenger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReservationPassenger $reservationPassenger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReservationPassenger $reservationPassenger)
    {
        //
    }
}
