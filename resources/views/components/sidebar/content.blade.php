<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3"
>

    <x-sidebar.link
        title="Tableau de bord"
        href="{{ route('dashboard') }}"
        :isActive="request()->routeIs('dashboard')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link> 

   
@php($userrole = Auth::user()->role->slug)
@if($userrole =='admin')
<div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="text-sm text-gray-500"
    >
       Administration
    </div>
 <!-- User section -->
 <x-sidebar.dropdown
        title="Utilisateurs"
        :active="Str::startsWith(request()->route()->uri(), 'admin/users')"
    >
        <x-slot name="icon">
        <span class="flex-shrink-0 w-6 h-6 castel-icon" aria-hidden="true"><i class="fa fa-users" aria-hidden="true"></i></span>
        </x-slot>

        <x-sidebar.sublink
            title="Liste des utilisateurs"
            href="{{ route('users.index') }}"
            :active="request()->routeIs('users.index')"
        />
        <x-sidebar.sublink
            title="Créer un utilisateur"
            href="{{ route('users.create') }}"
            :active="request()->routeIs('users.create')"
        />
    </x-sidebar.dropdown>

    <div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="text-sm text-gray-500"
    >
       Gestion du Fond
    </div>
   <!-- Country section -->
    <x-sidebar.dropdown
        title="Pays"
        :active="Str::startsWith(request()->route()->uri(), 'admin/pays')"
    >
        <x-slot name="icon">
            <!-- <x-heroicon-o-view-grid class="flex-shrink-0 w-6 h-6" aria-hidden="true" /> -->
            <span class="flex-shrink-0 w-6 h-6 castel-icon" aria-hidden="true"><i class="fa fa-globe" aria-hidden="true"></i></span>
        </x-slot>

        <x-sidebar.sublink
            title="Liste des pays"
            href="{{ route('pays.index') }}"
            :active="request()->routeIs('pays.index')"
        />
        <x-sidebar.sublink
            title="Créer un pays"
            href="{{ route('pays.create') }}"
            :active="request()->routeIs('pays.create')"
        />
    </x-sidebar.dropdown>

     <!-- Edition section -->
     <x-sidebar.dropdown
        title="Edition"
        :active="Str::startsWith(request()->route()->uri(), 'admin/edition')"
    >
        <x-slot name="icon">
        <span class="flex-shrink-0 w-6 h-6 castel-icon" aria-hidden="true"><i class="fa fa-trophy" aria-hidden="true"></i></span>
        </x-slot>

        <x-sidebar.sublink
            title="Liste des éditions"
            href="{{ route('edition.index') }}"
            :active="request()->routeIs('edition.index')"
        />
        <x-sidebar.sublink
            title="Créer une édition"
            href="{{ route('edition.create') }}"
            :active="request()->routeIs('edition.create')"
        />
    </x-sidebar.dropdown>

     <!-- Filiale section -->
     <x-sidebar.dropdown
        title="Représentant"
        :active="Str::startsWith(request()->route()->uri(), 'admin/filiale')"
    >
        <x-slot name="icon">
        <span class="flex-shrink-0 w-6 h-6 castel-icon" aria-hidden="true"><i class="fa fa-flag-o" aria-hidden="true"></i></span>
        </x-slot>

        <x-sidebar.sublink
            title="Liste des représentants"
            href="{{ route('filiale.index') }}"
            :active="request()->routeIs('filiale.index')"
        />
        <x-sidebar.sublink
            title="Créer un représentant"
            href="{{ route('filiale.create') }}"
            :active="request()->routeIs('filiale.create')"
        />
      
    </x-sidebar.dropdown>

      <!-- Partenaire section -->
      <x-sidebar.dropdown
        title="Partenaire"
        :active="Str::startsWith(request()->route()->uri(), 'admin/partenaire')"
    >
        <x-slot name="icon">
        <span class="flex-shrink-0 w-6 h-6 castel-icon" aria-hidden="true"><i class="fa fa-flag-o" aria-hidden="true"></i></span>
        </x-slot>

        <x-sidebar.sublink
            title="Liste des partenaires"
            href="{{ route('partenaire.index') }}"
            :active="request()->routeIs('partenaire.index')"
        />
        <x-sidebar.sublink
            title="Créer un partenaire"
            href="{{ route('partenaire.create') }}"
            :active="request()->routeIs('partenaire.create')"
        />
      
    </x-sidebar.dropdown>
     
@endif
@if($userrole =='admin' || $userrole =='filiale')
        <!-- Candidature section -->
        <x-sidebar.dropdown
            title="Candidature"
            :active="Str::startsWith(request()->route()->uri(), 'admin/candidats')"
            >
            <x-slot name="icon">
            <span class="flex-shrink-0 w-6 h-6 castel-icon" aria-hidden="true"><i class="fa fa-users" aria-hidden="true"></i></span>
            </x-slot>

            <x-sidebar.sublink
                title="Liste des candidatures"
                href="{{ route('candidats.index') }}"
                :active="request()->routeIs('candidats.index')"
            />
        </x-sidebar.dropdown>
@endif
</x-perfect-scrollbar>
