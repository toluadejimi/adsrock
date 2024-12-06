window.onload = async function () {
    const advertises = document.getElementsByClassName("MainAdverTiseMentDiv");
    const scripTags  = document.getElementsByClassName("adScriptClass");
    const scripturl  = scripTags[0].getAttribute('src');
    const siteurl    = scripturl.replace("/assets/ads/ad.js", "");
    const currentUrl = window.location.hostname;

    for (let ad of advertises) {
        ad.style.position = "relative";
        ad.style.zIndex = "0";
        ad.style.display = "inline-block";

        const getAdSize = ad.getAttribute('data-adsize');
        const getPublisher = ad.getAttribute('data-publisher');
        const AdUrl = `${siteurl}/ads/${getPublisher}/${getAdSize}/${currentUrl}`;

        try {
            const response = await fetch(AdUrl);
            if (response.ok) {
                const adContent = await response.text();
                ad.innerHTML = adContent;
            } else {
                console.error(`Failed to load ad: ${response.statusText}`);
            }
        } catch (error) {
            console.error('Error fetching ad:', error);
        }
    }
}

function hideAdverTiseMent(elem) {
    elem.parentElement.style.display = "none";
}

console.log("yes");
