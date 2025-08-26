import $ from 'jquery';

$(()=>{
    const container = $('#prev-container');
    const url = 'http://localhost:8000/editor/preview/';
    $('.file').each((index, element)=>{
        const projectID = element.dataset.projectid;
        const fileType = element.dataset.filetype;
        const filename = element.dataset.filename;
        element.onclick = ()=>{
            switch(fileType)
            {
                case 'video':
                    container.append(`<video src="${url}${projectID}/${encodeURIComponent(filename)}" controls class="absolute top-0 left-0 h-full w-full object-cover z-20"></video>`);
                    break;
                case 'image':
                    container.append(`<img src="${url}${projectID}/${encodeURIComponent(filename)}" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-1/2 w-1/2 object-cover z-20">`);
                    break;
                case 'audio':
                    container.append(`<audio controls src="${url}${projectID}/${encodeURIComponent(filename)}" class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 h-1/2 w-1/2 object-cover z-0"></audio>`);
                    break
            }
        }
    });
});