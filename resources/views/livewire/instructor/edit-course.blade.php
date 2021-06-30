<div>

    <x-container class="py-8 grid grid-cols-5 gap-6">

        <x-instructor.aside-courses :course="$course" />

        <section class="col-span-4 text-gray-700">
            <div class="bg-white rounded-lg shadow px-4 py-6">

                <h1 class="text-2xl font-semibold">Información del curso</h1>
                <hr class="mt-2 mb-6">

                {{-- Titulo del curso --}}
                <div class="mb-4">
                    <x-jet-label value="Título del curso" />
                    <x-jet-input type="text" class="w-full" wire:model="course.title" />
                    <x-jet-input-error for="course.title" />
                </div>

                {{-- Slug del curso --}}
                <div class="mb-4">
                    <x-jet-label value="Slug del curso" />
                    <x-jet-input type="text" class="w-full" wire:model="slug" />
                    <x-jet-input-error for="slug" />
                </div>

                {{-- Subtitulo del curso --}}
                <div class="mb-4">
                    <x-jet-label value="Subtítulo del curso" />
                    <x-jet-input type="text" class="w-full" wire:model.defer="course.subtitle" />
                    <x-jet-input-error for="course.subtitle" />
                </div>

                {{-- Descripcion del curso --}}
                <div wire:ignore>
                    <x-jet-label value="Descripción del curso del curso" />

                    <div class="form-textarea w-full"
                        x-data
                        x-init="
                            ClassicEditor.create($refs.myIdentifierHere, {
                                toolbar: ['heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList',
                                    'blockQuote'
                                ],
                                heading: {
                                    options: [{
                                            model: 'paragraph',
                                            title: 'Paragraph',
                                            class: 'ck-heading_paragraph'
                                        },
                                        {
                                            model: 'heading1',
                                            view: 'h1',
                                            title: 'Heading 1',
                                            class: 'ck-heading_heading1'
                                        },
                                        {
                                            model: 'heading2',
                                            view: 'h2',
                                            title: 'Heading 2',
                                            class: 'ck-heading_heading2'
                                        }
                                    ]
                                }
                            })
                            .then( function(editor){
                                editor.model.document.on('change:data', () => {
                                    @this.set('course.description', editor.getData());
                                })
                            })
                            .catch( error => {
                                console.error( error );
                            } );
                        "
                        wire:key="myIdentifierHere"
                        x-ref="myIdentifierHere">
                            {!!$course->description!!}
                    </div>
                </div>

                <div class="mb-4">
                    <x-jet-input-error for="course.description" />
                </div>

                
                <div class="grid grid-cols-3 gap-4">
                    {{-- Categoria --}}
                    <div>
                        <x-jet-label value="Categorías" />
                        <select wire:model="category_id" class="form-control w-full">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Subcategoria --}}
                    <div>
                        <x-jet-label value="Subcategorías" />
                        <select wire:model.defer="course.subcategory_id" class="form-control w-full">
                            @foreach ($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Level --}}
                    <div>
                        <x-jet-label value="Nivel" />
                        <select wire:model.defer="course.level_id" class="form-control w-full">
                            @foreach ($levels as $level)
                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Imagen --}}
                <div>
                    <p class="text-2xl font-semibold mt-8 mb-2">Imagen del curso</p>

                    <div class="grid grid-cols-2 gap-4">
                        <figure class="relative">

                            <div wire:loading.flex wire:target="photo"
                                class="absolute w-full h-full items-center justify-center">

                                <div class="rounded animate-spin ease duration-300 w-10 h-10 border-2 border-indigo-500">
                                </div>

                            </div>

                            @if ($photo)
                                <img class="w-full h-64 object-cover object-center" src="{{ $photo->temporaryUrl() }}"
                                    alt="">
                            @else
                                <img class="w-full h-64 object-cover object-center" src="{{ Storage::url($course->image) }}"
                                    alt="">
                            @endif
                        </figure>

                        <div>
                            <p class="mb-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat, vel ratione
                                iusto voluptate eos asperiores veritatis dolorum tempora quis ipsam ullam incidunt ex
                                dolores illum, totam saepe! Totam, nulla doloribus!</p>
                            <input id="{{ $identificador }}" type="file" wire:model="photo" accept="image/*">
                            <x-jet-input-error for="photo" />
                        </div>
                    </div>
                </div>

                <div class="flex justify-end items-center">
                    <x-jet-action-message class="mr-3" on="saved">
                        Actualizado
                    </x-jet-action-message>
            
                    <x-jet-button wire:click="save" wire:loading.attr="disabled" target="save, image">
                        Guardar cambios
                    </x-jet-button>
                </div>

            </div>
        </section>
    
    </x-container>

    @push('js')
        <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script>
    @endpush
</div>