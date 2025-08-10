document.querySelectorAll('.date').forEach(dateDiv=>{
    const vidDate = dateDiv.textContent.trim();
    console.log(vidDate);

    //get current dates
    const date = new Date();
    const year = date.getFullYear();
    const month = date.getMonth()+1;
    const day = date.getDate();
    const hours = date.getHours();
    const minutes = date.getMinutes();

    const [datePart, timePart] = vidDate.split(" ");
    const [vidYear, vidMonth, vidDay] = datePart.split("-").map(num => parseInt(num, 10));
    const [vidHours, vidMinutes] = timePart.split(":").map(num => parseInt(num, 10));

    if(vidYear===year&&month===vidMonth&&day===vidDay&&hours===vidHours)
    {
        dateDiv.innerText = minutes-vidMinutes+" mins ago";
    }

    else if(vidYear===year&&month===vidMonth&&day===vidDay)
    {
        dateDiv.innerText = hours-vidHours+" hours ago";
    }

    else if(vidYear===year&&month===vidMonth)
    {
        dateDiv.innerText = day-vidDay+" days ago";
    }

    else if(vidYear===year)
    {
        dateDiv.innerText = month-vidMonth+" months ago";
    }

    else
    {
        dateDiv.innerText = year-vidYear+" years ago";
    }
});