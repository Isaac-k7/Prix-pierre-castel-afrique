<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Liste des Candidats
        </h2>
    </x-slot>

    <div >

        @if(Session::has('message'))
            <div class="bg-green-300 text-green-700 rounded px-2 py-3">
                {{Session::get('message')}}
            </div>
        @endif

     <!--    <div class="grid justify-items-stretch my-3">
            <a href="{{route('users.create')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 flex justify-self-end">Create Filiale</a>
        </div>
        
 -->
        <table class="table table-striped table-bordered nowrap" style="width:100%" id="tableau">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avatar</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Année</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pays</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Présélectionné ?</th>
                <th class="relative px-6 py-3"></th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @php($index = 1)
            @forelse($data as $candidats)
               
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{$index}}</td>
               
                    <td class="px-6 py-4 whitespace-nowrap imgthumb"> 
                        @if($candidats->users->getFirstMediaUrl('avatar_user','thumb'))
                        <img src="{{ $candidats->users->getFirstMediaUrl('avatar_user','thumb') }}" alt="" srcset="">
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{$candidats->users->name}}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{$candidats->users->email}}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{$candidats->edition->year}}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{$candidats->pays->name}}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($candidats->status == 0)   
                        <span class="flex justify-self-end orange">
                        <i class="fa fa-battery-empty"></i>  &nbsp;{{_('Brouillon')}} 
                        </span>
                        @elseif($candidats->status == 1)
                        <span class="flex justify-self-end vert">
                        <i class="fa fa-battery-full"></i>  &nbsp;  {{_('Candidature Validée')}} 
                        </span>
                        @elseif($candidats->status == 2)
                        <span class="flex justify-self-end rouge">
                        <i class="fa fa-battery-empty"></i>  &nbsp; {{_('Candidature rejétée')}} 
                        </span>
                        @elseif($candidats->status == 3)
                        <span class="flex justify-self-end rouge">
                        <i class="fa fa-battery-slash"></i>  &nbsp; {{_('En attente de validation')}} 
                        </span>
                        @endif
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($candidats->preselected == 0)   
                        <span class="flex justify-self-end rouge">
                         <strong><i class="fa fa-battery-empty"></i>  &nbsp;{{_('NON')}} </strong> 
                        </span>
                        @elseif($candidats->preselected == 1)
                        <span class="flex justify-self-end vert">
                         <strong><i class="fa fa-battery-full"></i>  &nbsp;  {{_('OUI')}} </strong> 
                        </span>
                        @endif
                    </td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{route('candidats.show', [$candidats->id])}}" class="text-blue-500 cand-fa"> <i class="fa fa-eye"></i></a>
                    </td>
                 
                   <!--  <td class="px-6 py-4 whitespace-nowrap">
                        <form method="post" action="{{route('users.destroy', [$candidats->id])}}" id="deleteForm{{$candidats->id}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="event.preventDefault(); if(confirm('Are you sure to delete?')) {document.getElementById('deleteForm{{$candidats->id}}').submit();} else {return false;} ">Delete</button>
                        </form>
                    </td> -->
                </tr>
                   @php($index++)
            @empty
                <div colspan="5" class="px-6 py-4 whitespace-nowrap">No data to display</div>
            @endforelse
            </tbody>
        </table>

            <div class="my-3">
             @if($data) {{$data->links()}} @endif
            </div>

    </div>
</x-app-layout>