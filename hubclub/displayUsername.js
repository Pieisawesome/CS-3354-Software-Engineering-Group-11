function getUserName() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'fetchUsername.php', true); 
    xhr.onload = function() {
        if (xhr.status === 200) {
            document.getElementById('username').textContent = "Hello, " + xhr.responseText;
        }
    };
    xhr.send();
}
window.onload = function() {
    getUserName();
};