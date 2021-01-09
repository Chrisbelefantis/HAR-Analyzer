
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

        if (currentPwd === "" || newPwd === "" || confirmPwd === "" || currentPwd == null || newPwd==null || confirmPwd==null) {
            
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


    $("#username-submit").click(function() {

        var currentusername = $('#mail-crnusername').val();
        var newusername = $('#mail-newusername').val();
        var userName = $('#usernamemyInput').val();

        if (currentusername === "" || newusername === "") {

            $("#form-usernameMessage").text("Fill in all fields !");

        }else {

            $.post("../includes/username_check.php",   
            {
                username : currentusername
            },
            function(data){

                usernameTrue=(data=="false");

                if (usernameTrue == true && currentusername == userName){

                    $.post("../includes/insertUsername_script.php",
                    {
                        newusername : newusername,
                        currentusername : currentusername
                    },
                    function(data) {
                        $("#Success-usernameMessage").text(data);
                        document.getElementById('mail-crnusername').value = "";
                        document.getElementById('mail-newusername').value = "";
                    });

                } else {

                    $('#mail-crnusername').addClass('is-invalid');
                    $("#form-usernameMessage").text("Please check all the fields and try again!");

                }
            });

        }

    });


