<?php

namespace App\Http\Controllers;

use App\Models\Transport;
use Exception;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $transport = Transport::all();
            return response()->json($transport);
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
        return view('transport.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'required|in:onibus,van,carro',
            'capacity' => 'required|integer|min:1',
            'transportCompany' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'licensePlate' => 'required|string|max:20|unique:transport,licensePlate',
            'manufactureYear' => 'required|string|size:4|regex:/^\d{4}$/',
        ]);

        try {

            $transport = Transport::create($data);

            return response()->json([
                'message' => 'transport created successfully',
                'transport' => $transport,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the transport',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transport $transport)
    {
        try{
            if(!$transport) {
                return response()->json([
                    'message' => 'transport not found'
                ], 404);
            }

            return response()->json($transport, 201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the transport',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transport $transport)
    {
        return view('transport.edit', compact($transport));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transport $transport)
    {
        $data = $request->validate([
            'type' => 'required|in:onibus,van,carro',
            'capacity' => 'required|integer|min:1',
            'transportCompany' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'licensePlate' => 'required|string|max:20|unique:transport,licensePlate',
            'manufactureYear' => 'required|string|size:4|regex:/^\d{4}$/',
        ]);

        try{
            if (!$transport) {
                return response()->json([
                    'message' => 'Transport not found'

                ], 404);
            }

            $transport->update($data);

            return response()->json([
                'message' => 'Transport updated succesfully',
                'transport' => $transport,
            ], 201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the Transport',
                'error' => $e->getMessage()
            ], 500);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transport $transport)
    {
        try{
            if(!$transport){
                return response()->json(['message'=>'Transport not found'], 404);
            }
            $transport->delete();
            return response()->json([
                'message' => 'Transport deleted successfully',
            ],201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the Transport',
                'error' => $e->getMessage()
            ], 500);
        }

    }
}
