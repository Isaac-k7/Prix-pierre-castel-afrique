<x-perfect-scrollbar
    as="nav"
    aria-label="main"
    class="flex flex-col flex-1 gap-4 px-3 cand-link"
>
<div
        x-transition
        x-show="isSidebarOpen || isSidebarHovered"
        class="text-sm text-gray-500"
    >
      
    </div>
@php( $user_id =Auth::id())
@php( $data = \App\Models\Candidature::with('pays')->with('users')->where('user_id',$user_id)->first() )
    <x-sidebar.link
        title="Mon espace"
        href="{{ route('candidat') }}"
        :isActive="request()->routeIs('candidat')"
    >
    <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
   </x-sidebar.link> 

@if($data && $data->statuts == 0)
    <x-sidebar.link
        title="Modifier ma candidature"
        href="{{ route('candidature.edit',[encrypt($data->id)]) }}"
        :isActive="request()->routeIs('candidature.edit',[$data->id])"
    >
    <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
</x-sidebar.link> 
@else
<x-sidebar.link
        title="Ma candidature"
        href="{{ route('candidature.create') }}"
        :isActive="request()->routeIs('candidature.create')"
    >
    <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
</x-sidebar.link> 
@endif


</x-perfect-scrollbar>


