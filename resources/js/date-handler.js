document.querySelectorAll('.date').forEach(dateDiv => {
    const vidDateStr = dateDiv.textContent.trim();
    const vidDate = new Date(vidDateStr.replace(" ", "T"));
    const now = new Date();

    const diffMs = now - vidDate;
    const diffMins = Math.floor(diffMs / (1000 * 60));
    const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
    const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
    const diffMonths = Math.floor(diffDays / 30);
    const diffYears = Math.floor(diffDays / 365);

    let label = "";
    if (diffMins < 1) label = "just now";
    else if (diffMins < 60) label = `${diffMins} mins ago`;
    else if (diffHours < 24) label = `${diffHours} hours ago`;
    else if (diffDays < 30) label = `${diffDays} days ago`;
    else if (diffMonths < 12) label = `${diffMonths} months ago`;
    else label = `${diffYears} years ago`;

    dateDiv.innerText = label;
});