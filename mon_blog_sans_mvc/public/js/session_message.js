var sessionMessage = document.getElementById('session_message');
var croixSessionMessage = document.getElementById('croix_session_message');

croixSessionMessage.addEventListener('click', function(){
    sessionMessage.remove()
})