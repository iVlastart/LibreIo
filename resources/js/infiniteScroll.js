import $ from 'jquery';
let page = 1;
let morePosts = true;
let isLoading = false;

$('#Title').on('click',()=>location.reload())
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
    if(isLoading) return;
    isLoading = true;
    $('#loading').show();
    $.ajax({
        type: 'GET',
        url: '/home?page='+page,
        success: function(data){
            if(data.trim().length == 0)
            {
                $('#loading').html("No more posts");
                morePosts = false;
                return;
            }
            $('#loading').hide();
            $("#posts-container").append(data);
        },
        complete: function(){
            isLoading = false;
        },
        error: function(xhr, status, error) {
            console.error("AJAX error:", xhr.responseText);
        }
    });
}