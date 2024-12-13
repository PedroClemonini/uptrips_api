<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReservationRequest;
use App\Models\Reservation;
use Exception;
use Illuminate\Container\Attributes\Log;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        try {
            $data = Reservation::all();
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
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        try {
            $reservation = Reservation::createReservationData($request->validated());

            return response()->json([
                'message' => 'Reservation created successfully',
                'reservation_id' => $reservation->id,
                'reservation' => $reservation,
            ], 201);
        } catch (QueryException $e) {
            return response()->json([
                'message' => 'Failed to create reservation due to a database error',
                'error' => $e
            ], 500);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Retorne uma mensagem amigável em caso de erro inesperado
            return response()->json([
                'message' => 'Failed to create reservation',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        try {
            if ($reservation != null) {
                return response()->json($reservation, 200);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $data = $request->validated();

        DB::transaction(function () use ($reservation, $data) {
            $reservation->update($data);
        });
        return response()->json(['message' => 'Reservation Updated Sucessfully', 'reservation' => $reservation]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
         try{
            DB::transaction(function () use ($reservation){
                $reservation->delete();
            });
            return response()->json([
                'message' => 'Reservation deleted successfully',
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Failed to delete reservation',
                'error' => $e->getMessage(),
            ], 500);
        }

    }
}
