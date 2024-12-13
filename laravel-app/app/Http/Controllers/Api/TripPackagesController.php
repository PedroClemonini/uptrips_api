<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreTripPackageRequest;
use App\Models\TripPackage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\DB;

class TripPackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = TripPackage::all();
        return response()->json($response, 201);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripPackageRequest $request)
    {
        try {

            $package = DB::transaction(function () use ($request) {
                return TripPackage::create($request->validated());
            });

            return response()->json([
                'message' => 'TripPackage created successfully',
                'tripPackage' => $package,
            ], 201);
        } catch (\Exception $th) {
            // Captura o erro e retorna uma mensagem amigável
            return response()->json([
                'message' => 'Failed to create TripPackage',
                'error' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TripPackage $tripPackages)
    {
        try {
            if ($tripPackages != null) {
                return response()->json($tripPackages, 200);
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
    public function edit(TripPackage $TripPackages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TripPackage $tripPackage)
    {
        $data = $request->validated();

        DB::transaction(function () use ($tripPackage, $data) {
            $tripPackage->update($data);
        });
        return response()->json(['message' => 'TripPackage Updated Sucessfully', 'trip' => $tripPackage]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TripPackage $tripPackages)
    {
        try {
            DB::transaction(function () use ($tripPackages) {
                $tripPackages->delete();
            });
            return response()->json([
                'message' => 'Trip deleted successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete trip',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
