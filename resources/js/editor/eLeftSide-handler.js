import $ from 'jquery';

//script to handle the left side of the video editor 
$(()=>{
    const dropzone = $('#dropzone');
    const nav = $('#nav');
    const collapseSvg = $('#collapseSvg');
    const showSvg = $('#showSvg');
    $('#collapseBtn').on('click', ()=>{
        dropzone.toggleClass('hidden');
        nav.toggleClass('hidden');
        collapseSvg.toggleClass('hidden');
        showSvg.toggleClass('hidden')
    })
});