<?php

namespace App\Http\Controllers;

use App\Models\LevelUser;
use Exception;
use Illuminate\Http\Request;

class LevelUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $levelUser = LevelUser::all();
            return response()->json($levelUser);
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
        return view('levelUser.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'userDescription' => 'required|string'
        ]);

        try {

            $levelUser = LevelUser::create($data);


            return response()->json([
                'message' => 'hosting created successfully',
                'levelUser' => $levelUser,
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message' => 'An error occurred while creating the level',
                'error' => $e->getMessage(),
            ], 500);
        }




    }

    /**
     * Display the specified resource.
     */
    public function show(LevelUser $levelUser)
    {
        try{
            if(!$levelUser) {
                return response()->json([
                    'message' => 'Level not found'
                ], 404);
            }

            return response()->json($levelUser, 201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the level',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LevelUser $levelUser)
    {
        return view('levelUser.edit', compact($levelUser));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LevelUser $levelUser)
    {
        $data = $request->validate([
            'userDescription' => 'required|string',
        ]);

        try{
            if (!$levelUser) {
                return response()->json([
                    'message' => 'Level not found'

                ], 404);
            }

            $levelUser->update($data);

            return response()->json([
                'message' => 'Level updated succesfully',
                'level' => $levelUser,
            ], 201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the level',
                'error' => $e->getMessage()
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LevelUser $levelUser)
    {
        try{
            if(!$levelUser){
                return response()->json(['message'=>'Level not found'], 404);
            }
            $levelUser->delete();
            return response()->json([
                'message' => 'Level deleted successfully',
            ],201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the Level',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
