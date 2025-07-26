const dateDiv = document.querySelector('.date');
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
const [vidYear, vidMonth, vidDay] = datePart.split("-");
const [vidHours, vidMinutes] = timePart.split(':');

if(vidYear===year&&month===vidMonth&&day===vidDay)
{

}