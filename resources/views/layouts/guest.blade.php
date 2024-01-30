<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    
    <title>{{ config('app.name', 'Prix Castel Afrique') }}</title>
    <link rel="icon" type="image/png" href="{{asset('assets/images/favicon.png')}}" />
    <link rel="stylesheet"  href="{{asset('assets/css/style.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/css/intlTelInput.css')}}">
    

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
<link href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css' rel='stylesheet' type='text/css'>

    <!-- Styles -->
    <style>
        [x-cloak] {
            display: none;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css'>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel='stylesheet' href='https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css'>
<link rel="stylesheet" href="{{asset('assets/css/BeatPicker.min.css')}}"/>
<link rel="stylesheet" href="{{asset('assets/documents/css/prism.css')}}"/>
</head>
<body class="font-sans antialiased" id="guest-home">   
<div class="container">
<div class="text-gray-900 bg-gray-100 dark:bg-dark-eval-0 dark:text-gray-200" id="my-content">
    <div class="bloc-header" >
        <div  id="logo-bloc">
            <div class=" top-0 left-10">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </a>
            </div>
        </div>
       
            <div class=" items-center justify-center">
                <div class="top-4 right-bloc items-center justify-center">
                            @auth
                            <x-dropdown align="right" width="48">
                                    <x-slot name="trigger">
                                        <button
                                            class="flex my-btn items-center p-2 text-sm font-medium text-gray-500 rounded-md transition duration-150 ease-in-out hover:text-gray-700 focus:outline-none focus:ring focus:ring-purple-500 focus:ring-offset-1 focus:ring-offset-white dark:focus:ring-offset-dark-eval-1 dark:text-gray-400 dark:hover:text-gray-200"
                                        >
                                                <div class="avatar"> 
                                                                @if(auth()->user()->getFirstMediaUrl('avatar_user','thumb'))
                                                                <img class="candid-img" src="{{ auth()->user()->getFirstMediaUrl('avatar_user','thumb') }}" alt="" srcset="">
                                                                @endif
                                                            </div> 
                                            <div>{{ Auth::user()->name }}</div>

                                            <div class="ml-1">
                                                <svg
                                                    class="w-4 h-4 fill-current"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </div>
                                        </button>
                                    </x-slot>

                                    <x-slot name="content">
                                        <!-- Profile -->
                                            @if(auth()->user()->role->slug=='admin' || auth()->user()->role->slug=='filiale')
                                            <x-dropdown-link
                                            :href="route('dashboard')"
                                            >
                                            {{ __('Tableau de bord') }}
                                        </x-dropdown-link>

                                        <x-dropdown-link
                                            :href="route('profile.edit-candidat')"
                                        >
                                            {{ __('Profil') }}
                                        </x-dropdown-link>
                                            <!-- <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a> -->
                                            @endif

                                            @if(auth()->user()->role->slug=='candidat')
                                            <x-dropdown-link
                                            :href="route('candidat')"
                                            >
                                            {{ __('Mon espace') }}
                                        </x-dropdown-link>
                                            @endif
                                        <!-- Authentication -->
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-dropdown-link
                                                :href="route('logout')"
                                                onclick="event.preventDefault(); this.closest('form').submit();"
                                            >
                                                {{ __('Se déconnecter') }}
                                            </x-dropdown-link>
                                        </form>
                                    </x-slot>
                                    </x-dropdown>
                            @else
                                <a href="{{ route('login') }}" class="btn-log-guest text-sm text-gray-700 dark:text-gray-500 underline">Connexion</a>
                                @php($edition = \App\Models\Edition::where('status',1)->first())
                                @if ($edition)
                                <a href="{{ route('getcandidat-view') }}" class="btn-log-guest text-sm text-gray-700 dark:text-gray-500 underline">Inscription candidat</a>
                                @endif

                            @endauth
                        </div>
                        </div>
                    </div>
                </div>  
                <!-- Page Wrapper -->
                <div  id="bloc-content">
                        <!-- Page Content -->
                        <main class="px-4 sm:px-6 flex-1">
                          
                                    {{ $slot }}
                        </main>
                </div>
            </div>
       </div>

<script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
<script src='https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js' type='text/javascript'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.fr.min.js"></script>  

<!-- partial -->

<script>
$(document).ready(function(){
    $('.customer-logos').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 1500,
    arrows: true,
    dots: false,
    pauseOnHover: false,
    prevArrow: '<i class="slick-prev fas fa-chevron-left"></i>',
    nextArrow: '<i class="slick-next fas fa-chevron-right"></i>',
    responsive: [{
      breakpoint: 768,
      settings: {
        slidesToShow: 3
      }
    }, {
      breakpoint: 520,
      settings: {
        slidesToShow: 2
      }
    }]
    });

});

  jQuery(document).ready(function ($) {
   $('.slide img').each(function () {
    $(this).wrap($('<a/>', {
        href: $(this).attr('src'),
        class: "fancybox",
        rel: "fancyimage"
    }));
});

$("a[rel=fancyimage]").fancybox({
            'type': 'image',
            'overlayShow': false,
            'transitionIn': 'elastic',
            'transitionOut': 'elastic'
        });
}); 
</script>
<script src="{{asset('assets/js/intlTelInput.js')}}"></script>
  <script>
    var input = document.querySelector("#phone");
    window.intlTelInput(input, {
       allowDropdown: true,
       autoHideDialCode: true,
       autoPlaceholder: "polite",
       dropdownContainer:null,
       customPlaceholder:null,
       excludeCountries: [],
       formatOnDisplay: true,
       hiddenInput: "phone",
       initialCountry: "auto",
       localizedCountries:null,
       geoIpLookup: function(callback) {
         $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
           var countryCode = (resp && resp.country) ? resp.country : "";
           callback(countryCode);
         });
      },
       nationalMode: true,
       onlyCountries: ['dz', 'bf', 'cm', 'ci', 'mg', 'cd'],
       placeholderNumberType: "MOBILE",
       separateDialCode: true,
      utilsScript: "{{asset('assets/js/utils.js')}}",
    });
  </script>

<script>

var ebModal = document.getElementById('mySizeChartModal');
// Get the button that opens the modal
var ebBtn = document.getElementById("mySizeChart");
// Get the <span> element that closes the modal
var ebSpan = document.getElementsByClassName("ebcf_close")[0];
// When the user clicks the button, open the modal 
ebBtn.onclick = function() {
    ebModal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
ebSpan.onclick = function() {
    ebModal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == ebModal) {
        ebModal.style.display = "none";
    }
}
</script>
<!-- fore datepicker EN -->
<!-- <script src="{{asset('assets/js/jquery-1.11.0.min.js')}}"></script>
    <script src="{{asset('assets/js/BeatPicker.js')}}"></script>
    <script src="{{asset('assets/documents/js/prism.js')}}"></script> -->

</body>
</html>
