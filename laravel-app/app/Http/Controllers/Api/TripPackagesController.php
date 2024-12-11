<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\StoreTripPackageRequest;
use App\Models\TripPackage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TripPackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

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
    public function show(TripPackage $TripPackages)
    {
        //
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
    public function update(Request $request, TripPackage $TripPackages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TripPackage $TripPackages)
    {
        //
    }
}
