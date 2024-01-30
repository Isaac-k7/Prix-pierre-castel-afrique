<?php

namespace App\Http\Controllers;

use App\Models\Candidature;
use App\Models\Pays;
use App\Models\User;
use App\Models\Media;
use App\Models\Edition;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\Rules;
use App\Http\Requests\CandidatRequest;
use App\Http\Requests\CandidatUpdateRequest;
use Illuminate\Support\Str;
use Exception;
use App\Mail\SendMail;
use App\Models\Maillog;
use Carbon\Carbon;

class CandidatureController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->middleware('can:isCandidat');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id =Auth::id();
        $data = Candidature::with('pays')->with('users')->where('user_id',$user_id)->first();
       
        //dd($data);
        return view("candidat-space.espace", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Pays::get();
        return view("candidat-space.candidature", compact('data'));
    }
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CandidatRequest $request): RedirectResponse
    {
      // dd($request);
        $edition = Edition::where('status','1')->first();
       

        $lienData=[];
       
        if($request->lien_rx) { 
          
           $index = 0;
            foreach($request->source_lien as $source)
            {  
             $lienData[] = [
                                'source' => $source,
                                'lien' => $request->lien_rx[$index]
                           ];  
            $index++; 
            }
        }
       
        $user_id =Auth::id();
        $candidature = Candidature::create([
            'user_id'   =>  $user_id,
            'pays_id' => $request->pays_id,
            'editions_id' => $edition->id,
            'lien_rx' => json_encode($lienData),
        ]);

       

        if ($candidature) {
           
          
            # cv
            if ($request->hasFile('cv')) {
                $candidature
                ->addMediaFromRequest("cv")
                ->sanitizingFileName(fn ($filename) => Media::sanitizeFilename($filename))
                ->toMediaCollection('candidat_cv');
            }

            # identite
            if ($request->hasFile('identite')) {
                $candidature
                ->addMediaFromRequest("identite")
                ->sanitizingFileName(fn ($filename) => Media::sanitizeFilename($filename))
                ->toMediaCollection('candidat_identite');
            }

            # juridique_entreprise
            if ($request->hasFile('juridique_entreprise')) {
                $candidature
                ->addMediaFromRequest("juridique_entreprise")
                ->sanitizingFileName(fn ($filename) => Media::sanitizeFilename($filename))
                ->toMediaCollection('candidat_juridique_entreprise');
            }

            # juridique_commerciale
            if ($request->hasFile('juridique_commerciale')) {
           
                $candidature
                ->addMediaFromRequest("juridique_commerciale")
                ->sanitizingFileName(fn ($filename) => Media::sanitizeFilename($filename))
                ->toMediaCollection('candidat_juridique_commerciale');
            }
              # exercice
            if ($request->hasFile('exercice')) {
                $candidature
                ->addMediaFromRequest("exercice")
                ->sanitizingFileName(fn ($filename) => Media::sanitizeFilename($filename))
                ->toMediaCollection('candidat_exercice');
            }

            # details_projet
            if ($request->hasFile('details_projet')) {
          
                $candidature
                ->addMediaFromRequest("details_projet")
                ->sanitizingFileName(fn ($filename) => Media::sanitizeFilename($filename))
                ->toMediaCollection('candidat_details_projet');
            }

              # logo_entreprise
            if ($request->hasFile('logo_entreprise')) {
                $candidature
                ->addMediaFromRequest("logo_entreprise")
                ->sanitizingFileName(fn ($filename) => Media::sanitizeFilename($filename))
                ->toMediaCollection('candidat_logo_entreprise');
            }

            if ($request->hasFile('images_activity')) {
                $index = 0;
                foreach($request->file('images_activity') as $file)
                {
                    $candidature->addMediaFromRequest('images_activity['.$index.']',)
                    ->sanitizingFileName(fn ($filename) => Media::sanitizeFilename($filename))
                    ->toMediaCollection('images_activity');
                    $index++;
                }
               
            }
             
            $details = Maillog::create([
                'subject'  => 'Votre candidature',
                'message'  => "Bonjour ".Auth::user()->name.", <br>Votre candidature est toujours en brouillon.
                <br> Vous pouvez accéder à votre espace personnel pour revoir vos documents et les valider afin que votre candidature puisse être prise en compte. ",
                'emails'     => json_encode([Auth::user()->email])
            ]);
             // sen email to candidat

             $job = (new \App\Mail\SendMail($details))
             ->delay(now()->addSeconds(2));  
             dispatch($job);
 

            return redirect(route('candidat'))->with('success', 'Votre candidature a été créee avec succès');
            //return redirect()->intended(RouteServiceProvider::CANDIDAT);
        }
        return redirect(route('candidat'))->with('error', 'Une erreur s\'est produite. Veuillez réessayer');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Candidat  $candidat
     * @return \Illuminate\Http\Response
     */
    public function show(Candidat $candidat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Candidat  $candidat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edition = Edition::where('status',1)->first();
        if ($edition) {
            $data = Candidature::with('pays')->with('users')->with('edition')->where('id',decrypt($id))->where('editions_id',$edition->id)->first();
           //$data->update_count == 3 ||
            if ($data->status == 1 || $data->status == 2 || $data->status == 3 || $data->status == 1 && $edition->year + 1 > Carbon::now()->year  ) {
                return redirect(route('candidat'))->with('warning', 'Vous ne pouvez plus faire de modification');
            }
            $datapays = Pays::get();
            return view("candidat-space.edit", compact(['data','datapays']));
        }else{
            return redirect(route('candidat'))->with('warning', 'Aucune édition Prix Pierre Castel pour le moment');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Candidat  $candidat
     * @return \Illuminate\Http\Response
     */
    public function update(CandidatUpdateRequest $request, $id)
    {
       
        $edition = Edition::where('status','1')->first();
        $candidature = Candidature::where(['id'=>$id, 'editions_id'=>$edition->id])->first();

        $lienData=[];
       
        if($request->lien_rx) { 
           // dd($request->lien_rx);
           $index = 0;
           foreach($request->source_lien as $source)
           {  
            $lienData[] = [
                               'source' => $source,
                               'lien' => $request->lien_rx[$index]
                          ];  
           $index++; 
           }
        }

        $candidature->update([
            'pays_id' => $request->pays_id,
            'update_count' => $candidature->update_count+1,
            'lien_rx' => json_encode($lienData),
        ]);

        $details = Maillog::create([
            'subject'  => _('Modification de votre candidature'),
            'message'  => _("Bonjour ").Auth::user()->name.", <br>"._("Votre candidature a été modifiée avec succès. Vous ne pouvez plus la modifier jusqu'à la fin de l'édition. "),
            'emails'     => json_encode([Auth::user()->email])
        ]);

        if ($candidature) {

            // sen email to candidat

            $job = (new \App\Mail\SendMail($details))
            ->delay(now()->addSeconds(2));  
            dispatch($job);
          
            # cv
            if ($request->hasFile('cv')) {
                $candidature->clearMediaCollection('candidat_cv');
                $candidature
                ->addMediaFromRequest("cv")
                ->sanitizingFileName(fn ($filename) => Media::sanitizeFilename($filename))
                ->toMediaCollection('candidat_cv');
            }

            # identite
            if ($request->hasFile('identite')) {
                $candidature->clearMediaCollection('candidat_identite');
                $candidature
                ->addMediaFromRequest("identite")
                ->sanitizingFileName(fn ($filename) => Media::sanitizeFilename($filename))
                ->toMediaCollection('candidat_identite');
            }

            # juridique_entreprise
            if ($request->hasFile('juridique_entreprise')) {
                $candidature->clearMediaCollection('candidat_juridique_entreprise');
                $candidature
                ->addMediaFromRequest("juridique_entreprise")
                ->sanitizingFileName(fn ($filename) => Media::sanitizeFilename($filename))
                ->toMediaCollection('candidat_juridique_entreprise');
            }

            # juridique_commerciale
            if ($request->hasFile('juridique_commerciale')) {
                $candidature->clearMediaCollection('candidat_juridique_commerciale');
                $candidature
                ->addMediaFromRequest("juridique_commerciale")
                ->sanitizingFileName(fn ($filename) => Media::sanitizeFilename($filename))
                ->toMediaCollection('candidat_juridique_commerciale');
            }
              # exercice
            if ($request->hasFile('exercice')) {
                $candidature->clearMediaCollection('candidat_exercice');
                $candidature
                ->addMediaFromRequest("exercice")
                ->sanitizingFileName(fn ($filename) => Media::sanitizeFilename($filename))
                ->toMediaCollection('candidat_exercice');
            }

            # details_projet
            if ($request->hasFile('details_projet')) {
                $candidature->clearMediaCollection('candidat_details_projet');
                $candidature
                ->addMediaFromRequest("details_projet")
                ->sanitizingFileName(fn ($filename) => Media::sanitizeFilename($filename))
                ->toMediaCollection('candidat_details_projet');
            }

              # logo_entreprise
              if ($request->hasFile('logo_entreprise')) {
                $candidature->clearMediaCollection('candidat_logo_entreprise');
                $candidature
                ->addMediaFromRequest("logo_entreprise")
                ->sanitizingFileName(fn ($filename) => Media::sanitizeFilename($filename))
                ->toMediaCollection('candidat_logo_entreprise');
            }

            if ($request->hasFile('images_activity')) {
                $index = 0;
                foreach($request->file('images_activity') as $file)
                {
                    $candidature->clearMediaCollection('images_activity['.$index.']');
                    $candidature->addMediaFromRequest('images_activity['.$index.']')
                    ->sanitizingFileName(fn ($filename) => Media::sanitizeFilename($filename))
                    ->toMediaCollection('images_activity');
                    $index++;
                }
               
            }
            return redirect(route('candidat'))->with('success', 'Modification éffectué avec succès');
          //  return redirect()->intended(RouteServiceProvider::CANDIDAT);
        }
        return redirect(route('candidat'))->with('error', 'Une erreur s\'est produite. Veuillez réessayer');
    }

    public function validation(Request $request, $id)
    {
       // dd(Auth::id());
        $user_id =Auth::id();
        $candidats = Candidature::with('pays')->with('users')->where('id',$id)->first();
        $candidats->update([
            'status'        => $request->status,
        ]);
        $statut = 'en attente de validation';
        $details = Maillog::create([
            'subject'  => 'Candidature '.$statut,
            'message'  => "Bonjour ".$candidats->users->name.", <br>Votre candidature est maintenant ".$statut.". <br> Vous recevez une notification sur le statut de celle-ci dans un délai de 2 jours.",
            'emails'     => json_encode([$candidats->users->email])
        ]);
        if ($candidats) {
            // sen email to candidat
            $job = (new \App\Mail\SendMail($details))
            ->delay(now()->addSeconds(2));  
            dispatch($job);
        }
        return redirect(route('candidat'))->with('success', 'Candidature soumise avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Candidat  $candidat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Candidat $candidat)
    {
        //
    }

    public function delete($uuid)
    {
        Media::where('uuid',$uuid)->delete();
  
        return response()->json(['success'=>'Photo supprimée avec Succès!']);
    }
}
