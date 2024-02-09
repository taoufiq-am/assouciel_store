<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
      public function index(User $user)
      {
          $users = User::all();
          $userRoles = $user->roles;
          return view('user_roles.index', compact('users', 'userRoles'));
      }


      public function create(User $user)
      {
          $roles = Role::all();
          $userRoles = $user->roles;
          return view('user_roles.create', compact('roles', 'user', 'userRoles'));
      }

      public function assignRoles(Request $request, User $user)
      {
          $validatedData = $request->validate([
          'roles' => 'required|array',
          'roles.*' => 'exists:roles,id',
          ]);
          $roles = Role::whereIn('id', $validatedData['roles'])->get();
          $user->syncRoles($roles);
          return redirect()->route('user_roles.index')->with('success', 'Les rôles de l\'utilisateur ont été modifiés avec succès.');
      }
}
