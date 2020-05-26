$(document).ready(function () {
    $("#post").click(function () {
        if (! checkFields()) return;
        $("#print-here").load("add-new.php", {
            "user" : document.getElementById("user-name").innerText,
            "title" : document.getElementById("title").value,
            "category" : document.getElementById("category").value,
            "text" : document.getElementById("text").value
        }, function (d, s) {
            alert(s + "\n" + d);
        });
        alert("Posting you article...");
    });
});

function checkFields() {
    let user = document.getElementById("user-name").innerText;
    let title = document.getElementById("title").value;
    let category = document.getElementById("category").value;
    let text = document.getElementById("text").value;
    if(user == null || title == null || category == null || text == null
            || user.length === 0 || title.length === 0
            || category.length === 0 || text.length === 0) {
        alert("Please make sure you're signed in and you've written your article before posting");
        return false;
    }
    if(title.length > 128) {
        alert("Title can not be longer than 128 characters"); return false;
    }
    if (category.length > 16) {
        alert("Category can not be longer than 16 characters"); return false;
    }
    if(text.length > 2048) {
        alert("Text can not be longer than 2048 characters"); return false;
    }
    return true;
}