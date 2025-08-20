document.addEventListener('DOMContentLoaded', ()=>{
    document.querySelectorAll('.preview-container').forEach(element=>{
        const slug = element.dataset.slug;
        if(slug)
        {
            element.addEventListener('click', ()=>{
                location.assign('/watch/'+slug);
            });
        }
    });
});