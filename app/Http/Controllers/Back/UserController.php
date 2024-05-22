<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   

        if (auth()->user()->role == 1) {
            $users = User::get();
        } else {
            $users = User::whereId(auth()->user()->id)->get();
        }
        

        return view('back.user.index', [
            'users' => $users,
            'name' => 'name',
            'email' => 'email',
            'password' => 'password',
            'created_at' => 'created_at',

        ]);
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
    public function store(UserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);
        User::create($data);

        return back()->with('success', 'User has been registered!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUPdateRequest $request, string $id)
    {
        $data = $request->validated();

        
        if ($data['password'] != '') {
            $data['password'] = bcrypt($data['password']);
            User::find($id)->create($data);
        } else {
            User::find($id)->update([
                'name' => $data['name'],
                'email' => $data['email']
            ]);
        }
        

        return back()->with('success', 'User has been updated!!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return back()->with('success', 'Categories has been deleted');
    }
}
