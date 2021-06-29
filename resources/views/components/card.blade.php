<article {{ $attributes->merge(['class' => 'bg-white rounded overflow-hidden shadow-lg']) }}>
    {{-- <img class="w-full" src="/img/card-top.jpg" alt="Sunset in the mountains"> --}}

    @isset($img_top)
        {{$img_top}}
    @endisset

    <div class="px-6 py-4">

        {{$slot}}
      
    </div>

    @isset($footer)
        
    
        <div class="px-6 pt-4 pb-2">

            {{$footer}}
            {{-- <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#photography</span>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#travel</span>
            <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">#winter</span> --}}
        </div>

    @endisset
</article>