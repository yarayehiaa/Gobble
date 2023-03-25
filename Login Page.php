<?php
    session_start();
    require_once "conn.php";
    $dbtable = "login";

    if(isset($_POST['login'])) {
        // username and password sent from form 
        
        $myusername = $_POST['email'];
        $mypassword =  $_POST['pass'];
        
        
        $sql = "SELECT * FROM login WHERE email = '$myusername' and password = '$mypassword'";
        
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $_SESSION['userid']=$row['userid'];
        
        $count = mysqli_num_rows($result);
        
        // If result matched $myusername and $mypassword, table row must be 1 row
          
        if($count == 1 && isset($_POST['loginCheck'])) {
           $_SESSION["loggedin"]= true;
           $_SESSION['login_user'] = $myusername;
           header("location: profile.php");
        }elseif($count == 1 && !isset($_POST['loginCheck'])){
         $_SESSION["loggedin"]= false;
         $_SESSION['login_user'] = $myusername;
         header("location: profile.php");
        }
        else {
           $error = "Your Login Name or Password is invalid".$conn->error;
        }
     
     }
     if(isset($_POST['signup'])) {
         $myemail = $_POST['email'];
         $passs  = $_POST['pass'];
         $myusername=$_POST['username'];
         $myname=$_POST['namex'];
     
     
         $sql = "SELECT * FROM login WHERE email = '$myemail' ";
        
         $result = mysqli_query($conn,$sql);
         $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
         $count = mysqli_num_rows($result);
         $error=$count;
         // If result matched $myusername and $mypassword, table row must be 1 row
           
         if($count == 1) {
         $error="email already exists";
         }else{
     
         $sql = "INSERT INTO $dbtable (email, password,username) VALUES ('$myemail', '$passs','$myusername') ";
         
         if ($conn->query($sql) === TRUE) {
             $_SESSION['login_user'] = $myusername;
             $_SESSION['email'] = $myemail;
             $_SESSION['name'] = $myname;
           
             header("location: create profile.php");
         } 
         else {
             $error = "Error: " . $sql . "<br>" . $conn->error;
         }
     }
     }

?>









