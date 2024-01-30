<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Exception;
use Vinkla\Hashids\Facades\Hashids;
use App\Models\Candidature;
use App\Models\Pays;
Use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:isAdmin');
    }
   
    public function index(): View
    {
        $name = Auth::user()->name;

        $bycountry = [];
        $user = [];
        $pays = [];
        $countries = Pays::with('candidature')->get();
       
        $remove = "Congo (RDC)";
        foreach ($countries as $country) {
             $user[] = Candidature::where('pays_id', $country->id)->count();
             $pays[] = $country->name;
             $bycountry[]= $country;
        
        }
        unset($pays[array_search("Congo (RDC)", $pays)]);
        return view('dashboard')
        ->with('name',$name)
        ->with('bycountry',json_encode($bycountry,JSON_NUMERIC_CHECK))
        ->with('pays',json_encode($pays,JSON_NUMERIC_CHECK))
        ->with('user',json_encode($user,JSON_NUMERIC_CHECK));
    }
}
