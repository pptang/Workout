$(document).ready(function(){
            $("#btnSubmit").click(function(){
                var data = $("#loginform").serializeArray();
                $.ajax({
                    type: "POST",
                    url: 'auth.php',
                    data: data,
                    dataType: "text",
                    success: function(text){
                      if(text == "success"){
                          window.location = "main.php";
                      }else{
                          alert(text);
                          clearInputs();               
                      }
                    }

                });
            });

            function clearInputs(){
                $("#mail").val("");
                $("#pwd").val("");
            }
            $("#loginform").submit(function(){
                return false;
            });
            $("#btnRegister").click(function(){
                var data = $("#newUser").serializeArray();
                $.post("insertDB.php" , data , function(json){

                        window.location = "main.php";

                } , "json");
            });
            $("#newUser").submit(function(){
                return false;
            });
});