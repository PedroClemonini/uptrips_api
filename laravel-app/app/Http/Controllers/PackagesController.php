<?php

namespace App\Http\Controllers;

use App\Models\Packages;
use Exception;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $packages = Packages::all();
            return response()->json($packages);
        } catch(Exception $e){
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
        return view('packages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'packageName' => 'required|string|unique:packages,packageName|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'startDate' => 'required|date|before_or_equal:endDate',
            'endDate' => 'required|date|after_or_equal:startDate',
            'maxPeople' => 'required|integer|min:1',
            'isActive' => 'sometimes|boolean',
            'tripId' => 'required|exists:trips,id'
        ]);

        try {

            $package = Packages::create($data);

            return response()->json([
                'message' => 'Package created successfully',
                'package' => $package,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the package',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Packages $packages)
    {
        try{
            if(!$packages) {
                return response()->json([
                    'message' => 'Packages not found'
                ], 404);
            }

            return response()->json($packages, 201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the packages',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Packages $packages)
    {
        return view('packages.edit', compact($packages));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Packages $packages)
    {
        $data = $request->validate([
            'packageName' => 'required|string|unique:packages,packageName|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'startDate' => 'required|date|before_or_equal:endDate',
            'endDate' => 'required|date|after_or_equal:startDate',
            'maxPeople' => 'required|integer|min:1',
            'isActive' => 'sometimes|boolean',
            'tripId' => 'required|exists:trips,id'
        ]);

        try{
            if (!$packages) {
                return response()->json([
                    'message' => 'Packages not found'

                ], 404);
            }

            $packages->update($data);

            return response()->json([
                'message' => 'Packages updated succesfully',
                'packages' => $packages,
            ], 201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the Packages',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Packages $packages)
    {
        try{
            if(!$packages){
                return response()->json(['message'=>'packages not found'], 404);
            }
            $packages->delete();
            return response()->json([
                'message' => 'Packages deleted successfully',
            ],201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the Packages',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
