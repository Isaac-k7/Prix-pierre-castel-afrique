<div class="flex-shrink-0  bloc-partenaire" id="partenaire">       
       <div class="bloc-partenaire-home" bis_skin_checked="1">
			
			    	<div class="intro-projets" bis_skin_checked="1">
                      <h2>LES PARTENAIRES</h2>
                      <p>Ils soutiennent le Fonds Pierre Castel - Agir avec l'Afrique.</p>
                    
			    	</div>

			
       <div class="bloc-liste-partenaire-home" bis_skin_checked="1">
             <div class="widgetHighlightPost col-xs-12 col-sm-12 col-md-12 col-lg-12">

               
               <section class="trigger section gutter-horizontal bg-gray gutter-vertical--m gutter-horizontal">
               <div class="customer-logos slider">
                 @php($partenaires = \App\Models\Partenaire::where('status',1)->get())
                  @forelse($partenaires as $partenaire)

                  <div class="slide-in-right slide"> 
                     <img src="{{ $partenaire->getFirstMediaUrl('logo_partenaire') }}" title="{{$partenaire->name}}" alt="{{$partenaire->name}}">
                  </div>

                  @empty
                   <p></p>
                  @endforelse
             
                </div>
               </section>

            </div>
          </div> 

	  	</div>
</div>
