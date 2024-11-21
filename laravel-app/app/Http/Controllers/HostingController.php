<?php

namespace App\Http\Controllers;

use App\Models\Hosting;
use Exception;
use Illuminate\Http\Request;

class HostingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $hosting = Hosting::all();

            return response()->json($hosting);
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
        return view('hosting.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Hotel,Hostel,Pousada,Airbnb,Resort',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'price' => 'required|integer|min:0',
            'destinationId' => 'required|exists:destination,id',
        ]);

        try {

            $hosting = Hosting::create($data);


            return response()->json([
                'message' => 'hosting created successfully',
                'hosting' => $hosting,
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message' => 'An error occurred while creating the hosting',
                'error' => $e->getMessage(),
            ], 500);
        }



    }

    /**
     * Display the specified resource.
     */
    public function show(Hosting $hosting)
    {
        try{
            if(!$hosting) {
                return response()->json([
                    'message' => 'Hosting not found'
                ], 404);
            }

            return response()->json($hosting, 201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the hosting',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hosting $hosting)
    {
        return view('hosting.edit', compact($hosting));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hosting $hosting)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Hotel,Hostel,Pousada,Airbnb,Resort',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'price' => 'required|integer|min:0',
            'destinationId' => 'required|exists:destination,id',
        ]);

        try{
            if (!$hosting) {
                return response()->json([
                    'message' => 'Hosting not found'

                ], 404);
            }

            $hosting->update($data);

            return response()->json([
                'message' => 'Hosting updated succesfully',
                'hosting' => $hosting,
            ], 201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the Hosting',
                'error' => $e->getMessage()
            ], 500);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hosting $hosting)
    {
        try{
            if(!$hosting){
                return response()->json(['message'=>'Hosting not found'], 404);
            }
            $hosting->delete();
            return response()->json([
                'message' => 'Hosting deleted successfully',
            ],201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the Hosting',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
