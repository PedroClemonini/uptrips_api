<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHostingRequest;
use App\Models\Hosting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HostingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Hosting::all();
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
    public function store(StoreHostingRequest $request)
    {
        try {
            // Use transação para garantir consistência
            $hosting = DB::transaction(function () use ($request) {
                return Hosting::create($request->validated());
            });

            return response()->json([
                'message' => 'Hosting created successfully',
                'destination' => $hosting,
            ], 201);
        } catch (\Exception $e) {
            // Retorne uma mensagem amigável em caso de erro
            return response()->json([
                'message' => 'Failed to create hosting',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Hosting $hosting)
    {

        try {
            if ($hosting != null) {
                return response()->json($hosting, 200);
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
    public function update(Request $request, Hosting $hosting)
    {
        $data = $request->validated();

        DB::transaction(function () use ($hosting, $data) {
            $hosting->update($data);
        });
        return response()->json(['message' => 'Hosting Updated Sucessfully', 'hosting' => $hosting]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hosting $hosting)
    {
        try {
            DB::transaction(function () use ($hosting) {
                $hosting->delete();
            });
            return response()->json([
                'message' => 'Hosting deleted successfully',
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete hosting',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
