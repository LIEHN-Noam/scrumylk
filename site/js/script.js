function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + value + expires + "; path=/";
}

function acceptCookies() {
    setCookie("cookie_consent", "accepted", 365); 
    document.getElementById("cookie-banner").style.display = "none";
}

function checkCookies() {
    if (document.cookie.indexOf("cookie_consent=accepted") === -1) {
        document.getElementById("cookie-banner").style.display = "block";
    }
}

window.onload = checkCookies;