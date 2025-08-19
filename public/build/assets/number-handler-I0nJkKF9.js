document.querySelectorAll(".number").forEach(e=>{const t=e.textContent;t<1e3?e.textContent=t:t>999&&t<1e6?e.textContent=t/1e3+"K":t>999999&&(e.textContent=t/1e6+"M")});
