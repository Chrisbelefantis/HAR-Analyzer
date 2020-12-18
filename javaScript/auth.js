
//email vars
const emailRegEx = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
var emailAvailable=true;

//username vars
var usernameAvailable=true //here query in database search for username

//password vars
const passwordRegEx= /(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
var validPassword = false;


//email validation 
document.getElementById("inputEmail").addEventListener("change",event=>{

    
    email = event.target.value;
    $.post("includes/email_check.php", { email:email}, function(data){
        emailAvailable=(data=="true");
    
        if (!emailRegEx.test(email)){
            document.getElementById("inputEmail").classList.remove("is-valid");
            document.getElementById("inputEmail").classList.add("is-invalid");
            document.getElementById("email-invalid-feedback").innerHTML="Please use a valid email";
        }else if(emailRegEx.test(email) && !emailAvailable){
    
            document.getElementById("inputEmail").classList.remove("is-valid");
            document.getElementById("inputEmail").classList.add("is-invalid");
            document.getElementById("email-invalid-feedback").innerHTML="Email already in use";
        }else{
            document.getElementById("inputEmail").classList.remove("is-invalid");
            document.getElementById("inputEmail").classList.add("is-valid");
        }

    });

});

document.getElementById("inputUsername").addEventListener("change",event=>{

    username = event.target.value; 
    $.post("includes/username_check.php", { username:username}, function(data){
        usernameAvailable=(data=="true");
        if(username==="" || username==null){
            document.getElementById("inputUsername").classList.remove("is-valid");
            document.getElementById("inputUsername").classList.add("is-invalid");
            document.getElementById("username-invalid-feedback").innerHTML="Please choose a username";
        }else if(!usernameAvailable){
            document.getElementById("inputUsername").classList.remove("is-valid");
            document.getElementById("inputUsername").classList.add("is-invalid");
            document.getElementById("username-invalid-feedback").innerHTML="This username is already taken";
        }else{
            document.getElementById("inputUsername").classList.remove("is-invalid");
            document.getElementById("inputUsername").classList.add("is-valid");
        }


    });
});

//password format validation
document.getElementById("inputPassword1").addEventListener("change",event=>{
    password1 = event.target.value;
    validPassword= passwordRegEx.test(password1);

    if (validPassword){
        document.getElementById("inputPassword1").classList.remove("is-invalid");
        document.getElementById("inputPassword1").classList.add("is-valid");
    }else{
        document.getElementById("inputPassword1").classList.remove("is-valid");
        document.getElementById("inputPassword1").classList.add("is-invalid");
    }

});
  
 //passwords match validation
document.getElementById("inputPassword2").addEventListener("change",event=>{
    password2 = event.target.value;
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

});

//Register Button action
document.getElementById("register").addEventListener("click",()=>{

   //check if all fields validated
    var fields = document.getElementsByClassName("input");
    var validatedData= true;

    for(var i=0 ; i<fields.length ; i++){
        if (!(fields[i].classList.contains("is-valid"))){
            fields[i].classList.add("is-invalid");
            validatedData=false;
        }
    }

    if(validatedData){
        document.querySelector('.register-button').click();
    }else{
        document.getElementById("errorMessage").setAttribute("class", "alert alert-danger")
        document.getElementById("errorMessage").setAttribute("role", "alert")
        document.getElementById("errorMessage").innerHTML="Please check all the fields and try again";
    }


});




