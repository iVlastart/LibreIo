import $ from 'jquery';

$(()=>{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.delete-form').on('submit', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        const data = $(e.target).closest('form').serialize();
        $.ajax({
            type: 'POST',
            url: '/delete-post',
            data: data,
            success: (resp)=>location.assign('/home')
        });
    });
});