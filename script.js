var registerButton= document.getElementById("registerButton");


registerButton.addEventListener("click", registrationAttempt)

function registrationAttempt(){
    //email vars
    const emailRegEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var email=document.getElementById("inputEmail").value;

    //username vars
    var username = document.getElementById("inputUsername").value;
    var usernameAvailable=true //here query in database search for username

    //password vars
    const passwordRegEx= /(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    var password1= document.getElementById("inputPassword1").value;
    var password2= document.getElementById("inputPassword2").value;
    var validPassword= passwordRegEx.test(password1);

    //email validation 
    if (emailRegEx.test(email)){
        document.getElementById("emailDiv").removeAttribute("data-error");
        document.getElementById("emailDiv").setAttribute("validated","null");
    }else{
        document.getElementById("emailDiv").removeAttribute("validated");
        document.getElementById("emailDiv").setAttribute("data-error", "Please use a valid email address!");
    }

    //username check 
    if(username==="" || username==null){
        document.getElementById("usernameDiv").removeAttribute("validated");
        document.getElementById("usernameDiv").setAttribute("data-error", "Please choose a username");
    }else if(usernameAvailable){
        document.getElementById("usernameDiv").removeAttribute("data-error");
        document.getElementById("usernameDiv").setAttribute("validated","null");
    }else{
        document.getElementById("emailDiv").removeAttribute("validated");
        document.getElementById("emailDiv").setAttribute("data-error", "This username is already taken");
    }

    //password format validation
    if (validPassword){
        document.getElementById("password1div").removeAttribute("data-error");
        document.getElementById("password1div").setAttribute("validated","null");
    }else{
        document.getElementById("password1div").removeAttribute("validated");
        document.getElementById("password1div").setAttribute("data-error", "Check the password format!");
    }

    //passwords match validation
    if (password1 === password2 && validPassword){
        document.getElementById("password2div").removeAttribute("data-error");
        document.getElementById("password2div").setAttribute("validated","null");
    }else if(password1 != password2 && validPassword){
        document.getElementById("password2div").removeAttribute("validated");
        document.getElementById("password2div").setAttribute("data-error", "Passwords in both fields must be the same!");
    }else{
        document.getElementById("password2div").removeAttribute("data-error");
        document.getElementById("password2div").removeAttribute("validated");
    }

    //check if all fields validated
    var fields = document.getElementsByClassName("input-container");
    var validatedData= true;

    for(var i=0 ; i<fields.length ; i++){
        if (!(fields[i].hasAttribute("validated"))){
            validatedData=false;
            break;
        }
    }

    if(validatedData){
        newRegistration(email, username, password1)
    }else{
        document.getElementById("errorMessage").setAttribute("class", "alert alert-danger")
        document.getElementById("errorMessage").setAttribute("role", "alert")
        document.getElementById("errorMessage").innerHTML="Please check all the fields and try again!";
    }

}

function newRegistration(email, username, password){
    alert("Successfull");
}