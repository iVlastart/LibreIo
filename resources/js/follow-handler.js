import $ from 'jquery';

$(()=>{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.follow-form').on('submit', function(e){
        e.preventDefault();
        e.stopImmediatePropagation();

        const data = $(e.target).closest('form').serialize();
        $.ajax({
            type: 'POST',
            url: '/follow',
            data: data,
            contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
            success: ()=>{
                location.reload();
            },
            error: (xhr, status, err)=>{
                console.log('AJAX error: '+xhr.responseText);
            }
        });
    });
});