<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
      /**
      * Affiche la vue pour affecter des permissions à un rôle.
      *
      * @param int $roleId
      * @return \Illuminate\View\View
      */
      public function index($roleId)
      {
         $role = Role::findById($roleId);
         if (!$role) {
         abort(404);
         }
         $permissions = Permission::all();
        //  dd($permissions);

         return view('roles.show', compact('role', 'permissions'));
      }


      /**
      * Affecte les permissions sélectionnées à un rôle donné.
      *
      * @param \Illuminate\Http\Request $request
      * @param int $roleId
      * @return \Illuminate\Http\RedirectResponse
      */
      public function assign(Request $request, $roleId)
      {
          $role = Role::findById($roleId);
          if (!$role) {
          abort(404);
          }
          $permissions = array_map('intval', $request->input('permissions', []));
        //   dd($permissions);
          $role->syncPermissions($permissions);
          return redirect()->route('roles.index')
          ->with('success', 'Les permissions ont été affectées au rôle.');
      }
}
