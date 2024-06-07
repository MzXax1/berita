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

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validasi input
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'nullable|string|min:6|confirmed',
        'role' => 'sometimes|string|in:2,0', // Hanya jika perlu, tergantung pada logika aplikasi Anda
    ]);

    try {
        // Temukan pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Periksa apakah pengguna yang sedang masuk adalah admin dan bukan pengguna yang ingin diubah perannya
        if (auth()->user()->role == 1 && $user->id != auth()->user()->id) {
            // Update data pengguna
            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'role' => $validatedData['role'], // Pastikan 'role' sesuai dengan representasi dalam basis data
                // Jangan lupa hash kata sandi jika diperbarui
                'password' => isset($validatedData['password']) ? bcrypt($validatedData['password']) : $user->password,
            ]);
        } else {
            // Jika bukan admin, perbarui data tanpa memperbarui peran
            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                // Jangan lupa hash kata sandi jika diperbarui
                'password' => isset($validatedData['password']) ? bcrypt($validatedData['password']) : $user->password,
            ]);
        }

        return back()->with('success', 'User has been updated!');
    } catch (\Exception $e) {
        // Tangani kesalahan
        return back()->with('error', 'Failed to update user.');
    }
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
