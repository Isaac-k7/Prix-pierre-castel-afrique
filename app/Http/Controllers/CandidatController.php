<?php

namespace App\Http\Controllers;

use App\Models\Filiale;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Pays;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Resources\CandidatureResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Candidature;
use App\Mail\SendMail;
use App\Models\Maillog;


class CandidatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userrole = Auth::user()->role->slug;
        if ($userrole =='filiale') {
            $filiale = Filiale::where('user_id',Auth::id())->first();
            $data = CandidatureResource::collection(Candidature::with('users')->with('pays')->where('pays_id',$filiale->pays_id)->paginate(10));
        }else{
            $data = CandidatureResource::collection(Candidature::with('users')->with('pays')->paginate(10));
        }
        
       // dd($data);
        return view("admin.candidats.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pays = Pays::get();
        $role = UserRole::get();
        return view("admin.users.add", compact(['pays','role']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
       
        $user = User::create([
            'role_id'   => $request->role_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' =>$request->password,
        ]);

        if ($user) {
            if ($request->hasFile('avatar')) {
                $user->addMediaFromRequest('avatar')
                ->toMediaCollection('avatar_user');
            }

        }

        event(new Registered($user));
        return redirect(route('users.index'))->with('message', 'Candidat créé avec succès');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $users 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //  dd($id);
        $data = Candidature::with('pays')->with('users')->where('id',$id)->first();
        return view("admin.candidats.show", compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $users 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $users 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      // dd($request);
        $user_id =Auth::id();
        $candidats = Candidature::with('pays')->with('users')->where('id',$id)->first();
        $candidats->update([
            'accepted_by'   => $user_id,
            'status'        => $request->status,
        ]);

        if ($candidats->status == 0) {
            $details = Maillog::create([
                'subject'  => 'Votre candidature est passée en brouillon',
                'message'  => "Bonjour ".$candidats->users->name.", <br>Votre candidature est passée en brouillon. Vous pouvez encore la modifier et ensuite la valider à nouveau",
                'emails'     => json_encode([$candidats->users->email])
            ]);
        }
        if ($candidats->status == 1) {
            $statut = 'acceptée';
            $details = Maillog::create([
                'subject'  => 'Candidature '.$statut,
                'message'  => "Félicitations  ".$candidats->users->name.", <br>votre candidature au Prix Pierre Castel 2023 a bien été enregistrée.<br>
                Nous vous remercions de l’intérêt que vous y avez porté. Après la phase d’examen, vous serez informé.e de votre éventuelle sélection pour les prochaines étapes du Prix
                ",
                'emails'     => json_encode([$candidats->users->email])
            ]);
        }

        if ($candidats->status == 2) {
            if($request->note){$note= $request->note;}else{$note='';}
            $statut = 'réfusée';
            $details = Maillog::create([
                'subject'  => 'Candidature '.$statut,
                'message'  => "Bonjour ".$candidats->users->name.", <br><br>
                Nous avons reçu votre candidature au Prix Pierre Castel 2023 et nous vous remercions de l’intérêt que vous y avez porté.
                <br><br>
                Nous ne pouvons – à regrets – donner une suite favorable à votre candidature car elle ne remplit pas les conditions d’éligibilité de cette édition.<br>
                ".$note." <br>
                Nous vous souhaitons toutefois un franc succès dans votre activité et espérons vous retrouver pour la prochaine édition. <br><br>
                A bientôt, 
                ",
                'emails'     => json_encode([$candidats->users->email])
            ]);
             // sen email to candidat
             $job = (new \App\Mail\SendMail($details))
             ->delay(now()->addSeconds(2));  
             dispatch($job);
            
            return response()->json([
                'success' => true,
                'message' => 'Candidature rejétée',
            ]);
        }
        
       
        if ($candidats) {
            // sen email to candidat
            $job = (new \App\Mail\SendMail($details))
            ->delay(now()->addSeconds(2));  
            dispatch($job);
        }
        return redirect(route('candidats.show',[$candidats->id]))->with('message', 'Candidat mis à jour avec succès');

    }


    /**
     * Présélectionné le candidat.
     *
     * @param  \App\Models\Candidature  $candidature 
     * @return \Illuminate\Http\Response
     */

    public function preselection(Request $request, $id)
    {
       // dd(Auth::id());
        $user_id =Auth::id();
        $candidats = Candidature::with('pays')->with('users')->where('id',$id)->first();
        $candidats->update([
            'preselected' => $request->preselected,
        ]);
       /*  $statut = 'en attente de validation';
        $details = Maillog::create([
            'subject'  => 'Candidature '.$statut,
            'message'  => "Bonjour ".$candidats->users->name.", <br>votre candidature est maintenant ".$statut.". <br> Votre dossier sera étudier et vous recevrez le résultat.",
            'emails'     => json_encode([$candidats->users->email])
        ]);
        if ($candidats) {
            $job = (new \App\Mail\SendMail($details))
            ->delay(now()->addSeconds(2));  
            dispatch($job);
        } */
        return redirect(route('candidats.show',[$candidats->id]))->with('message', 'Candidat présélectionné');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $users 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
