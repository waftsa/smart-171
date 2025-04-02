<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Jalankan database seeds.
     */
    public function run(): void
    {
        // Pastikan role "editor" hanya dibuat jika belum ada
        $editorRole = Role::firstOrCreate([
            'name' => 'editor',
            'guard_name' => 'web'
        ]);

        // Buat user pertama
        $userEditor1 = User::firstOrCreate([
            'email' => 'officesmart171@gmail.com'
        ], [
            'name' => 'SMART171',
            'password' => bcrypt('rnPAHbV8YyPpYRs')
        ]);
        $userEditor1->assignRole($editorRole);

        // Buat user kedua
        $userEditor2 = User::firstOrCreate([
            'email' => 'smart171tech@gmail.com'
        ], [
            'name' => 'SMART171',
            'password' => bcrypt('bKEca6wet5cK5UJ')
        ]);
        $userEditor2->assignRole($editorRole);
    }
}
