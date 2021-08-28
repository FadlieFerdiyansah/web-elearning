<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = collect(['admin','dosen','mahasiswa']);
        $permissionMhs = collect(['jadwal kuliahm']);
        $permissionDsn = collect(['jadwal kuliahd','management nilai','management materi','management absen']);
        $permissionAdm = collect(['management roles and permissions','management users','management datatable']);
        $roles->each(function($role){
            Role::create([
                'name' => $role,
                'guard_name' => $role,
            ]);
        });

        $permissionMhs->each(function($permission){
            Permission::create([
                'name' => $permission,
                'guard_name' => 'mahasiswa'
            ]);
        });

        $permissionDsn->each(function($permission){
            Permission::create([
                'name' => $permission,
                'guard_name' => 'dosen'
            ]);
        });

        $roleMhs = Role::find(3);
        $roleMhs->givePermissionTo(['jadwal kuliahm']);

        $roleDsn = Role::find(2);
        $roleDsn->givePermissionTo(['management nilai','management materi','management absen','jadwal kuliahd']);
    }
}
