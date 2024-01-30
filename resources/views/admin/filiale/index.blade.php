<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Liste des représentants
        </h2>
    </x-slot>

    <div >

        @if(Session::has('message'))
            <div class="bg-green-300 text-green-700 rounded px-2 py-3">
                {{Session::get('message')}}
            </div>
        @endif

        <div class="grid justify-items-stretch my-3">
            <a href="{{route('filiale.create')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 flex justify-self-end">{{_('Créer un représentant')}}</a>
        </div>
        

        <table class="min-w-full divide-y divide-gray-200" id="tableau">
            <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">#</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Avatar</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pays</th>
                <th class="relative px-6 py-3"></th>
                <th class="relative px-6 py-3"></th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @php($index = 1)
            @forelse($data as $filiale)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{$index}}</td>
               
                    <td class="px-6 py-4 whitespace-nowrap imgthumb"> 
                        @if($filiale->users->getFirstMediaUrl('avatar_user','thumb'))
                        <img src="{{ $filiale->users->getFirstMediaUrl('avatar_user','thumb') }}" alt="" srcset="">
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">{{$filiale->users->name}}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{$filiale->users->email}}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{$filiale->pays->name}}</td>

                    <td class="px-6 py-4 whitespace-nowrap">
                        <a href="{{route('filiale.edit', [$filiale->id])}}" 
                        class="text-blue-500" ><i class="fa fa-pencil"></i></a>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <form method="post" action="{{route('filiale.destroy', [$filiale->id])}}" id="deleteForm{{$filiale->id}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="event.preventDefault(); if(confirm('Êtes-vous sûr de vouloir supprimer?')) {document.getElementById('deleteForm{{$filiale->id}}').submit();} else {return false;} ">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @php($index++)
            @empty
                <div colspan="5" class="px-6 py-4 whitespace-nowrap">Aucune donnée à afficher</div>
            @endforelse
            </tbody>
        </table>

            <div class="my-3">
            @if($data) {{$data->links()}} @endif
            </div>

    </div>
</x-app-layout>