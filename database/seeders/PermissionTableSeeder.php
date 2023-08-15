<?php
  
namespace Database\Seeders;
  
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
  
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'user-create',
            'user-edit',
            'user-delete',
            'role-create',
            'role-edit',
            'role-delete',
            'book-create',
            'book-edit',
            'book-delete',
            'bookType-create',
            'bookType-edit',
            'bookType-delete',
            'transaction-edit',
            'transaction-delete'
        ];
        
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}