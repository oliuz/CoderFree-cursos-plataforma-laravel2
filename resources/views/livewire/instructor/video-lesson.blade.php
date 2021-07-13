<div>
    @if ($lesson->url)
        Esta lección tiene video
        
    @else
    
        @if ($video)

            {{-- Procesando mientras se sube --}}
            <table class="table-auto w-full">
                <thead class="border-b border-gray-200">
                    <tr class="font-bold">
                        <td class="px-4 py-2">Nombre del archivo</td>
                        <td class="px-4 py-2">Tipo</td>
                        <td class="px-4 py-2">Estado</td>
                        <td class="px-4 py-2">Fecha</td>
                        <td class="px-4 py-2"></td>
                    </tr>
                </thead>
    
                <tbody class="border-b border-gray-200">
                    <tr>
                        <td class="px-4 py-2">Crud subcategoría.mp4</td>
                        <td class="px-4 py-2">Video</td>
                        <td class="px-4 py-2">Procesamiento</td>
                        <td class="px-4 py-2">07/12/2021</td>
                        <td class="px-4 py-2">Sustituir</td>
                    </tr>
                </tbody>
            </table>
    
            <p class="mt-2"><span class="font-bold">Nota:</span> El video se está procesando, espere un momento</p>

            
        @else

            {{-- Subir video --}}
            <div x-data="{ isUploading: false, progress: 0 }" x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress">

                <label class="border-1 border-gray-200 shadow rounded overflow-hidden flex w-full cursor-pointer">
                    <input wire:model="video" type="file" accept="video/*" class="hidden">

                    <div class="bg-gray-200 flex-1 px-4 py-2 relative">

                        {{-- Avance --}}
                        <div class="absolute left-0 top-0 w-full h-full z-10 hidden" :class="{'hidden': !isUploading}">
                            <div :style="'width:' + progress + '%'" class="bg-indigo-500 h-full"></div>
                        </div>

                        {{-- Texto --}}
                        <span class="relative z-20" x-show="!isUploading">
                            No ha seleccionado ningín archivo
                        </span>

                        <span class="block relative z-20 font-bold text-center hidden" :class="{'hidden': !isUploading}"
                            x-text="progress + '%'">
                        </span>
                    </div>

                    {{-- Boton de envío --}}
                    <div>
                        <span
                            class="bg-transparent hover:bg-blue-500 text-blue-700 border border-blue-500 hover:border-transparent hover:text-white rounded-r font-semibold px-4 h-full inline-flex items-center">
                            Agregar video
                        </span>
                    </div>
                </label>

                <p class="mt-2"><span class="font-bold">Nota:</span> Ningún videos debe superar el tamaño de 2GB.</p>
            </div>

        @endif

    @endif
   
</div>
