//password vars
const passwordRegEx= /(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
var validPassword = false;

//password format validation
document.getElementById("curpwd").addEventListener("change",event=>{
    password1 = event.target.value;
    validPassword= passwordRegEx.test(password1);

    if (validPassword){
        document.getElementById("curpwd").classList.remove("is-invalid");
        document.getElementById("curpwd").classList.add("is-valid");
    }else{
        document.getElementById("curpwd").classList.remove("is-valid");
        document.getElementById("curpwd").classList.add("is-invalid");
    }

});
  
 //passwords match validation
document.getElementById("cnfpwd").addEventListener("change",event=>{
    password2 = event.target.value;
    if (password1 === password2 && validPassword){
        document.getElementById("cnfpwd").classList.remove("is-invalid");
        document.getElementById("cnfpwd").classList.add("is-valid");
    }else if(password1 != password2 && validPassword){
        document.getElementById("cnfpwd").classList.remove("is-valid");
        document.getElementById("cnfpwd").classList.add("is-invalid");
    }else{
        document.getElementById("cnfpwd").classList.remove("is-valid");
        document.getElementById("cnfpwd").classList.remove("is-invalid");
    }

});
