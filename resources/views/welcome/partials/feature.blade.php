<div class="relative mt-20 lg:mt-24">
    <div class="container flex flex-col {{ $reverse ? 'lg:flex-row-reverse' : 'flex-col lg:flex-row' }} items-center justify-center gap-x-24">
        <div class="flex flex-1 justify-center z-10 mb-10 lg:mb-0">
            <img src="{{ $src }}" class="w-5/6 h-5/6 sm:h-3/4 md:w-full md:h-full">
        </div>
        <div class="flex flex-1 flex-col items-center lg:items-start">
            <h1 class="text-3xl text-blue-500 ">
                {{ $title }}
            </h1>
            <p class="text-gray-500 my-4 text-center lg:text-left sm:w-3/4 lg:w-full">
                {{ $desc }}
            </p>
        </div>
    </div>
</div>