@props(['course'])

<aside class="grid-cols-1 text-gray-700" wire:ignore>
    <h1 class="font-semibold text-xl mb-4">Edición del curso</h1>

    <ul class="">
        <li class="border-l-4 {{request()->routeIs('instructor.courses.edit', $course) ? 'border-indigo-400' : 'border-transparent' }} pl-3 leading-7 mb-1">
            <a href="{{route('instructor.courses.edit', $course)}}">Información del curso</a>
        </li>

        <li class="border-l-4 {{request()->routeIs('instructor.courses.curriculum', $course) ? 'border-indigo-400' : 'border-transparent' }} pl-3 leading-7 mb-1">
            <a href="{{route('instructor.courses.curriculum', $course)}}">Lecciones del curso</a>
        </li>

        <li class="border-l-4 border-transparent pl-3 leading-7 mb-1">
            <a href="">Metas del curso</a>
        </li>

        <li class="border-l-4 border-transparent pl-3 leading-7 mb-1">
            <a href="">Estudiantes</a>
        </li>
    </ul>
</aside>