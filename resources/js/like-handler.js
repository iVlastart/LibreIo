import $ from 'jquery';

$(() => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.like-form').on('submit', function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        const data = $(e.target).closest('form').serialize();
        $.ajax({
            type: 'POST',
            url: '/like',
            data: data,
            success: ()=>{
                const el = document.querySelector('.like-count');
                let count = parseInt(el.textContent, 10) || 0;
                el.classList.contains("liked") ? count-- : count++;
                el.classList.toggle('liked');
                const svg = $(this).find('svg path');
                svg.attr('fill', svg.attr('fill') === 'currentColor' ? 'white' : 'currentColor');
                el.textContent = count;
            }
        });
    });
    $('.dislike-form').on('submit', function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        const data = $(e.target).closest('form').serialize();
        $.ajax({
            type: 'POST',
            url: '/like',
            data: data,
            success: ()=>{
                const svg = $(this).find('svg path');
                svg.attr('fill', svg.attr('fill') === 'currentColor' ? 'white' : 'currentColor');
            }
        });
    });
});