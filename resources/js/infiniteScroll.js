import $ from 'jquery';
let page = 1;

$(window).scroll(function()
{
    if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) 
    {
        page++;
        loadMoreData(page);
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
                return;
            }
            $('#loading').hide();
            $("#post-data").append(data);
        },
    });
}