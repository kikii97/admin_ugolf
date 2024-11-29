<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RoleController extends Controller
{
    private $apiUrl;
    protected $permissionNames;

    public function __construct()
    {
        $this->apiUrl = config('app.api_url', env('API_URL'));

        $this->permissionNames = [
            'merchant.view' => 'Lihat Data Merchant',
            'merchant.create' => 'Tambah Data Merchant',
            'merchant.edit' => 'Edit Data Merchant',
            'merchant.delete' => 'Hapus Data Merchant',
            'terminal.view' => 'Lihat Data Terminal',
            'terminal.create' => 'Tambah Data Terminal',
            'terminal.edit' => 'Edit Data Terminal',
            'terminal.delete' => 'Hapus Data Terminal',
            'cms.view' => 'Lihat Data CMS',
            'cms.create' => 'Tambah Data CMS',
            'cms.edit' => 'Edit Data CMS',
            'cms.delete' => 'Hapus Data CMS',
            'payment type.view' => 'Lihat Data Payment Type',
            'payment type.create' => 'Tambah Data Payment Type',
            'payment type.edit' => 'Edit Data Payment Type',
            'payment type.delete' => 'Hapus Data Payment Type',
            'config.view' => 'Lihat Data Config',
            'config.create' => 'Tambah Data Config',
            'config.edit' => 'Edit Data Config',
            'config.delete' => 'Hapus Data Config',
            'transaction.view' => 'Lihat Data Transaction',
            'transaction.create' => 'Tambah Data Transaction',
            'transaction.edit' => 'Edit Data Transaction',
            'transaction.delete' => 'Hapus Data Transaction',
            'role.view' => 'Lihat Data Role',
            'role.create' => 'Tambah Data Role',
            'role.edit' => 'Edit Data Role',
            'role.delete' => 'Hapus Data Role',
        ];    
    }

    public function index(Request $request)
    {
        $permissionNames = $this->permissionNames;

        $response = Http::withToken(session('jwt_token'))->get("{$this->apiUrl}/roles/create");
        return view('role.index', [
            'permissionNames' => $permissionNames,
            'roles' => $response->json('roles'),
            'groupedPermissions' => $response->json('permissions'),
        ]);
    }

    public function create()
    {
        $response = Http::get("{$this->apiUrl}/roles/create");

        if ($response->successful()) {
            return view('roles.create', [
                'groupedPermissions' => $response->json('permissions'),
            ]);
        }

        return back()->withErrors(['error' => 'Failed to fetch permissions data from API.']);
    }

    public function store(Request $request)
    {
        $response = Http::post("{$this->apiUrl}/roles", [
            'name' => $request->name,
            'permissions' => $request->permissions
        ]);

        if ($response->successful()) {
            return redirect()->route('roles.index')->with('success', 'Role created successfully');
        }

        return back()->withErrors(['error' => 'Failed to create role.']);
    }

    public function edit($id)
    {
        $response = Http::get("{$this->apiUrl}/roles/{$id}/edit");

        if ($response->successful()) {
            return view('roles.edit', [
                'role' => $response->json('role'),
                'rolePermissions' => $response->json('rolePermissions'), // Mengirim rolePermissions ke blade
                'groupedPermissions' => $response->json('groupedPermissions'),
            ]);
        }

        return back()->withErrors(['error' => 'Failed to fetch role data from API.']);
    }

    public function update(Request $request, $id)
    {
        $response = Http::put("{$this->apiUrl}/roles/{$id}", [
            'name' => $request->name,
            'permissions' => $request->permissions
        ]);

        if ($response->successful()) {
            return redirect()->route('roles.index')->with('success', 'Role updated successfully');
        }

        return back()->withErrors(['error' => 'Failed to update role.']);
    }

    public function destroy($id)
    {
        $response = Http::delete("{$this->apiUrl}/roles/{$id}");

        if ($response->successful()) {
            return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
        }

        return back()->withErrors(['error' => 'Failed to delete role.']);
    }


    public function indexAssignRole(Request $request)
    {
        $response = Http::withToken(session('jwt_token'))->get("{$this->apiUrl}/roles/create");
        return view('role.assign', [
            'roles' => $response->json('roles'),
            'groupedPermissions' => $response->json('permissions'),
        ]);
    }

    public function assignRole(Request $request, $userId)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . session('jwt_token'),
            'Accept' => 'application/json',
        ])->put(env('API_URL') . "/roles/assign/{$userId}", [
            'roles' => $request->roles,
        ]);

        if ($response->successful()) {
            return redirect()->route('roles.index')->with('success', 'User roles updated successfully');
        }

        return back()->withErrors(['error' => 'Failed to update user roles']);
    }

}
