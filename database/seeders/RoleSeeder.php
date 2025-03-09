<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $doctorRole = Role::firstOrCreate(['name' => 'doctor']);
        $patientRole = Role::firstOrCreate(['name' => 'patient']);

        // Create permissions
        $permissions = [
            'create_appointment',
            'view_appointment',
            'edit_appointment',
            'delete_appointment',
            'delete_user',
            'settings',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Assign all permissions to admin
        $adminRole->givePermissionTo(Permission::all());

        // Assign specific permissions to doctor
        $doctorRole->givePermissionTo([ 'view_appointment', 'edit_appointment', 'delete_appointment','create_appointment']);

        // Assign view-only permission to patient
        $patientRole->givePermissionTo(['create_appointment', 'view_appointment','delete_appointment']);

        // Create an admin user
        $admin = User::firstOrCreate([
            'email' => 'admin@gmail.com',
        ], [
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password123'), // Set a valid password
        ]);

        // Assign admin role
        $admin->assignRole('admin');

        echo "✅ Roles, permissions, and admin user seeded successfully!\n";
    }
}
