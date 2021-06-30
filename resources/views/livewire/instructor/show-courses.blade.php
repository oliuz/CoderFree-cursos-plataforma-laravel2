<div>
    <x-container class="py-8">
        <ul class="space-y-4 text-gray-700">
            
            @forelse ($courses as $course)
             
                <li class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="flex">
                        <img class="w-48 h-36 object-cover" src="{{Storage::url($course->image)}}" alt="">
                        <div class="flex-1">

                            <div class="grid grid-cols-9 gap-4 p-4">

                                <div class="col-span-3">
                                    <h1>
                                        <a href="{{route('instructor.courses.edit', $course)}}">{{$course->title}}</a>
                                    </h1>
                                </div>
        
                                <div class="col-span-2">
                                    <p class="text-sm font-bold">320 USD</p>
                                    <p class="mb-1">Ganado este mes</p>
        
                                    <p class="text-sm font-bold">1500 USD</p>
                                    <p>Ganado en total</p>
                                </div>
        
                                <div class="col-span-2">
                                    <p>57</p>
                                    <p>Inscripciones este mes</p>
                                </div>
                                
                                <div class="col-span-2">
                                    <div class="flex items-center">
                                        <p class="mr-3">4.74</p>

                                        <ul class="flex space-x-1 text-sm text-yellow-400">
                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>

                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>

                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>

                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>

                                            <li>
                                                <i class="fas fa-star"></i>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

            @empty
                
            @endforelse
        </ul>

        <div class="mt-4">
            {{$courses}}
        </div>
    </x-container>
</div>