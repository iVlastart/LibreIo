import $ from 'jquery';
import { formatDates } from './date-handler';

$(()=>{
    let page = 1;

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
            page++;
            loadMoreData(page);
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
                if (data.trim() === "") {
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