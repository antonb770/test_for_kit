function ajax(geturl){
    const drequest = new XMLHttpRequest();
    const url = geturl;
    let desc = "";
    drequest.open('GET', url, false);
    drequest.setRequestHeader('Content-Type', 'application/x-www-form-url');
    drequest.addEventListener("readystatechange", () => {
            if (drequest.readyState === 4 && drequest.status === 200) {
                if (drequest.responseText.length > 0) {
                    desc = drequest.responseText;
                }
                document.getElementById('description').innerHTML = desc;
            }
    });
    drequest.send();
}