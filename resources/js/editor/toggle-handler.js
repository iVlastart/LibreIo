import $ from 'jquery';

$(()=>{
    let collapsed = false;
    let activeElem = localStorage.getItem('activeElem') ?? "dropzone";
    let activeOption = localStorage.getItem('activeOption') ?? "general";
    const dropzone = $('#dropzone');
    const nav = $('#nav');
    const collapseSvg = $('#collapseSvg');
    const showSvg = $('#showSvg');
    const uploads = $('#uploads');
    const subtitles = $('#subtitles');

    const general = $('#general');
    const effects = $('#effects');
    const exprt = $('#export'); 

    //handle showing/hiding the elements
    $(window).on("load", function() {
      $(`#${activeElem}`).removeClass('hidden');
      $(`#${activeOption}`).removeClass('hidden');
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

    $('#btnGeneral').on('click', ()=>{
        general.removeClass('hidden');
        effects.addClass('hidden');
        exprt.addClass('hidden');
        activeOption = "general";
    });

    $('#btnEffects').on('click', ()=>{
        general.addClass('hidden');
        effects.removeClass('hidden');
        exprt.addClass('hidden');
        activeOption = "effects";
    });

    $('#btnExport').on('click', ()=>{
        general.addClass('hidden');
        effects.addClass('hidden');
        exprt.removeClass('hidden');
        activeOption = "export";
    });

    //save the active element in the local storage when user leaves the page
    $(window).on("unload", ()=>{
        localStorage.setItem("activeElem", activeElem);
        localStorage.setItem("activeOption", activeOption);
    });
})