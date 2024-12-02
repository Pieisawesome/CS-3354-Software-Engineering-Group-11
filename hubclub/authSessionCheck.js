window.onload = function() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'sessionHandler.php', true); 
    xhr.onload = function() {
        if (xhr.status === 200) {
            if (xhr.responseText === 'true') {
                window.location.href = 'index.html';
            }
        }
    };
    xhr.send();  
}