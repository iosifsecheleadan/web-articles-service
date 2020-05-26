$(document).ready(function () {
    let id = document.URL.split("article=")[1];
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200) {
            document.getElementById("article")
                .innerHTML += this.responseText;
            // weirdly doesn't work with just =, must be +=
        }
    };
    xhttp.open("GET", "get-article.php?article=" + id, true);
    xhttp.send();
});

