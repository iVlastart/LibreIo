const numberSpan = document.querySelector('.number');
const number = numberSpan.textContent;

if(number<1000) numberSpan.textContent = number;
else if(number>999&&number<1000000) numberSpan.textContent = number/1000+"K";
else if(number>999999) numberSpan.textContent = number/1000000+"M";