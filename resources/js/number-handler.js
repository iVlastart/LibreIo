document.querySelectorAll('.number').forEach(numberSpan=>{
    const number = parseInt(numberSpan.textContent, 10);
    let formatted;

    if (number < 1000) formatted = number;
    else if (number < 1000000) formatted = (number / 1000).toFixed(1).replace(/\.0$/, '') + "K";
    else formatted = (number / 1000000).toFixed(1).replace(/\.0$/, '') + "M";

    numberSpan.textContent = formatted;
});