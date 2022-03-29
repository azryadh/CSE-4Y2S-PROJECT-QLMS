<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'isAdmin',
            ],
            [
                'id'    => 2,
                'title' => 'isTeacher',
            ],
            [
                'id'    => 3,
                'title' => 'isStudent',
            ],
            [
                'id'    => 4,
                'title' => 'view',
            ],
            [
                'id'    => 5,
                'title' => 'update',
            ],
            [
                'id'    => 6,
                'title' => 'edit',
            ],
            [
                'id'    => 7,
                'title' => 'delete',
            ],
            [
                'id'    => 8,
                'title' => 'change_password',
            ],
        ];

        Permission::insert($permissions);
    }
}
