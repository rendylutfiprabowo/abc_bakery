<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::insert([
            ['name' => 'Owner'],
            ['name' => 'Branch Manager'],
            ['name' => 'Cashier'],
            ['name' => 'Production Officer'],
            ['name' => 'Logistic Officer'],
        ]);
    }
}
