<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserRole;
use Illuminate\Support\Str;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        UserRole::firstOrCreate(['name' => 'Admin', 'slug' => Str::slug('Admin')]);
        UserRole::firstOrCreate(['name' => 'Filiale', 'slug' => Str::slug('Filiale')]);
        UserRole::firstOrCreate(['name' => 'Candidat', 'slug' => Str::slug('Candidat')]);
    }
}
