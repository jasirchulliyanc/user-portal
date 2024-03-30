<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Exception;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
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
                $user->addMedia($request->image)
                    ->toMediaCollection('image');
                DB::commit();
                $response = [
                    'status' => 'success',
                    'message' => 'User created successfully!'
                ];
                return redirect()->route('user.index')->with($response);
            }
        } catch (Exception $e) {
            DB::rollback();
        }
        $response = [
            'status' => 'error',
            'message' => 'Failed to create user!'
        ];

        // return redirect()->back()->with($response);
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

                $response = ['status' => 'success', 'message' => 'User updated successfully!'];
                DB::commit();
                return redirect()->route('user.index')->with($response);
            }


        } catch (Exception $e) {
            DB::rollback();
            $response = [
                'status' => 'error',
                'message' => 'Failed to create user!'
            ];
            return redirect()->back()->with($response);
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

                $response = ['status' => 'success', 'message' => 'User deleted successfully!'];
                DB::commit();
                return redirect()->route('user.index')->with($response);
            }

        } catch (Exception $e) {
            $response = [
                'status' => 'error',
                'message' => 'Failed to delete user!'
            ];
            return redirect()->back()->with($response);
        }
    }
}
