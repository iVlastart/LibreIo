import $ from 'jquery';

$(()=>{
    const container = $('#prev-container');
    const url = 'http://localhost:8000/editor/preview/';
    let videoCounter = localStorage.getItem('videoCount') ?? 0;
    let imgCounter = localStorage.getItem('imgCount') ?? 0;
    let audioCounter = localStorage.getItem('audioCount') ?? 0;
    $('.file').each((index, element)=>{
        const projectID = element.dataset.projectid;
        const fileType = element.dataset.filetype;
        const filename = element.dataset.filename;
        element.onclick = ()=>{
            switch(fileType)
            {
                case 'video':
                    container.append(`<video src="${url}${projectID}/${encodeURIComponent(filename)}" controls class="absolute top-0 left-0 
                                                h-full w-full object-cover z-20">
                                        </video>`);
                    videoCounter++;
                    break;
                case 'image':
                    container.append(`<img id='img-${imgCounter}' src="${url}${projectID}/${encodeURIComponent(filename)}" 
                                        data-top="0" data-left="0" class="absolute 
                                        top-0 left-0 -translate-x-0 -translate-y-0 h-1/2 w-1/2 object-cover z-20">`);
                    imgCounter++;
                    break;
                case 'audio':
                    container.append(`<audio id='audio-${audioCounter}' controls src="${url}${projectID}/${encodeURIComponent(filename)}" 
                                                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-1/2 w-1/2 
                                                        object-cover z-0">
                                        </audio>`);
                    audioCounter++;
                    break
            }
        }
    });
});