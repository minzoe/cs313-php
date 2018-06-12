function showSignup() {
    document.getElementById('signUpUser').classList.remove('hide');
    document.getElementById('showLoginUser').classList.remove('hide');
    document.getElementById('loginUser').classList.add('hide');
    document.getElementById('showsignUpUser').classList.add('hide');
};

function showLogin() {
    document.getElementById('signUpUser').classList.add('hide');
    document.getElementById('showLoginUser').classList.add('hide');
    document.getElementById('loginUser').classList.remove('hide');
    document.getElementById('showsignUpUser').classList.remove('hide');
};