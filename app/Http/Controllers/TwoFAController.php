<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Session;
use App\Models\UserCode;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class TwoFAController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('2fa');
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $request->validate([
            'code'=>'required',
        ]);
  
       $find = UserCode::where('user_id', auth()->user()->id)
                        ->where('code', $request->code)// ->where('updated_at', '>=', now()->subMinutes(2))
                        ->first(); 

        if (!is_null($find)) {
            if($find->two_factor_expires_at < now())
            {
                Auth::guard('web')->logout();
                return redirect(route('login'))->with('warning', 'Le code à deux facteurs a expiré. Veuillez vous reconnecter');
            }
           
            Session::put('user_2fa', auth()->user()->id);
            $rollen = auth()->user()->role->slug;
            
       
            switch($rollen){
                case 'admin':
                    return redirect()->intended(RouteServiceProvider::HOME);
                    break;
                case 'filiale':
                    return redirect()->intended(RouteServiceProvider::HOME);
                    break;
                case 'candidat':
                    return redirect()->intended(RouteServiceProvider::CANDIDAT);
                    break;
                default:
                    return redirect()->intended(RouteServiceProvider::HOME);
            }
        }
  
        return back()->with('error', 'Vous avez entré un mauvais code.');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function resend()
    {
        auth()->user()->generateCode();
  
        return back()->with('success', 'Nous vous avons envoyé le code sur votre email.');
    }
}