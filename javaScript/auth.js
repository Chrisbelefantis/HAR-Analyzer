var registerButton= document.getElementById("register");


registerButton.addEventListener("click", registrationAttempt);

function registrationAttempt(){
    
    //email vars
    const emailRegEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var email=document.getElementById("inputEmail").value;

    //username vars
    var username = document.getElementById("inputUsername").value;
    var usernameAvailable=true //here query in database search for username
    var emailAvailable=true;
    //password vars
    const passwordRegEx= /(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    var password1= document.getElementById("inputPassword1").value;
    var password2= document.getElementById("inputPassword2").value;
    var validPassword= passwordRegEx.test(password1);

    
    //email validation 
    if (!emailRegEx.test(email)){
        document.getElementById("inputEmail").classList.remove("is-valid");
        document.getElementById("inputEmail").classList.add("is-invalid");
        document.getElementById("email-invalid-feedback").innerHTML="Please use a valid email!";
    }else if(emailRegEx.test(email) && !emailAvailable){
        document.getElementById("inputEmail").classList.remove("is-valid");
        document.getElementById("inputEmail").classList.add("is-invalid");
        document.getElementById("email-invalid-feedback").innerHTML="Email already in use!";
    }else{
        document.getElementById("inputEmail").classList.remove("is-invalid");
        document.getElementById("inputEmail").classList.add("is-valid");
    }

    //username check 
    if(username==="" || username==null){
        document.getElementById("inputUsername").classList.remove("is-valid");
        document.getElementById("inputUsername").classList.add("is-invalid");
        document.getElementById("username-invalid-feedback").innerHTML="Please choose a username!";
    }else if(!usernameAvailable){
        document.getElementById("inputUsername").classList.remove("is-valid");
        document.getElementById("inputUsername").classList.add("is-invalid");
        document.getElementById("username-invalid-feedback").innerHTML="This username is already taken!";
    }else{
        document.getElementById("inputUsername").classList.remove("is-invalid");
        document.getElementById("inputUsername").classList.add("is-valid");
    }

    //password format validation
    if (validPassword){
        document.getElementById("inputPassword1").classList.remove("is-invalid");
        document.getElementById("inputPassword1").classList.add("is-valid");
    }else{
        document.getElementById("inputPassword1").classList.remove("is-valid");
        document.getElementById("inputPassword1").classList.add("is-invalid");
    }

    //passwords match validation
    if (password1 === password2 && validPassword){
        document.getElementById("inputPassword2").classList.remove("is-invalid");
        document.getElementById("inputPassword2").classList.add("is-valid");
    }else if(password1 != password2 && validPassword){
        document.getElementById("inputPassword2").classList.remove("is-valid");
        document.getElementById("inputPassword2").classList.add("is-invalid");
    }else{
        document.getElementById("inputPassword2").classList.remove("is-valid");
        document.getElementById("inputPassword2").classList.remove("is-invalid");
    }

    //check if all fields validated
    var fields = document.getElementsByClassName("input");
    var validatedData= true;

    for(var i=0 ; i<fields.length ; i++){
        if (!(fields[i].classList.contains("is-valid"))){
            validatedData=false;
            break;
        }
    }

    if(validatedData){
        document.querySelector('.register-button').click();
    }else{
        document.getElementById("errorMessage").setAttribute("class", "alert alert-danger")
        document.getElementById("errorMessage").setAttribute("role", "alert")
        document.getElementById("errorMessage").innerHTML="Please check all the fields and try again!";
    }

}

