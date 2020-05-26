// HIDE OR SHOW BUTTONS
$(document).ready(function () {
    let username;
    try {
        username = document.cookie.split("user=")[1];
        if(username.substr(0, 1) === ";") username = null;
        else username = username.split(";")[0];
    }
    catch (ignored) { signedOUT(); return; }
    if(username == null) { signedOUT(); return; }

    signedIN(username);
});

function signedIN(username) {
    $("#user-name").text(username);
    $("#user-name").show();

    $("#sign-in").hide();
    $("#sign-up").hide();
    $("#sign-out").show();

    $("#post-new").show();
}

function signedOUT() {
    $("#user-name").text("");
    $("#user-name").hide();

    $("#sign-in").show();
    $("#sign-up").show();
    $("#sign-out").hide();

    $("#post-new").hide();
}

function signOUT() {
    document.cookie = "user=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.location.replace("../main/main.html");
    signedOUT();
}
