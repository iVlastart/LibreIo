import $ from 'jquery';

//script to handle the left side of the video editor 
$(()=>{
    const dropzone = $('#dropzone');

    dropzone.on('change', function(e){
        getHead();
        const form = $(e.target).closest('form')[0];
        const data = new FormData(form);

        $.ajax({
            type: 'POST',
            url: '/editor/upload',
            data: data,
            processData: false,
            contentType: false,
            success: (resp)=>{
                console.log(resp);
            },
            error: (xhr, status)=>{
                console.log(xhr.responseText);
            }
        })
    });

});

function getHead()
{
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}