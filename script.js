function clearSessionMessage() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'clear_session_message.php', true);
    xhr.send()
}

function clearSessionError() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'clear_session_error.php', true);
    xhr.send()
}
