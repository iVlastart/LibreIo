<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LibreIo / Create</title>
</head>
<body>
    <x-app-layout>
        <div class="py-4">
            <div class="max-w-3xl mx-auto sm:px-6:lg-px-8">
                <div class="bg-white overflow-hidden shadow sm sm:rounded-lg">
                    <header class="text-center my-2">
                        Create a new post
                    </header>
                        <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="p-2">
                                
                                <div class="mt-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload file</label>
                                    <input name="src" class="block w-full text-sm text-gray-900 border 
                                            border-gray-300 rounded-lg cursor-pointer bg-gray-50" 
                                            id="file_input" type="file">
                                    <p class="mt-1 text-sm text-gray-500" id="file_input_help">MP4 (MAX. 40MB).</p>
                                    <x-input-error :messages="$errors->get('src')" class="mt-2"/>
                                </div>

                                <div class="mt-4">
                                    <label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Upload thumbnail</label>
                                    <input name="thumbnail" class="block w-full text-sm text-gray-900 border 
                                            border-gray-300 rounded-lg cursor-pointer bg-gray-50" 
                                            id="img_input" type="file">
                                    <p class="mt-1 text-sm text-gray-500" id="file_input_help">JPG, JPEG, PNG, WEBP</p>
                                    <x-input-error :messages="$errors->get('thumbnail')" class="mt-2"/>
                                </div>
                                
                                
                                <div class="mt-4">
                                    <x-input-label for="Title" :value="__('Title')"/>
                                    <x-text-input name="title" id="Title" class="block mt-1 w-full" type="text" :value="__('')"/>
                                    <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                                </div>
                                
                                <div class="mt-4">
                                    <x-input-label for="Description" :value="__('Description')"/>
                                    <x-textarea-input name="descr" id="Description" class="block mt-1 w-full" :value="__('')"/>
                                    <x-input-error :messages="$errors->get('descr')" class="mt-2"/>
                                </div>
                                

                                <div class="mt-4">
                                    <label for="Visibility" class="block mb-2 text-sm font-medium text-gray-900">Select visibility</label>
                                    <select id="visibility" name="visibility" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                        <option value="public">Public</option>
                                        <option value="private">Private</option>
                                    </select>
                                </div>
                                
                                <div class="mt-4 text-center">
                                    <x-primary-button align="center">
                                        Upload
                                    </x-primary-button>
                                </div>
                                
                            </div>
                        </form>
                    
                </div>
            </div>
        </div>
    </x-app-layout>
</body>
</html>