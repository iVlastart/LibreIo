import $ from 'jquery';

$(()=>{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.pfp-form input[type="file"]').on('change', function(e){
        e.preventDefault();
        e.stopImmediatePropagation();

        const form = $(this).closest('form')[0];
        const formData = new FormData(form);

        $.ajax({
            method: 'POST',
            url: '/upload-pfp',
            data: formData,
            processData: false,
            contentType: false,
            success: ()=>location.reload(),
        });
    });
});