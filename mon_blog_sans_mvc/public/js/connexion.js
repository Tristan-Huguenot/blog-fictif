var iconeoeil = document.getElementById('oeilmdp')
var inputmdp = document.getElementById('mdp')

iconeoeil.addEventListener('click', function(e){

    if(inputmdp.type == 'password'){
        inputmdp.type = 'text'
        e.target.src = 'public/img/icon/eye.svg'
    }else{
        inputmdp.type = 'password'
        e.target.src = 'public/img/icon/closed_eye.svg'
    }

})