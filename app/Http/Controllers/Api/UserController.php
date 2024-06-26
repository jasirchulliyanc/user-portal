<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($role)
    {
        if(!$role == 'systemAdmin'){
            $users = User::whereHas('roles', function ($query) use($role) {
                $query->where('name', $role);
            })->paginate();
        } else{
            $users = User::paginate();
        }
        

        try {
            return response()->json([
                'success' => true,
                'message' => 'User Listed  Successfully!',
                'data' => UserResource::collection($users),
                'pagination' => [
                    'total' => $users->total(),
                    'per_page' => $users->perPage(),
                    'current_page' => $users->currentPage(),
                    'last_page' => $users->lastPage(),
                    'from' => $users->firstItem(),
                    'to' => $users->lastItem(),
                ],
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
            ], 500);
        }

    }
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 

            return response()->json([
                'success' => true,
                'message' => 'User Listed  Successfully!',
                'token' => $user->createToken('MyApp')->plainTextToken,
                'data' => new UserResource($user),
            ], 200);
        } 
        else{ 
            return response()->json([
                'success' => false,
                'message' => 'Unauthoriesed!',
            ], 500);
        } 
    }
public function getUser($userId){

    $users = User::select('first_name', 'last_name', 'email', 'position')->with('roles')->find($userId);

        try {
            return response()->json([
                'success' => true,
                'message' => 'User details Successfully!',
                'data' => new UserResource($users),
            ], 200);
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
            ], 500);
        }
}
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = User::create($request->all());
            if ($user) {
                $user->assignRole($request->role);
                // $user->addMedia($request->image)
                //     ->toMediaCollection('image');
                DB::commit();
                return response()->json([
                    'success' => true,
                    'token' =>  $user->createToken('MyApp')->plainTextToken,
                    'message' => 'User created successfully!',
                    'data' => new UserResource($user),
                ], 200);
            }
        } catch (Exception $e) {
            DB::rollback();
        }
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong!'. $e,
        ], 500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {

        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            DB::beginTransaction();
            $user->update($request->all());
            if ($user) {
                $user->assignRole($request->role);
                if ($request->image) {
                    $user->clearMediaCollection('image');
                    $user->addMedia($request->image)
                        ->toMediaCollection('image');
                }
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'User updated successfully!',
                    'data' => new UserResource($user),
                ], 200);
            }


        } catch (Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

        try {
            DB::beginTransaction();

            if ($user->delete()) {

                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'User deleted successfully!',
                ], 200);
            }

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
            ], 500);
        }
    }
}
