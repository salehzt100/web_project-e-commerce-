function firstfocus(){
    let user_name=document.getElementById(`user-name`).focus();
    return true;
}
// Email validation
document.getElementById("user-email").addEventListener("keyup", function() {
    var email = this.value;
    var error = document.getElementById('error');
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        error.innerHTML = 'Please enter a valid email address';
        error.style.fontSize='10px';
        this.style.borderColor=`red`;

    } else {
        error.innerHTML = '';
        this.style.borderColor=`green`;
    }


});


// Password validation
document.getElementById("user-password").addEventListener("keyup", function() {
    var password = this.value;
    var errorpass = document.getElementById('errorpass');
    var passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%&*])[0-9a-zA-Z!@#$%&*]{8,}$/;
    if (!passwordPattern.test(password)) {
        errorpass.innerHTML = 'Password must contain at least one uppercase letter, one lowercase letter,one special character and be at least 8 characters long';
        errorpass.style.fontSize='10px';
        errorpass.style.width = this.offsetWidth +5+ 'px';
        this.style.borderColor=`red`;

    } else {
        errorpass.innerHTML = '';
        this.style.borderColor=`green`;
    }
});




