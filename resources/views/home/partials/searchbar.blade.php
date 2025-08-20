@vite('resources/js/search-handler.js')
<div class="mx-auto relative">
    <input id="search-bar" type="search" maxlength="30" placeholder="Search" 
            class="px-4 py-2 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" id="search-input">
    <button id="search-btn" class="absolute right-0 top-0 h-full px-4 bg-blue-500 text-white rounded-r-full flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
        </svg>
    </button>
</div>