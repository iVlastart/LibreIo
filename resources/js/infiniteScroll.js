import $ from 'jquery';
import { formatDates } from './date-handler';

$(()=>{
    let page = 1;
    let morePosts = true;

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
            page++;
            morePosts 
                ? loadMoreData(page)
                : $('#loading').text('No more posts to load');
        }
    });

    function loadMoreData(page) 
    {
        $.ajax({
            url: '?page='+page,
            method: 'GET',
            beforeSend: function() {
                $('#loading').show();
            },
            success: function(data) {
                if (data.trim() === "") 
                {
                    morePosts = false;
                    return;
                }
                $('#loading').hide();
                $('#posts-list').append(data);

                formatDates();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
});