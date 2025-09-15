<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\User;
use App\UserRoles;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(20)
            ->create();

        // Assign permissions to random three users in combination
        $users = User::where('role', UserRoles::Admin->value)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        $allPermissions = Permission::all()
            ->pluck('id', 'name')
            ->toArray();
        $permissionNames = array_keys($allPermissions);
        $combinations = [];
        $n = count($allPermissions);
        for ($i = 1; $i < (1 << $n); $i++) {
            $combination = [];
            for ($j = 0; $j < $n; $j++) {
                if ($i & (1 << $j)) {
                    $combination[] = $allPermissions[$permissionNames[$j]];
                }
            }
            $combinations[] = $combination;
        }

        foreach ($combinations as $index => $combination) {
            $user = $users[$index % 3];
            $user->permissions()->detach();
            foreach ($combination as $permission) {
                $user->permissions()->attach($permission, ['created_at' => now()]);
            }
        }

    }
}
