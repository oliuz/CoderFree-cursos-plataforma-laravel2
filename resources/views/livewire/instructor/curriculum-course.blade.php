<div>
    <x-container class="py-8 grid grid-cols-5 gap-6">
        <x-instructor.aside-courses :course="$course" />

        <section class="col-span-4 text-gray-700">

            <div class="bg-white rounded-lg shadow px-10 py-6">
                <h1 class="text-2xl font-semibold">Lecciones del curso</h1>
                <hr class="mt-2 mb-6">

                {{-- Secciones --}}
                <div x-data x-ref="sections"
                    x-init="new Sortable($refs.sections, {
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
                        <article class="bg-gray-100 rounded-lg shadow-lg mb-6"
                            wire:key="section-{{$section->id}}"
                            data-id="{{$section->id}}">

                            {{-- @livewire('instructor.edit-section', ['section' => $section], key('edit-section-' . $section->id)) --}}

                            <div class="cursor-move px-6 py-4 flex justify-between items-center handle">
                                <h1>
                                    Sección {{$section->position}}: <span class="ml-2 font-semibold">{{$section->name}}</span>
                                </h1>

                                <button>
                                    <i class="fas fa-edit cursor-pointer"></i>
                                </button>

                            </div>

                            <div>
                                Formulario edit
                            </div>

                        </article>
                    @endforeach

                </div>


                {{-- Formulario crear nueva sección --}}
                <div x-data="{open: @entangle('showFormCreate').defer}">
                    <div x-on:click="open = !open" 
                        class="h-8 w-14 -ml-4 bg-indigo-200 flex items-center justify-center cursor-pointer" 
                        style="clip-path: polygon(75% 0%, 100% 50%, 75% 100%, 0% 100%, 0 51%, 0% 0%);">
                        
                        <i class="-ml-2 fas fa-plus transition duration-300" :class="{'transform rotate-45': open}"></i>
                    </div>
                
                    <form wire:submit.prevent="storeSection" x-show="open" class="bg-gray-100 rounded-lg shadow-lg p-6 mt-4">
                        <x-jet-label class="">
                            Nueva sección
                        </x-jet-label>
                
                        <x-jet-input type="text"
                            wire:model="formCreate.name"
                            class="w-full"
                            placeholder="Ingrese el nombre de una sección"/>
                
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

                {{-- Formulario editar sección --}}
                

            </div>
        </section>
    </x-container>

    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.13.0/Sortable.min.js"
                integrity="sha512-5x7t0fTAVo9dpfbp3WtE2N6bfipUwk7siViWncdDoSz2KwOqVC1N9fDxEOzk0vTThOua/mglfF8NO7uVDLRC8Q=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @endpush
</div>
