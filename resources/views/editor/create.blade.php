<x-app-layout class="relative">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Name your project') }}
        </h2>
    </x-slot>

    <div class="absolute left-1/2 -translate-x-1/2 top-1/2 -translate-y-1/2 p-6">
        <form method="POST" action="{{ route('editor.store') }}" class="max-w-2xl mx-auto mt-10">
            @csrf
            <div class="mb-4">
                <x-input-label for="Name" :value="__('Name')"/>
                <x-text-input name="name" id="Name" class="block mt-1 w-full" type="text" :value="__('')" maxlength="30"/>
                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600 transition-colors duration-300">Create Project</button>
            </div>
        </form>
    </div>
    
</x-app-layout>