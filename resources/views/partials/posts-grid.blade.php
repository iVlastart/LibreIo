@vite('resources/js/date-handler.js')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div id="posts-list" class="mt-5 grid gap-4 
                        grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @include('partials.posts', ['posts'=>$posts])
                </div>
                {{--<div class="flex w-full justify-center mt-5">
                    {{ $posts->links() }}
                </div>--}}
                @include('partials.spinner')
            </div>
        </div>
    </div>
</div>