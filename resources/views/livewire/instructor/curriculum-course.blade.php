<div>
    @push('css')
        <style>
            .lesson:hover .actions {
                display: block;
            }

        </style>
    @endpush

    <x-container class="py-8 grid grid-cols-5 gap-6">
        <x-instructor.aside-courses :course="$course" />

        <section class="col-span-4 text-gray-700">
            <div class="bg-white rounded-lg shadow px-10 py-6">
                <h1 class="text-2xl font-semibold">Lecciones del curso</h1>
                <hr class="mt-2 mb-6">

                {{-- Secciones --}}
                <ul class="space-y-6" x-data x-ref="sections" x-init="new Sortable($refs.sections, {
                        handle: '.handle',
                        sort: true,
                        animation: 150,
                        ghostClass: 'blue-background-class',
                        store: {
                            
                            set: (sortable) => {
                                const sorts = sortable.toArray();
                                console.log(sorts);
                                Livewire.emitTo('instructor.curriculum-course','sortSections', sorts)
                            }
                        }
                    });">

                    @foreach ($sections as $section)

                        <li class="bg-gray-100 rounded-lg shadow-lg" wire:key="section-{{ $section->id }}"
                            data-id="{{ $section->id }}">

                            <div class="px-6 py-4 cursor-move flex justify-between items-center handle">
                                <h1>
                                    Sección {{ $section->position }}: <span
                                        class="ml-2 font-semibold">{{ $section->name }}</span>
                                </h1>

                                <div>
                                    <x-jet-secondary-button wire:click="edit({{ $section->id }})"
                                        wire:target="edit({{ $section->id }})" wire:loading.attr="disabled">
                                        <i class="fas fa-edit cursor-pointer"></i>
                                    </x-jet-secondary-button>

                                    <x-jet-danger-button wire:click="$emit('delete-section', {{ $section->id }})"
                                        wire:target="deleteSection({{ $section->id }})" wire:loading.attr="disabled">
                                        <i class="fas fa-trash cursor-pointer"></i>
                                    </x-jet-danger-button>
                                </div>
                            </div>

                            @livewire('instructor.show-lessons', ['section' => $section], key('show-lessons-'.
                            $section->id))

                        </li>
                    @endforeach
                </ul>

                {{-- Crear seccion --}}
                <div x-data="{open: @entangle('showFormCreate').defer}" class="mt-6">
                    <div x-on:click="open = !open"
                        class="h-6 w-12 -ml-4 bg-indigo-200 flex items-center justify-center cursor-pointer"
                        style="clip-path: polygon(75% 0%, 100% 50%, 75% 100%, 0% 100%, 0 51%, 0% 0%);">

                        <i class="-ml-2 text-sm fas fa-plus transition duration-300"
                            :class="{'transform rotate-45': open}"></i>
                    </div>

                    <form wire:submit.prevent="store" class="bg-gray-100 rounded-lg shadow-lg p-6 mt-4 hidden"
                        :class="{'hidden': !open}">
                        <x-jet-label class="">
                            Nueva sección
                        </x-jet-label>

                        <x-jet-input type="text" wire:model="formCreate.name" class="w-full"
                            placeholder="Ingrese el nombre de una sección" />

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
        </section>
    </x-container>

    {{-- Modal formulario editar --}}
    <x-jet-dialog-modal maxWidth="md" wire:model="showFormEdit">
        <x-slot name="title">
            Editar seccion
        </x-slot>

        <x-slot name="content">
            <x-jet-label>
                Nombre
            </x-jet-label>
            <x-jet-input type="text" wire:model="formEdit.name" class="w-full" />
            <x-jet-input-error for="formEdit.name" />
        </x-slot>

        <x-slot name="footer">
            <x-jet-danger-button wire:click="cancelEdit" wire:loading.attr="disabled" wire:target="cancelEdit">
                Cancelar
            </x-jet-danger-button>

            <x-jet-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.13.0/Sortable.min.js"
                integrity="sha512-5x7t0fTAVo9dpfbp3WtE2N6bfipUwk7siViWncdDoSz2KwOqVC1N9fDxEOzk0vTThOua/mglfF8NO7uVDLRC8Q=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            Livewire.on('delete-section', sectionId => {

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Si, eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('instructor.curriculum-course', 'delete', sectionId);

                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })

            })

            Livewire.on('delete-lesson', lessonId => {

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Si, eliminar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {

                        Livewire.emitTo('instructor.curriculum-course', 'deleteLesson', lessonId);

                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                    }
                })

            })

            Livewire.on('console', lessonId => {
                console.log(lessonId);
            })
        </script>

    @endpush

</div>
