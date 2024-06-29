<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        
        $roles = [
            ['name' => 'admin'],
            ['name' => 'member'],
        ];

        $submodule_templates = [
            [
                'name' => 'Products',
                'model' => 'Product'
            ],
            [
                'name' => 'Tasks',
                'model' => 'Task'
            ],
            [
                'name' => 'Workers',
                'model' => 'Person'
            ],
            [
                'name' => 'Clients',
                'model' => 'Person'
            ],
            [
                'name' => 'Inventory',
                'model' => 'Items'
            ],
            [
                'name' => 'Expenses',
                'model' => 'Activity'
            ]
        ];

        DB::table('roles')->insert($roles);
        DB::table('business_roles')->insert($roles);
        DB::table('submodule_templates')->insert($submodule_templates);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@crmaster.com',
            'password' => Hash::make('test@crmaster.com'),
        ]);

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@crmaster.com',
            'password' => Hash::make('admin@crmaster.com'),
        ]);

    }
}
