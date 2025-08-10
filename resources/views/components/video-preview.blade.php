@props(['src'=>null, 'title' => null, 'views'=>0, 'slug'=>null, 'date'=>null])

<div class="preview-container grid grid-cols-3 grid-rows-[auto_auto_auto_auto] border 
            border-black w-fit h-fit mr-2 hover:cursor-pointer"\
        data-slug="{{ $slug }}">
    <script src=""></script>
    <header class="col-span-3 row-span-2">
        <img src="{{ asset("/storage/$src") }}" 
             class="w-full h-auto object-fill aspect-video max-h-60 max-w-80" 
             onerror="alert('there was an error loading the img')" />
    </header>
    
    <main class="col-span-3 font-bold row-start-3 text-2xl border border-black h-fit">
        {{ $title }}
    </main>
    <div class="col-span-1 row-start-4 border border-black">
        {{ $views }} views
    </div>
    <div class="date col-start-2 col-span-2 row-start-4 text-center">
        {{ $date }}
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', ()=>{
            document.querySelectorAll('.preview-container').forEach(element=>{
                const slug = element.dataset.slug;
                if(slug)
                {
                    element.addEventListener('click', ()=>{
                        location.assign('/watch/'+slug);
                    });
                }
            });
        });
    </script>
</div>