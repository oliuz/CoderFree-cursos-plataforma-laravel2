<div>
    <ul>
        @foreach ($lessons as $lesson)
            <li data-id="{{ $lesson->id }}" wire:key="lesson-{{$lesson->id}}" class="bg-white rounded-lg shadow-lg mb-4 lesson">
                {{-- Título de la lección --}}
                <div class="px-6 py-4 cursor-move flex justify-between items-center">

                    <h1 class="flex items-center">
                        <i class="fas fa-play-circle mr-2"></i> Lección
                        {{ $lesson->order }}: {{ $lesson->name }}
                    </h1>



                    <div class="text-gray-600 actions hidden text-sm">
                        <i wire:click="editLesson({{ $lesson->id }})" class="fas fa-edit cursor-pointer"
                            wire:loading.class="text-blue-600" wire:target="editLesson({{ $lesson->id }})"></i>
                        <i wire:click="$emit('delete-lesson', {{ $lesson->id }})"
                            class="fas fa-trash ml-2 cursor-pointer" wire:loading.class="text-red-600"
                            wire:target="editLesson({{ $lesson->id }})"></i>
                    </div>

                </div>

                {{-- Detalle de la lección --}}
                <div class="px-6 pb-4">
                    <ul class="flex border-b border-gray-200 font-semibold text-gray-500 mb-4">
                        <li class="mr-6 border-b-2 border-indigo-500">
                            <a class="inline-block pb-2 text-indigo-500 cursor-pointer">
                                Video
                            </a>
                        </li>
                        <li>
                            <a class="inline-block mr-6 pb-2 cursor-pointer">
                                Descripción
                            </a>
                        </li>
                        <li>
                            <a class="inline-block mr-6 pb-2 cursor-pointer">
                                Recurso
                            </a>
                        </li>
                    </ul>

                    {{-- video --}}
                    <div>
                        @livewire('instructor.video-lesson', ['lesson' => $lesson], key('video-lesson-' . $lesson->id))
                    </div>
                    
      
                </div>
            </li>
        @endforeach
    </ul>

    <div x-data="{open: @entangle('formCreateLesson.open').defer}">
        <div x-on:click="open = !open"
            class="h-6 w-12 -ml-4 bg-indigo-200 flex items-center justify-center cursor-pointer"
            style="clip-path: polygon(75% 0%, 100% 50%, 75% 100%, 0% 100%, 0 51%, 0% 0%);">

            <i class="-ml-2 text-sm fas fa-plus transition duration-300" :class="{'transform rotate-45': open}"></i>
        </div>

        <form wire:submit.prevent="storeLesson()" class="bg-white rounded-lg shadow-lg p-6 mt-4 hidden"
            :class="{'hidden': !open}">
            <x-jet-label class="">
                Nueva lección
            </x-jet-label>

            <x-jet-input type="text" wire:model="formCreateLesson.name" class="w-full"
                placeholder="Ingrese el nombre de la lección" />

            <x-jet-input-error for="formCreateLesson.name" />

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

    {{-- Modal editar lesson --}}
    <x-jet-dialog-modal maxWidth="md" wire:model="formEditLesson.open">
        <x-slot name="title">
            Editar seccion
        </x-slot>

        <x-slot name="content">
            <x-jet-label>
                Nombre
            </x-jet-label>
            <x-jet-input type="text" wire:model.defer="formEditLesson.name" class="w-full" />
            <x-jet-input-error for="formEditLesson.name" />
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="cancelEditLesson" wire:loading.attr="disabled"
                wire:target="cancelEditLesson">
                Cancelar
            </x-jet-danger-button>

            <x-jet-button wire:click="updateLesson" wire:loading.attr="disabled" wire:target="updateLesson">
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
