<x-app-layout class="overflow-hidden">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Project: ') }} {{ $name }}
        </h2>
    </x-slot>
    
    <div class="h-[calc(100vh-8.7rem)] overflow-hidden flex m-0 p-0">
        <!-- Drop Zone -->
        <form 
            method="POST" 
            class="w-1/4 h-full border-4 border-dashed border-gray-400 flex items-start justify-center text-center 
                    text-lg font-semibold text-gray-600 bg-gray-50 hover:bg-gray-100 transition-colors 
                    cursor-pointer relative"
            id="dropzone">
            @csrf
            <input type="file" name="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" />
            
        </form>

        <div>
            
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