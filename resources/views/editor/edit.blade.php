@vite(['resources/js/editor/eLeftSide-handler.js'])
<x-app-layout class="overflow-hidden">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project: ') }} {{ $name }}
        </h2>
    </x-slot>
    <div class="h-[calc(100vh-8.7rem)] overflow-hidden flex m-0 p-0">
        <div class="w-1/4 ml-2" id="container">
            <div class="flex flex-row justify-start gap-4 items-center">
                <div id="nav" class="flex flex-row gap-4 items-center">
                    <button id="dropzoneBtn" class="hover:scale-105 transition-transform duration-300">Dropzone</button>
                    <button id="uploadsBtn" class="hover:scale-105 transition-transform duration-300">Uploaded files</button>
                    <button id="subtitlesBtn" class="hover:scale-105 transition-transform duration-300">Subtitles</button>
                </div>
                
                <button class="mx-auto" title="toggle" id="collapseBtn" class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" id="collapseSvg" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" id="showSvg" class="hidden bi bi-arrow-right" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8"/>
                    </svg>
                </button>
            </div>
            <hr>
            <form
                class="w-full h-full  mt-3 flex items-center justify-center text-center 
                        text-lg font-semibold text-gray-600 bg-gray-50 hover:bg-gray-100 transition-colors 
                        cursor-pointer relative border-4 border-dashed border-gray-400 hidden"
                id="dropzone">
                @csrf
                <input name="name" type="hidden" value="{{ $name }}">
                <input type="file" name="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
                <p>Drag and drop your files here</p>
            </form>

            <div class="w-full h-full mt-3 flex items-start justify-start hidden
                    border-r-4 border-gray-400" id="uploads">
                @include('editor.partials.files.files', ['files'=>$files])
            </div>

            <div class="w-full h-full mt-3 flex items-center justify-center hidden" id="subtitles">
                Coming soon...
            </div>
        </div>

        <div class="w-2/4 h-full border border-black">
            <div class="w-full h-80 border border-black relative">
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2
                        bg-black h-3/4 w-3/4">
                    <video src="" class="h-full w-full"></video>
                </div>
            </div>
        </div>

        <div class="w-1/4 h-full border border-black">
            <div id="options" class="flex flex-row gap-4 items-center justify-center">
                <button id="btnGeneral" class="hover:scale-105 transition-transform duration-300">General</button>
                <button id="btnEffects" class="hover:scale-105 transition-transform duration-300">Effects</button>
                <button id="btnExport" class="hover:scale-105 transition-transform duration-300">Export</button>
            </div>
            <hr>
            <div class="ml-2 flex flex-col">
                <x-input-label :value="__('Position')"/>
                <div class="w-full flex flex-row justify-start items-center gap-x-14 mt-2">
                    <div>
                        <span class="mr-2 capitalize">x:</span>
                        <input type="number" name="" class="" min="0" max="100">
                    </div>
                    <div>
                        <span class="mr-2 capitalize">y:</span>
                        <input type="number" name="" class="" min="0" max="100">
                    </div>
                </div>

                <x-input-label :value="__('Height')"/>
                <div class="w-full flex flex-row justify-start items-center gap-x-8 mt-2">
                    <div>
                        <span class="mr-2 capitalize">width:</span>
                        <input type="number" name="" class="" min="0" max="100">
                    </div>
                    <div>
                        <span class="mr-2 capitalize">height:</span>
                        <input type="number" name="" class="" min="0" max="100">
                    </div>
                </div>
                <div class="w-full flex flex-col justify-center gap-y-2 mt-2">
                    <x-input-label for="Quality" :value="__('Quality')"/>
                    <select name="Quality" id="quality" class="hover:cursor-pointer">
                        <option value="144">144p</option>
                        <option value="240">240p</option>
                        <option value="360">360p</option>
                        <option value="480">480p</option>
                        <option value="720">720p</option>
                        <option value="1080">1080p</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>