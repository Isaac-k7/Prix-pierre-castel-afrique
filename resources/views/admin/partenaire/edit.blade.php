<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mise à jour de  {{ $data->users->name }}
        </h2>
    </x-slot>

    <div class="py-12">

        <form method="post" action="{{route('partenaire.update', [$data->id])}}"  enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid gap-6 shadow sm:rounded-md sm:overflow-hidden">
            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                    <div class="grid grid-cols-1 gap-6">
              <!-- avatar -->
                <div class="space-y-2" >
                <p>  <x-form.label
                            for="name"
                            :value="__('Logo')"
                        /></p>
                <div class="" style="display:flex">
                    @if($data->getFirstMediaUrl('logo_partenaire','thumb'))
                        <img  style="width:100px;" src="{!! $data->getFirstMediaUrl('logo_partenaire','thumb') !!}" alt="" srcset="">
                    @endif 
                      
                      
                        <x-form.input
                                id="logo"
                                class="block w-full"
                                type="file"
                                name="avatar"
                                :value="old('logo')"
                                autofocus
                                placeholder="{{ __('Logo') }}"
                            />
                    
                      
                    </div>
                </div>
                <!-- Name -->
                <div class="space-y-2">
                    <x-form.label
                        for="name"
                        :value="__('Nom')"
                    />

                    <x-form.input-with-icon-wrapper>
                        <x-slot name="icon">
                            <x-heroicon-o-pencil aria-hidden="true" class="w-5 h-5" />
                        </x-slot>
                        <x-form.input
                            withicon
                            id="name"
                            class="block w-full"
                            type="text"
                            name="name"
                            :value="old('name', $data->name)"
                            required
                            autofocus
                            placeholder="{{ __('Nom') }}"
                        />
                    </x-form.input-with-icon-wrapper>
                </div>
                <!-- statut -->
                <div class="space-y-2">
                    <x-form.label
                        for="name"
                        :value="__('Statut')"
                    />

                    <select name="status" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300 @error('status') border-red-500 @enderror">
                        <option value="" {{$data->status=='' ? 'selected':''}}>Selectionnez</option>
                        <option value="1" {{$data->status==1 ? 'selected':''}}>Active</option>
                        <option value="0" {{$data->status==0 ? 'selected':''}}>Inactive</option>
                        
                    </select>
                </div>

             </div>


                <div>
                    <x-button class="jpx-4 py-3 bg-gray-50 text-right sm:px-6">
                        <x-heroicon-o-user-add class="w-6 h-6" aria-hidden="true" />

                        <span>{{ __('Mettre à jour') }}</span>
                    </x-button>
                </div>
                </div>
            </div>

            </div>

        </form>

    </div>
</x-app-layout>