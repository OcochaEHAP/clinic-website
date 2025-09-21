<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
        public function create()
    {
        return view('admin.users.create');
    }

     public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role'     => 'required|in:admin,assistant',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // bcrypt hash
            'role'     => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }




    public function index()
{
    $users = User::orderBy('role')->orderBy('name')->get();
    return view('admin.users.index', compact('users'));
}
public function destroy($id)
{
    $user = User::findOrFail($id);

    if ($user->role === 'admin') {
        return back()->with('error', 'Impossible de supprimer un administrateur.');
    }

    $user->delete();

    return back()->with('success', 'Utilisateur supprimé avec succès.');
}

public function edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.users.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $request->validate([
        'name'  => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        'role'  => 'required|in:admin,assistant',
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    $user->name  = $request->name;
    $user->email = $request->email;
    $user->role  = $request->role;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
}


}
