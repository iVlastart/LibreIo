<div class="faqitem flex flex-col items-center border-b py-4 hover:cursor-pointer">
    <div class="flex flex-row items-center w-full">
       <span class="flex-1">
            {{ $question }}                               
        </span>
        <div class="arrowdown">
            @include('welcome.partials.arrowdown')
        </div>
        <div class="arrowup hidden">
            @include('welcome.partials.arrowup')
        </div>
    </div>
    
    
    <p class="desc mt-5 text-gray-500 overflow-hidden max-h-0 opacity-0 transition-all duration-500">
        {{ $answer }}
    </p>
</div>