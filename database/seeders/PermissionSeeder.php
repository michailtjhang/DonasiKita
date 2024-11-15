<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('permission')->insert([
            [
                'id' => 1,
                'name' => 'Dashboard',
                'slug' => 'Dashboard',
                'groupby' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'name' => 'User',
                'slug' => 'User',
                'groupby' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'name' => 'Add User',
                'slug' => 'Add User',
                'groupby' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 4,
                'name' => 'Edit User',
                'slug' => 'Edit User',
                'groupby' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 5,
                'name' => 'Delete User',
                'slug' => 'Delete User',
                'groupby' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 6,
                'name' => 'Role',
                'slug' => 'Role',
                'groupby' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 7,
                'name' => 'Add Role',
                'slug' => 'Add Role',
                'groupby' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 8,
                'name' => 'Edit Role',
                'slug' => 'Edit Role',
                'groupby' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 9,
                'name' => 'Delete Role',
                'slug' => 'Delete Role',
                'groupby' => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 10,
                'name' => 'Category',
                'slug' => 'Category',
                'groupby' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 11,
                'name' => 'Add Category',
                'slug' => 'Add Category',
                'groupby' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 12,
                'name' => 'Edit Category',
                'slug' => 'Edit Category',
                'groupby' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 13,
                'name' => 'Delete Category',
                'slug' => 'Delete Category',
                'groupby' => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 14,
                'name' => 'Config',
                'slug' => 'Config',
                'groupby' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => 15,
                'name' => 'Edit Config',
                'slug' => 'Edit Config',
                'groupby' => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ]);
    }
}