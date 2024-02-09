<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
        public function index()
        {
        $permissions = Permission::all();
        return view('permissions.index', compact('permissions'));
        }


        public function create()
        {
        return view('permissions.create');
        }


        public function store(Request $request)
        {
        $validated = $request->validate([
        'name' => 'required|unique:permissions|max:255',
        ]);
        $permission = Permission::create([
            'name' => $validated['name'],
        ]);
        return redirect()->route('permissions.index')
        ->with('success','Permission created successfully.');
        }


        public function show(Permission $permission)
        {
        return view('permissions.show',compact('permission'));
        }


        public function edit(Permission $permission)
        {
        return view('permissions.edit',compact('permission'));
        }


        public function update(Request $request, Permission $permission)
        {
        $validated = $request->validate([
        'name' => 'required|unique:permissions,name,'.$permission->id.'|max:255',
        ]);
        $permission->name = $validated['name'];
        $permission->save();
        return redirect()->route('permissions.index')
        ->with('success','Permission updated successfully');
        }


        public function destroy(Permission $permission)
        {
        $permission->delete();
        return redirect()->route('permissions.index')
        ->with('success','Permission deleted successfully');
        }
}
