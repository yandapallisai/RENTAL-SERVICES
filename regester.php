<!DOCTYPE html>
<html>
    <head>
        <title></title>
            <link type="text/php" src="log.php"/>
            <style>
                .head{
                    display:flex;
                    flex-flow:row;
                    justify-content:space-between;
                }#h1{
                    margin-left:30px;
                }
                .lg{
                    display:flex;
                    flex-flow:row;
                    padding-left:700px;
                
                }
                #l{
                    padding-left:30px;
                }
                </style>
        <script>
           function validate() {
           
            var password = document.getElementsByName("password")[0].value;
  
  var hasnumber=/[0-9]/.test(password);
  var hasuppercase=/[A-Z]/.test(password);
  var hascharacter=/[a-z]/.test(password);
  if(password.length<8||!hasnumber||!hasuppercase||!hascharacter)
  {
    alert('enter valid password');
    
  }
  else
  {
    var re=document.getElementById('ac');
    re.action="reg.php";
  }
  
  
}
        </script>
    </head>
    <body style="background-color:skyblue">
        <div style="background-color:brown;height:100px;color:white;font-size:20px;" class="head"> 
            <div id="h1" style="">check available rooms/houses/flats where you want rental.com</div>
            <div id="h2"><img style="float:right;padding-right:30px" src="img\logo.jpg" height="50px" width="50px"></div>
        </div>
        <h1 align="center"> sign in or create account</h1>
         <form  method="POST"  align="center"  style="background-color:skyblue" id="ac">
         <table align="center">
            <tr><td>
            name</td><td><input type="text" name="name"/><br>
            </td></tr>
            <tr><td>
            email</td><td>
            <input type="email" name="email"/>
            </td> </tr><br>
            <tr><td>password</td><td><input type="password" name="password"  /></td></tr><br>
           
           <tr><td></td><td> <input type="submit" value="regester" onclick="validate()"/></td></tr><br>
         </table>
         <h3>_____or use another options to login_____</h3>
         <div class="lg"> 
            <div><a href="#"><img src="img/log1.jpg" height="50px" width="50px"> </a></div>
                <div><a href="#"><img id="l" src="img/logo2.jpg"  height="50px" width="50px"></a></div>
                <div><img src=""></div>
            </div>

                            <pre><h3 color="blue">By signing in or creating an account, 
                                you agree with our Terms & conditions and Privacy statement 
</h3>
                              All rights reserved.
 - Booking.com™
            </pre> 
         </form>
    </body>
</html>