function togglePass(){
    var pass = document.getElementById('userPass');
    var visibleimg = document.getElementById('visibileimg');
    if(pass.type === 'password'){
        visibleimg.src = 'images/visibility_off.png';
        pass.type = 'text';
    }else{
        visibleimg.src = 'images/visibility_on.png';
        pass.type = 'password';
    }
}
function conTogglePass(){
    var pass = document.getElementById('conUserPass');
    var visibleimg = document.getElementById('conVisibileimg');
    if(pass.type === 'password'){
        visibleimg.src = 'images/visibility_off.png';
        pass.type = 'text';
    }else{
        visibleimg.src = 'images/visibility_on.png';
        pass.type = 'password';
    }
}
