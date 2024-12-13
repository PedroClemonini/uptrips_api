<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Reservation;
use App\Models\User;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $user = User::all();
            return response()->json($user);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'An error occurred when try to return this',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return View
     */
    public function create() {}



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)

    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'levelUser' => 'nullable|exists:level_user,id',
        ]);

        $data['password'] = bcrypt($data['password']);

        $data['levelUser'] = $data['levelUser'] ?? 1;

        $user = new User();
        $user->fill($data);
        $user->save();


        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        try {
            if (!$user) {
                return response()->json([
                    'message' => 'User not found'
                ], 404);
            }

            return response()->json($user, 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occured while retrieving the user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

       /**
     * Show the form for editing the specified resource.
     * @return View
     */
    public function edit(User $user)
    {
        return view('user.edit', compact($user));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email',
            'password' => 'nullable|string|min:8|confirmed',
            'levelUser' => 'nullable|exists:level_user,id',
        ]);

        if (isset($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        }

        try {
            if (!$user) {
                return response()->json([
                    'message' => 'Hosting not found'

                ], 404);
            }

            $user->update($data);

            return response()->json([
                'message' => 'User updated succesfully',
                'user' => $user,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occured while retrieving the User',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }
            $user->delete();
            return response()->json([
                'message' => 'User deleted successfully',
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'message' => 'An error occured while retrieving the User',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
