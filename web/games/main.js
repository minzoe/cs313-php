
var signupButton = document.getElementById('showsignUpUser');
signupButton.onclick = function() {
    document.getElementById('signUpUser').classList.remove('hide');
    document.getElementById('showLoginUser').classList.remove('hide');
    document.getElementById('loginUser').classList.add('hide');
    document.getElementById('showsignUpUser').classList.add('hide');
};

