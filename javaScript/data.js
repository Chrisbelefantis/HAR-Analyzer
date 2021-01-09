
   //password vars
   const passwordRegEx= /(?=.*[a-z])(?=.*[A-Z])(?=.*[\d])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
   var validPassword = false;

       document.getElementById('mail-newpwd').addEventListener("change",event=>{
       password1 = event.target.value;
       validPassword= passwordRegEx.test(password1);

       if (validPassword){
           document.getElementById('mail-newpwd').classList.remove("is-invalid");
           document.getElementById('mail-newpwd').classList.add("is-valid");
       }else{
           document.getElementById('mail-newpwd').classList.remove("is-valid");
           document.getElementById('mail-newpwd').classList.add("is-invalid");
       }
   });


   //passwords match validation
    document.getElementById('mail-rptpwd').addEventListener("change",event=>{
        password2 = event.target.value;
        if (password1 === password2 && validPassword){
            document.getElementById('mail-rptpwd').classList.remove("is-invalid");
            document.getElementById('mail-rptpwd').classList.add("is-valid");
        }else if(password1 != password2 && validPassword){
            document.getElementById('mail-rptpwd').classList.remove("is-valid");
            document.getElementById('mail-rptpwd').classList.add("is-invalid");
        }else{
            document.getElementById('mail-rptpwd').classList.remove("is-valid");
            document.getElementById('mail-rptpwd').classList.remove("is-invalid");
        }


    });

    $("#mail-submit").click(function() {

        var currentPwd = $('#mail-crnpwd').val();
        var newPwd = $('#mail-newpwd').val();
        var confirmPwd = $('#mail-rptpwd').val();
        var username = $('#myInput').val(); 

        if (currentPwd === "" || newPwd === "" || confirmPwd === "") {

            $("#form-message").text("Fill in all fields !");

        } else {

            $.post("../includes/password_check.php", 
            {
             currentPwd:currentPwd,
             newPwd:newPwd,
             confirmPwd:confirmPwd,
             username:username
            },           
            function( data ){

                data = JSON.parse(data);
                if(data.isValid) {
                    
                    if (newPwd == confirmPwd && ($('#mail-newpwd').hasClass('is-valid'))) {
                        $.post("../includes/insertPassword_script.php", 
                        {
                            newPwd:newPwd,
                            username:username
                        },
                        function(data){
                            $("#Success-message").text(data);
                            document.getElementById('mail-crnpwd').value = "";
                            document.getElementById('mail-newpwd').value = "";
                            document.getElementById('mail-rptpwd').value = "";
                            document.getElementById('mail-newpwd').classList.remove("is-valid");
                            document.getElementById('mail-rptpwd').classList.remove("is-valid");
                        });

                    } else {
                        $("#form-message").text("Please check all the fields and try again!");
                    }
                }
                else {

                    $('#mail-crnpwd').addClass('is-invalid');
                    $("#form-message").text("Please check all the fields and try again!");
                }

            });

        }

    });

