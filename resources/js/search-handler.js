const searchbtn = document.getElementById('search-btn');
const searchbar = document.getElementById('search-bar');

searchbar.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') redirect();
});
        
searchbtn.addEventListener('click', ()=>{
    redirect();
});

function redirect()
{
    if(searchbar.value!=='')
        location.assign('/search/'+encodeURIComponent(searchbar.value));
}