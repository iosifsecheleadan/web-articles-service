function signIn() {
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    if (! check(username, password)) return;

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = checkServerResponse;
    xhttp.open("GET", "sign-in.php?username="
        + username + "&password=" + password, true);
    xhttp.send();
}

function signUP() {
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let confirm = document.getElementById("confirm").value;
    if (! check(username, password)
            || ! checkEqual(password, confirm)) return;

    let xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = checkServerResponse;
    xhttp.open("GET", "sign-up.php?username="
        + username + "&password=" + password, true);
    xhttp.send();
}

function checkServerResponse() {
    if(this.readyState === 4 && this.status === 200) {
        if(this.responseText == null
                || this.responseText === 0
                || this.responseText.substr(0, 5) !== "user=") {
            alert("Invalid username or password");
        } else {
            document.cookie = this.responseText + "; path=/";
            document.location.replace("../main/main.html");
        }
    }
}

function check(username, password) {
    if(password == null || username == null
        || password.length === 0 || username.length === 0) {
        alert("Please input your username and password"); return false;
    } if(username.length > 32 || password.length > 32) {
        alert("Username and password can not be longer than 32 characters"); return false;
    }
    return true;
}

function checkEqual(password, confirm) {
    if(confirm !== password) {
        alert("Passwords must match"); return false;
    }
    return true;
}