<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login page</title>
    <link rel="stylesheet" href="C:\Users\En.Yara\Desktop\logincss.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body
    style="background-image: url(3575868.jpg); ">
    <div class="page d-flex" style="flex-direction:column ;">



    <div class="container" >
        <section class="vh-100 gradient-custom">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-white text-dark" style="border-radius: 1rem;">
                            <div class="card-body p-5 text-center" style="max-height: min-content;">

                                <div class="md-5 mt-md-4">
                                    <h1 style="font-family:'Bungee', 'Arial Narrow', Arial, sans-serif; color: coral;">GOBBLE</h1>
                                    <br>
                                    <?php 
                                    if(!empty($error)){
                                        echo '<div class="alert alert-danger">' . $error . '</div>'; }   ?>

                                    <ul class="nav nav-tabs nav-justified mb-3" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="pills-login-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-login" type="button" role="tab"
                                                aria-controls="pills-login" aria-selected="true" style="color: coral; font-size: 25px;">Login</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="pills-reg-tab" data-bs-toggle="pill"
                                                data-bs-target="#pills-reg" type="button" role="tab"
                                                aria-controls="pills-reg" aria-selected="false" style="color: coral; font-size: 25px;">Register</button>
                                        </li>

                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-login" role="tabpanel"
                                            aria-labelledby="pills-login-tab" tabindex="0">
                                            <form method="POST" action="" onsubmit=" return validate()" >
                                                <p> sign in with</p>
                                            <a href="https://m.facebook.com/login/?locale=en_GB" style="background-color: white;">
                                                <button type="button" class="btn btn-link btn-floating mx-1">
                                                    <i id="aa" class="fa fa-facebook fa-2x" style="color:coral;"></i>
                                                </button>
                                            </a>
                                            <a href="https://accounts.google.com/signin/v2/identifier?rart=ANgoxccWMJUYH-Qa3XU_QXDV2zFIXhG7Wy7iJAIPJ8JsqryC6xHQj-SeDlstF-bGjgZ0BZWyPE5U3qrh9MUAqzry3Wytg4n8Ig&TL=AC7eWV1RwErdv0QSiSrLRWlCDsbE04LS7GF2sDWOkK-_FggyPb2C_Xb405RZCwAC&flowName=GlifWebSignIn&cid=1&flowEntry=ServiceLogin" style="background-color: white;" >
                                                <button type="button" class="btn btn-link btn-floating mx-1">
                                                    <i class="fa fa-google fa-2x" style="color:coral;"></i>
                                                </button>
                                            </a>
                                            <a href="https://twitter.com/i/flow/login" style="background-color: white;">
                                                <button type="button" class="btn btn-link btn-floating mx-1">
                                                    <i class="fa fa-twitter fa-2x" style="color:coral;"></i>
                                                </button>
                                            </a>
                                                <p class="text-center">or:</p>


                                                <div class="form-outline mb-4">
                                                    <input type="email" id="loginName" name='email' class="form-control"
                                                        placeholder="Email" required />
                                                    <label class="form-label" for="loginName"></label>
                                                </div>


                                                <div class="form-outline mb-4">
                                                    <input type="password" id="loginPassword" name='pass' class="form-control"
                                                        placeholder="Password" required />
                                                    <label class="form-label" for="loginPassword"></label>
                                                </div>


                                                <div class="row mb-4">
                                                    <div class="col-md-6 d-flex justify-content-center">
                                                        
                                                        <div class="form-check mb-3 mb-md-0">
                                                            <input class="form-check-input" type="checkbox" value=""
                                                                id="loginCheck"  checked />
                                                            <label class="form-check-label" for="loginCheck"> Remember
                                                                me
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 d-flex justify-content-center">
                                                       
                                                        <a href="#!" style="color:coral ;">Forgot password?</a>
                                                    </div>
                                                </div>

                                                <a >
                                                    <button  style="background-color: coral;border-color: coral;" name='login' type="submit" class="btn btn-primary btn-block mb-3">Sign
                                                        in</button> 
                                                    </a>

                                                
                                                <div class="text-center">
                                                    <p>Not a member? Register above!</p>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="pills-reg" role="tabpanel"
                                            aria-labelledby="pills-reg-tab" tabindex="0">
                                            <form  method="POST" action="" onsubmit="return validate2()">
                                                <a href="https://m.facebook.com/login/?locale=en_GB" style="background-color: white;">
                                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                                        <i id="aa" class="fa fa-facebook fa-2x" style="color:coral;"></i>
                                                    </button>
                                                </a>
                                                <a href="https://accounts.google.com/signin/v2/identifier?rart=ANgoxccWMJUYH-Qa3XU_QXDV2zFIXhG7Wy7iJAIPJ8JsqryC6xHQj-SeDlstF-bGjgZ0BZWyPE5U3qrh9MUAqzry3Wytg4n8Ig&TL=AC7eWV1RwErdv0QSiSrLRWlCDsbE04LS7GF2sDWOkK-_FggyPb2C_Xb405RZCwAC&flowName=GlifWebSignIn&cid=1&flowEntry=ServiceLogin" style="background-color: white;" >
                                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                                        <i class="fa fa-google fa-2x" style="color:coral;"></i>
                                                    </button>
                                                </a>
                                                <a href="https://twitter.com/i/flow/login" style="background-color: white;">
                                                    <button type="button" class="btn btn-link btn-floating mx-1">
                                                        <i class="fa fa-twitter fa-2x" style="color:coral;"></i>
                                                    </button>
                                                </a>


                                                <p class="text-center">or:</p>


                                                <div class="form-outline mb-4">
                                                    <input type="text" id="registerName" class="form-control" name='namex' placeholder="Name" required />
                                                    <label class="form-label" for="registerName"></label>
                                                </div>


                                                <div class="form-outline mb-4">
                                                    <input type="text" id="registerUsername" class="form-control" name='username' placeholder="Username" required/>
                                                    <label class="form-label" for="registerUsername"></label>
                                                </div>


                                                <div class="form-outline mb-4">
                                                    <input type="email" id="registerEmail" class="form-control" name='email' placeholder="Email" required/>
                                                    <label class="form-label" for="registerEmail"></label>
                                                </div>


                                                <div class="form-outline mb-4">
                                                    <input type="password" id="registerPassword" class="form-control" name='pass' placeholder="Password" required/>
                                                    <label class="form-label" for="registerPassword"></label>
                                                </div>


                                                <div class="form-outline mb-4">
                                                    <input type="password" id="registerRepeatPassword"
                                                        class="form-control" placeholder="Repeat password" required/>
                                                    <label class="form-label" for="registerRepeatPassword"></label>
                                                </div>


                                                <div class="form-check d-flex justify-content-center mb-4">
                                                    <input class="form-check-input me-2" type="checkbox" value=""
                                                        id="registerCheck" checked
                                                        aria-describedby="registerCheckHelpText" />
                                                    <label class="form-check-label" for="registerCheck">
                                                        I have read and agreed to the terms and conditions.
                                                    </label>
                                                </div>

                                                <a>
                                                <button  style="background-color: coral;border-color: coral;" type="submit" name='signup' class="btn btn-primary btn-block mb-3">Sign
                                                    in</button> 
                                                </a>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous">
        </script>
        <script src="js/yassinscript.js"></script>

</body>


</html>