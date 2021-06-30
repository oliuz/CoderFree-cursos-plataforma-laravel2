<div class="px-6 pb-6">

    
    
    <ul x-data x-ref="sections" x-init="new Sortable($refs.sections, {
        group: 'shared',
        sort: true,
        animation: 150,
        ghostClass: 'blue-background-class',
        store: {
            
            set: (sortable) => {
                const sorts = sortable.toArray();
                
                let data = [sorts, {{$section->id}}];
                
                Livewire.emitTo('instructor.curriculum-course','sortLessons', data)
            }
        }
    });">
        @foreach ($lessons as $lesson)
            <li data-id="{{$lesson->id}}" class="bg-white rounded-lg shadow-lg mb-4 lesson">
                <div class="px-6 py-4 cursor-move flex justify-between items-center">
                    
                    <h1 class="flex items-center">
                        <i class="fas fa-play-circle mr-2"></i> Lección {{$lesson->order}}:  {{$lesson->name}}
                    </h1>
                    
                    <div class="text-gray-600 actions hidden text-sm">
                        <i class="fas fa-edit cursor-pointer"></i>
                        <i class="fas fa-trash ml-2 cursor-pointer"
                        wire:click="$emit('delete-lesson', {{$lesson->id}})"></i>
                    </div>

                </div>
            </li>
        @endforeach 
    </ul>
    

    <div x-data="{open: @entangle('showFormCreate').defer}">
        <div x-on:click="open = !open"
            class="h-6 w-12 -ml-4 bg-indigo-200 flex items-center justify-center cursor-pointer"
            style="clip-path: polygon(75% 0%, 100% 50%, 75% 100%, 0% 100%, 0 51%, 0% 0%);">

            <i class="-ml-2 text-sm fas fa-plus transition duration-300" :class="{'transform rotate-45': open}"></i>
        </div>

        <form wire:submit.prevent="store" 
            class="bg-white rounded-lg shadow-lg p-6 mt-4 hidden"
            :class="{'hidden': !open}">
            <x-jet-label class="">
                Nueva lección
            </x-jet-label>

            <x-jet-input type="text" wire:model="formCreate.name" class="w-full"
                placeholder="Ingrese el nombre de la lección" />

            <x-jet-input-error for="formCreate.name" />

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
</div>
