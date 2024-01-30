<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Pays;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class PaysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pays::firstOrCreate(["name" => "Côte d'Ivoire", "code" => "CI"]);
        Pays::firstOrCreate(["name" => "Algérie", "code" => "DZ"]);
        Pays::firstOrCreate(["name" => "Congo RDC : Equateur", "code" => "CD"]);
        Pays::firstOrCreate(["name" => "Congo RDC : Kinshasa", "code" => "CD"]);
        Pays::firstOrCreate(["name" => "Congo RDC : Kongo Central", "code" => "CD"]);
        Pays::firstOrCreate(["name" => "Congo RDC : Kwango", "code" => "CD"]);
        Pays::firstOrCreate(["name" => "Congo RDC : Kwilu", "code" => "CD"]);
        Pays::firstOrCreate(["name" => "Congo RDC : Mai Ndombe", "code" => "CD"]);
        Pays::firstOrCreate(["name" => "Congo RDC : Mongala", "code" => "CD"]);
        Pays::firstOrCreate(["name" => "Congo RDC : Sud Ubangi", "code" => "CD"]);
        Pays::firstOrCreate(["name" => "Burkina Faso", "code" => "BF"]);
        Pays::firstOrCreate(["name" => "Madagascar", "code" => "MG"]);
        Pays::firstOrCreate(["name" => "Cameroun", "code" => "CM"]);
        Pays::firstOrCreate(["name" => "Togo", "code" => "TG"]);
        Pays::firstOrCreate(["name" => "Congo (RDC)", "code" => "CD"]);
    }
}
