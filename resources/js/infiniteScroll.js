import $ from 'jquery';
let page = 1;

$('#Title').click(()=>{
    location.reload()
})
$(window).scroll(function()
{
    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) 
    {
        page++;
        if(morePosts) loadMoreData(page);
        else $('#loading').hide();
    }
});

function loadMoreData(page)
{
    $('#loading').show();
    $.ajax({
        type: 'GET',
        url: '?page='+page,
        success: function(data){
            if(data.trim().length == 0)
            {
                $('#loading').html("No more posts");
                morePosts = false;
                return;
            }
            $('#loading').hide();
            $("#post-data").append(data);
        },
    });
}