<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Admin', 'Project Manager', 'Engineer', 'Reviewer', 'Contractor', 'Client'] as $role) {
            DB::table('roles')->insert(['name' => $role, 'created_at' => now(), 'updated_at' => now()]);
        }

        $admin = User::create([
            'name' => 'System Admin',
            'email' => 'admin@edms.local',
            'password' => Hash::make('Admin@12345'),
        ]);

        Project::create([
            'code' => 'PRJ-001',
            'name' => 'Metro Expansion',
            'description' => 'Sample seeded project',
            'status' => 'active',
            'created_by' => $admin->id,
        ]);
    }
}
