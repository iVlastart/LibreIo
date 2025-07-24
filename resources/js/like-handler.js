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
                const likeCount = document.querySelector('.like-count');
                let count = parseInt(likeCount.textContent) || 0;
                likeCount.classList.contains("liked") ? count-- : count++;
                likeCount.classList.toggle('liked');
                const svg = $(this).find('svg path');
                svg.attr('fill', svg.attr('fill') === 'currentColor' ? 'white' : 'currentColor');
                likeCount.textContent = count;
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
                const dislikeCount = document.querySelector('.dislike-count');
                let count = parseInt(dislikeCount.textContent)||0;
                dislikeCount.classList.contains("disliked") ? count-- : count++;
                dislikeCount.classList.toggle('disliked');
                const svg = $(this).find('svg path');
                svg.attr('fill', svg.attr('fill') === 'currentColor' ? 'white' : 'currentColor');
                dislikeCount.textContent = count;
            }
        });
    });
});