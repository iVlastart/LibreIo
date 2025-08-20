const searchbtn = document.getElementById('search-btn');
const searchbar = document.getElementById('search-bar');

searchbtn.addEventListener('click', ()=>{
    if(searchbar.value!=='')
        location.assign('/search/'+encodeURIComponent(searchbar.value));
});