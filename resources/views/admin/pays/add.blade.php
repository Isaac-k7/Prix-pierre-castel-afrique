<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Ajout d'un pays
        </h2>
    </x-slot>

    <div class="py-12">

        <form method="post" action="{{route('pays.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="shadow sm:rounded-md sm:overflow-hidden">
                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <div class="grid grid-cols-1 gap-6">
                        <div class="col-span-3 sm:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">
                                Nom
                            </label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="text" name="name" value="{{old('name')}}" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full form-control rounded-none rounded-r-md sm:text-sm border-gray-300 @error('name') border-red-500 @enderror" placeholder="Nom">
                            </div>
                            @error('name')
                            <div class="text-red-600">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="col-span-3 sm:col-span-1">
                            <label class="block text-sm font-medium text-gray-700">
                                code
                            </label>
                            <div class="mt-1 flex rounded-md shadow-sm">
                                <input type="text" name="code" value="{{old('code')}}" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full form-control rounded-none rounded-r-md sm:text-sm border-gray-300 @error('code') border-red-500 @enderror" placeholder="Code pays">
                            </div>
                            @error('code')
                            <div class="text-red-600">{{$message}}</div>
                            @enderror
                        </div>

                    </div>

                </div>
                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white   focus:outline-none focus:ring-2 focus:ring-offset-2 btn-mitsu">
                        Créer un pays
                    </button>
                </div>
            </div>

        </form>

    </div>
</x-app-layout>