@props(['src' => null, 'title' => null, 'views'=>0])

<div class="grid grid-cols-3 grid-rows-[auto_auto_auto_auto] hover:cursor-pointer border border-black w-fit h-fit mr-2">
    <header class="col-span-3 row-span-2">
        <img src="{{ $src }}" 
             class="w-full h-auto max-h-96 object-cover" 
             onerror="alert('there was an error loading the img')" />
    </header>
    
    <main class="col-span-3 font-bold row-start-3 text-2xl border border-black h-fit">
        {{ $title }}
    </main>
    <div class="col-span-1 row-start-4 border border-black">
        {{ $views }} views
    </div>
    <div class="col-start-2 col-span-2 row-start-4 text-center">
        time
    </div>
</div>