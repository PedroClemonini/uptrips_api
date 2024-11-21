<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Exception;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $destination = Destination::all();

            return response()->json($destination);
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
       return view('destination.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
        ]);

        $destination = new Destination();
        $destination->fill($data);
        $destination->save();

        return response()->json([
            'message' => 'Destination created succesfully',
            'destination' => $destination,
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        try{
            if(!$destination) {
                return response()->json([
                    'message' => 'Feedback not found'
                ], 404);
            }

            return response()->json($destination, 201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the feedback',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        return view('destination.edit', compact($destination));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
        ]);

        try{
            if (!$destination) {
                return response()->json([
                    'message' => 'destination not found'

                ], 404);
            }

            $destination->update($data);

            return response()->json([
                'message' => 'destination updated succesfully',
                'destination' => $destination,
            ], 201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the destination',
                'error' => $e->getMessage()
            ], 500);
        }



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {
        try{
            if(!$destination){
                return response()->json(['message'=>'Destination not found'], 404);
            }
            $destination->delete();
            return response()->json([
                'message' => 'Destination deleted successfully',
            ],201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the destination',
                'error' => $e->getMessage()
            ], 500);
        }

    }
}
