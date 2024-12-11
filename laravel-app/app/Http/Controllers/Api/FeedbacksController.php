<?php

namespace App\Http\Controllers\Api;

use App\Models\Feedbacks;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class FeedbacksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $feedbacks = Feedbacks::all();

            return response()->json($feedbacks);
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
        return view('feedbacks.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'feedbackNotes' => 'nullable|in:1,2,3,4,5',
            'date' => 'required|date',
            'user_id' => 'required|exists:users,id'
        ]);

        try {

            $feedback = Feedbacks::create($data);


            return response()->json([
                'message' => 'Feedback created successfully',
                'feedback' => $feedback,
            ], 201);

        } catch (Exception $e) {

            return response()->json([
                'message' => 'An error occurred while creating the feedback',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Feedbacks $feedbacks)
    {
        try{
            if(!$feedbacks) {
                return response()->json([
                    'message' => 'Feedback not found'
                ], 404);
            }

            return response()->json($feedbacks, 201);

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
    public function edit(Feedbacks $feedbacks)
    {
        return view('feedbacks.edit', compact($feedbacks));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feedbacks $feedbacks)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'feedbackNotes' => 'nullable|in:1,2,3,4,5',
            'date' => 'required|date',
            'user_id' => 'required|exists:users,id'

        ]);

        try{
            if (!$feedbacks) {
                return response()->json([
                    'message' => 'Feedback not found'

                ], 404);
            }

            $feedbacks->update($data);

            return response()->json([
                'message' => 'Feedback updated succesfully',
                'feedback' => $feedbacks,
            ], 200);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the feedback',
                'error' => $e->getMessage()
            ], 500);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feedbacks $feedbacks)
    {
        try{
            if(!$feedbacks){
                return response()->json(['message'=>'Feedback not found'], 404);
            }
            $feedbacks->delete();
            return response()->json([
                'message' => 'Feedback deleted successfully',
            ],201);

        }catch(Exception $e){
            return response()->json([
                'message' => 'An error occured while retrieving the Feedback',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
