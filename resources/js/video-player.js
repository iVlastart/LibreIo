const container = document.querySelector('.video-container')
const playPauseBtn = document.querySelector('.play-pause-btn');
const miniPlayerBtn = document.querySelector('.mini-player-btn');
const theaterBtn = document.querySelector('.theater-btn');
const fullScreenBtn = document.querySelector('.full-screen-btn');
const muteBtn = document.querySelector('.mute-btn');
const volumeSlider = document.querySelector('.volume-slider');
const currentTime = document.querySelector('.current-time');
const totalTime = document.querySelector('.total-time');
const timelineContainer = document.querySelector('.timeline-container');
const video = document.querySelector('video');

document.addEventListener('keydown', e=>{
    const tagName = document.activeElement.tagName.toLowerCase();
    if(tagName==="input") return;
    switch(e.key.toLowerCase())
    {
        case " ":
                if(tagName==="button") return;
            case "k":
                e.preventDefault();
                togglePlay();
                break;
            case "i":
                toggleMiniPlayer();
                break;
            case "t":
                toggleTheater();
                break;
            case "f":
                toggleFullScreen();
                break;
            case "m":
                toggleMute();
                break;
            /*case "arrowleft":
                case "j":
                    skip(-5);
                    break;
            case "arrowright":
                case "l":
                    skip(5);
                    break;*/
    }
});

playPauseBtn.addEventListener('click', togglePlay);
video.addEventListener('click', togglePlay)

video.addEventListener('play', ()=>container.classList.remove('paused'));
video.addEventListener('pause', ()=>container.classList.add('paused'));

document.addEventListener('fullscreenchange',()=>container.classList.toggle('full-screen', document.fullscreenElement));

video.addEventListener('volumechange', ()=>{
    volumeSlider.value = video.volume;
    let volumeLevel;
    if(video.muted || video.volume===0)
    {
        volumeSlider.value = 0;
        volumeLevel = "muted";
    }
    else if (video.volume>.5) volumeLevel = "high"; 
    else volumeLevel = "low";

    container.dataset.volumeLevel = volumeLevel;
        
});
volumeSlider.addEventListener('input', e=>{
    video.volume = e.target.value;
    video.muted = e.target.value===0;
});

//view mods listeners
miniPlayerBtn.addEventListener('click', toggleMiniPlayer);
theaterBtn.addEventListener('click', toggleTheater);
fullScreenBtn.addEventListener('click', toggleFullScreen);
video.addEventListener('enterpictureinpicture', ()=>container.classList.add('mini-player'));
video.addEventListener('leavepictureinpicture', ()=>container.classList.remove('mini-player'));

muteBtn.addEventListener('click', toggleMute);

//duration listeners
video.addEventListener('loadedmetadata', ()=>{
    if (video.duration && isFinite(video.duration)) {
        totalTime.textContent = formatDuration(video.duration);
    }
});
video.addEventListener('timeupdate', ()=>{
    if (video.duration && isFinite(video.duration)) {
    currentTime.textContent = formatDuration(video.currentTime);
    const percentage = video.currentTime / video.duration;
    timelineContainer.style.setProperty('--progress-position', percentage);}
});
//timelineContainer.addEventListener('mousemove', timelineUpdate);
//timelineContainer.addEventListener('mousedown', toggleScrubbing);

//like dislike a post


//view mods
function togglePlay()
{
    video.paused ? video.play() : video.pause();
}

function toggleMiniPlayer()
{
    container.classList.contains('mini-player')
        ? document.exitPictureInPicture()
        : video.requestPictureInPicture();
}

function toggleTheater()
{
    container.classList.toggle('theater');
}

function toggleFullScreen()
{
    document.fullscreenElement==null 
        ? container.requestFullscreen()
        : document.exitFullscreen()
}

//volume
function toggleMute()
{
    video.muted = !video.muted;
}

//duration
const leadingZeroFormatter = new Intl.NumberFormat(undefined, {
        minimumIntegerDigits: 2
    });
function formatDuration(t)
{
    
    const s = Math.floor(t%60);
    const m = Math.floor(t/60)%60;
    const h = Math.floor(t/3600);

    return h===0
        ? `${m}:${leadingZeroFormatter.format(s)}`
        : `${h}:${m}:${leadingZeroFormatter.format(s)}`;
}

/*function timelineUpdate(e)
{
    const rect = timelineContainer.getBoundingClientRect();
    const percentage = Math.min(Math.max(0, e.x - rect.x), rect.width)/rect.width;
    timelineContainer.style.setProperty('--preview-position', percentage);

    if(isScrubbing)
    {
        e.preventDefault();
        timelineContainer.style.setProperty('--progress-position', percentage);
    }
}

let isScrubbing = false;
let wasPaused;
function toggleScrubbing(e)
{
    const rect = timelineContainer.getBoundingClientRect();
    const percentage = Math.min(Math.max(0, e.x - rect.x), rect.width)/rect.width;

    isScrubbing = (e.buttons && 1)===1;
    container.classList.toggle('scrubbing', isScrubbing);
    if(isScrubbing)
    {
        wasPaused = video.paused;
        video.pause();
    }
    else
    {
        video.currentTime = percentage * video.duration;
        if(!wasPaused) video.play();
    }

    timelineUpdate(e);
}*/

/*function skip(t)
{
    video.currentTime+=t;
}*/