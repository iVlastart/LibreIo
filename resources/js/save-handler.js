$(() => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.saveForm').on('submit', function(e) {
        e.preventDefault();
        e.stopImmediatePropagation();

        const form = $(this);
        const data = form.serialize();

        $.ajax({
            type: 'POST',
            url: '/save',
            data: data,
            success: function() {
                const svg = form.find('svg path');
                svg.attr('fill', svg.attr('fill') === 'currentColor' ? 'white' : 'currentColor');
            }
        });
    });
});