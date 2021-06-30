<div x-data="{open: @entangle('showForm').defer}">
    <div x-on:click="open = !open" 
        class="h-8 w-14 -ml-4 bg-indigo-200 flex items-center justify-center cursor-pointer" 
        style="clip-path: polygon(75% 0%, 100% 50%, 75% 100%, 0% 100%, 0 51%, 0% 0%);">
        
        <i class="-ml-2 fas fa-plus transition duration-300" :class="{'transform rotate-45': open}"></i>
    </div>

    <form wire:submit.prevent="save" x-show="open" class="bg-gray-100 rounded-lg shadow-lg p-6 mt-4">
        <x-jet-label class="">
            Nueva sección
        </x-jet-label>

        <x-jet-input type="text"
            wire:model="name"
            class="w-full"
            placeholder="Ingrese el nombre de una sección"/>

        <x-jet-input-error for="name" />

        <div class="flex justify-end mt-4">
            <x-jet-danger-button x-on:click="open = false">
                Cancelar
            </x-jet-danger-button>

            <x-jet-button class="ml-2">
                Agregar
            </x-jet-button>
        </div>
    </form>
</div>