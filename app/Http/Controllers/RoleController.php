<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = new Role();
        $permission = Permission::get();
        $roles = Role::orderBy('id', 'ASC')->get();
        return view('roles.index', compact('roles', 'permission', 'role'));
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
    public function store(Request $request)
    {
        

        $role = Role::create(['name' => $request->input('role')]);
        $role->syncPermissions($request->input('permissions'));



        return redirect()->back()
            ->with('success', 'Role created successfully');
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
    public function update(Request $request, string $id)
    {
        $test[] = $request->permission;
        dd($test);
        $role = Role::find($id);
        $name = $role->name;
        $test = \DB::table('roles')->where('name', $name)->update([
            'name' => $request->role,
        ]);

        $role->syncPermissions($request->input('permission'));

        return redirect()->back()
            ->with('success', 'Role updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->back()
            ->with('success', 'Role deleted successfully');
    }
}
