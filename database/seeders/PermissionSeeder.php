<?php

namespace Database\Seeders;

use App\Models\{
    User,
    UserPermission,
};

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superadmin = User::find(1);

        $modules = ['inventory', 'users', 'files'];

        // Add permissions
        foreach($modules as $module)
        {
            UserPermission::create(
                // 1. The unique constraints to look up the row
                [
                    'user_id' => $superadmin->id,
                    'module_type' => $module,
                    'can_create' => true,
                    'can_read' => true,
                    'can_update' => true,
                    'can_delete' => true,
                ]
            );
        }
    }
}
