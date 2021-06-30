<div x-data="{openFormEdit: false}">

    <div class="cursor-move flex justify-between items-center" :class="{'hidden': openFormEdit}">
        <h1>
            Sección {{$position}}: <span class="ml-2 font-semibold">{{$section->name}}</span>
        </h1>

        <button x-on:click="openFormEdit = true">
            <i class="fas fa-edit cursor-pointer"></i>
        </button>

    </div>

    <div class="hidden" :class="{'hidden': !openFormEdit}">
        <form wire:submit.prevent="save" class="bg-white rounded-lg shadow-lg p-6 mt-4">
            <x-jet-label class="">
                Nueva sección
            </x-jet-label>
        
            <x-jet-input type="text"
                wire:model="section.name"
                class="w-full"
                placeholder="Ingrese el nombre de una sección"/>
        
            <x-jet-input-error for="section.name" />
        
            <div class="flex justify-end mt-4">
                <x-jet-danger-button x-on:click="openFormEdit = false">
                    Cancelar
                </x-jet-danger-button>
        
                <x-jet-button class="ml-2">
                    Actualizar
                </x-jet-button>
            </div>
        </form>
    </div>

</div>