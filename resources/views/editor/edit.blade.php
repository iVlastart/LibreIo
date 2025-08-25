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
            <form 
                method="POST" 
                class="w-full h-full  mt-3 flex items-center justify-center text-center 
                        text-lg font-semibold text-gray-600 bg-gray-50 hover:bg-gray-100 transition-colors 
                        cursor-pointer relative border-4 border-dashed border-gray-400"
                id="dropzone">
                @csrf
                <input type="file" name="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
                <p>Drag and drop your files here</p>
            </form>

            <div class="w-full h-full mt-3 flex items-center justify-center hidden
                    border-r-4 border-gray-400" id="uploads">
                Uploads
            </div>

            <div class="w-full h-full mt-3 flex items-center justify-center hidden" id="subtitles">
                Subtitles
            </div>
        </div>
    </div>

    <script>
        const dropzone = document.getElementById("dropzone");
        const fileInput = dropzone.querySelector("input[type=file]");

        dropzone.addEventListener("dragover", (e) => {
            e.preventDefault();
            dropzone.classList.add("bg-gray-200");
        });

        dropzone.addEventListener("dragleave", () => {
            dropzone.classList.remove("bg-gray-200");
        });

        dropzone.addEventListener("drop", (e) => {
            e.preventDefault();
            dropzone.classList.remove("bg-gray-200");
            fileInput.files = e.dataTransfer.files;
            dropzone.submit();
        });
    </script>
</x-app-layout>