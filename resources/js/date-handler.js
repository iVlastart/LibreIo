export function formatDates(container = document) {
    container.querySelectorAll('.date').forEach(dateDiv => {
        const vidDateStr = dateDiv.textContent.trim();
        const isoStr = vidDateStr.replace(" ", "T") + "Z";
        const vidDate = new Date(isoStr);
        if (isNaN(vidDate)) return;

        const now = new Date();
        const diffMs = now - vidDate;
        const diffMins = Math.floor(diffMs / (1000 * 60));
        const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
        const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
        const diffMonths = Math.floor(diffDays / 30);
        const diffYears = Math.floor(diffDays / 365);

        let label = "";
        if (diffMins < 1) label = "just now";
        else if (diffMins < 60) label = `${diffMins} ${diffMins===1?'min':'mins'} ago`;
        else if (diffHours < 24) label = `${diffHours} ${diffHours===1?'hour':'hours'} ago`;
        else if (diffDays < 30) label = `${diffDays} ${diffDays===1?'day':'days'} ago`;
        else if (diffMonths < 12) label = `${diffMonths} ${diffMonths===1?'month':'months'} ago`;
        else label = `${diffYears} ${diffYears===1?'year':'years'} ago`;

        dateDiv.innerText = label;
    });
}

formatDates();