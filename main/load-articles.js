
// LOAD ARTICLES
$(document).ready(function () {
    getArticles("");
});

function searchArticles() {
    let startDate = document.getElementById("start-date").value;
    let endDate = document.getElementById("end-date").value;
    let select = document.getElementById("category");
    let category = select.options[select.selectedIndex].value;

    let first = true;
    let arguments = "";
    if(startDate !== "YYYY-MM-DD" && startDate != null && startDate !== "") {
        if(first) { arguments += "?"; first = false;
        } else arguments += "&"
        arguments += "start=" + startDate;
    }
    if(endDate !== "YYYY-MM-DD" && endDate != null && endDate !== "") {
        if(first) { arguments += "?"; first = false;
        } else arguments += "&"
        arguments += "end=" + endDate;
    }
    if(category !== "all" && category != null && category !== "") {
        if(first) { arguments += "?"; first = false;
        } else arguments += "&";
        arguments += "category=" + category
    }

    getArticles(arguments);
}

function getArticles(arguments) {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            document.getElementById("body")
                .innerHTML = this.responseText;
        }
    }
    xhttp.open("GET", "get-articles.php" + arguments, true);
    xhttp.send();
}

// LOAD CATEGORIES
$(document).ready(function () {
    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if(this.readyState === 4 && this.status === 200) {
            document.getElementById("category")
                .innerHTML += this.responseText;
        }
    }
    xhttp.open("GET", "get-categories.php", true);
    xhttp.send();
})
