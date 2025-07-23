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
                const svg = $(this).find('svg path');
                svg.attr('fill', svg.attr('fill') === 'currentColor' ? 'white' : 'currentColor');
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