import $ from 'jquery';

$(()=>{
    const container = $('#prev-container');
    $('.file').each((index, element)=>{
        const fileType = element.dataset.filetype;
        const filePath = element.dataset.filepath;
        
        element.onclick = ()=>{
            switch(fileType)
            {
                case 'video':
                    container.append(`<video src="http://localhost:8000/storage/${filePath}" controls class="absolute top-0 left-0 h-full w-full object-cover z-20"></video>`);
                    break;
            }
        }
    });
});