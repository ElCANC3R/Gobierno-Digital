<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    public function index(Request $request): JsonResponse
    {

        $users = User::paginate();
        $isAdmin = auth()->user()->roles->contains('slug', 'admin');

        return response()->json([
            'users' => $users,
            'isAdmin' => $isAdmin,
        ]);
    }


    public function store(UserRequest $request): JsonResponse
    {
        $user = User::create($request->validated());


        return response()->json([
            'message' => 'User created successfully.',
            'user' => $user,
        ], 201);
    }


    public function show($id): JsonResponse
    {

        $user = User::find($id);


        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }


        return response()->json([
            'user' => $user,
        ]);
    }


    public function update(UserRequest $request, User $user): JsonResponse
    {

        if (!auth()->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }


        $user->update($request->validated());


        if ($request->has('roles')) {
            $user->roles()->sync($request->roles);
        }


        return response()->json([
            'message' => 'User updated successfully.',
            'user' => $user,
        ]);
    }


    public function destroy($id): JsonResponse
    {

        if (!auth()->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }


        $user = User::find($id);


        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }


        $user->delete();

        
        return response()->json([
            'message' => 'User deleted successfully.',
        ]);
    }
}
