<div id="video-container"
        class="w-[90%] max-w-[1000px] flex justify-center mx-auto relative group">
        <div id="video-controls-container" class="absolute bottom-0 left-0 right-0 text-white z-50 
                transition-opacity duration-150 ease-in-out opacity-0 group-hover:opacity-100 group-focus-within:opacity-100">
            <div id="timeline-container">

            </div>
            <div id="controls" class="flex gap-2 p-1 items-center">
                <button id="play-pause-btn">
                    <svg id="play-icon" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M8,5.14V19.14L19,12.14L8,5.14Z" />
                    </svg>
                    <svg id="pause-icon" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M14,19H18V5H14M6,19H10V5H6V19Z" />
                    </svg>
                </button>
            </div>
        </div>
    <video src="{{ asset('uploads/test.mp4') }}" class="w-[100%]"></video>
</div>
