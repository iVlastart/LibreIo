import $ from 'jquery';

//script to handle the left side of the video editor 
$(()=>{
    let collapsed = false;
    let activeElem = localStorage.getItem('activeElem') ?? "dropzone";
    const dropzone = $('#dropzone');
    const nav = $('#nav');
    const collapseSvg = $('#collapseSvg');
    const showSvg = $('#showSvg');
    const uploads = $('#uploads');
    const subtitles = $('#subtitles');

    //handle showing/hiding the elements
    $(window).on("load", function() {
      $(`#${activeElem}`).removeClass('hidden');
    });

    $('#collapseBtn').on('click', ()=>{
       collapsed
            ? $(`#${activeElem}`).removeClass('hidden')
            : $(`#${activeElem}`).addClass('hidden');
        collapseSvg.toggleClass('hidden');
        showSvg.toggleClass('hidden');
        nav.toggleClass('hidden');
        collapsed = !collapsed;
    });

    $('#dropzoneBtn').on('click', ()=>{
        dropzone.removeClass('hidden');
        uploads.addClass('hidden');
        subtitles.addClass('hidden');
        activeElem = "dropzone";
    });

    $('#uploadsBtn').on('click', ()=>{
        dropzone.addClass('hidden');
        uploads.removeClass('hidden');
        subtitles.addClass('hidden');
        activeElem = "uploads";
    });

    $('#subtitlesBtn').on('click', ()=>{
        dropzone.addClass('hidden');
        uploads.addClass('hidden');
        subtitles.removeClass('hidden');
        activeElem = "subtitles";
    });

    //save the active element in the local storage when user leaves the page
    $(window).on("unload", ()=>{
        localStorage.setItem("activeElem", activeElem);
    });


    dropzone.on('change', function(e){
        e.preventDefault();
        e.stopImmediatePropagation();

        const form = $(e.target).closest('form')[0];
        const data = new FormData(form);

        $.ajax({
            type: 'POST',
            url: '/editor/upload',
            data: data
        })
    });

});