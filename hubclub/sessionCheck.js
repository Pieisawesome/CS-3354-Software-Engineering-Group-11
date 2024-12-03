window.onload = function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/hubclub/sessionHandler.php', true); 
    xhr.onload = function() {
        if (xhr.status === 200) {
            if (xhr.responseText === 'false') {
                window.location.href = 'login.html';
            }
        }
    };
    xhr.send();  
}