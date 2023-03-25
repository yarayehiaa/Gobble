<?php
session_start();
require_once "conn.php";
$userid=2;
$sql="SELECT password from login where userid=$userid";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
if(isset($_POST['insert'])){
$oldpassword=$_POST['oldpassword'];
$newpassword=$_POST['newpassword'];
$confirmpassword=$_POST['confirm'];
$error;
$pRGEX="/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@%^&*_=+-]).{8,16}$/";
    if($row['password']!==$_POST['oldpassword']){
        $error='Your old password is incorrect';
    }
    else{
        $sql2="UPDATE `login` SET `password`='$newpassword' WHERE userid=$userid";
        if(preg_match($pRGEX,$newpassword)===1){
            if($newpassword===$confirmpassword){
                if ($conn->query($sql2) === true) {
                    $error1= "Password has changed successfully";
                    }
            }
            else{
                $error="Passwords are not the same";
            }
        }
            else {
            $error= "Your password must be have at least: 8 characters long - 1 uppercase & 1 lowercase character - 1 number - 1 symbol";
        }
    }
}

?>
<?php
if(isset($_POST['searchbtn'])){
include('result page.php');
}
?>
<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password</title>
    <link rel="stylesheet" href="css/editprofilecss.css">
  
    <link rel="stylesheet" href="all.min.css">
    <link rel="stylesheet" href="framework.css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <body style="background-color: darkorange; overflow-x: hidden;">
    <div class="content " style=" position: absolute;top: 0; left: 0%; width: 110%;">
        <div>
            <nav class="nav sticky-top navbar-default" style="background-color:white ; width: 100%;">
                <div class="flex-container" id="title"
                    style="display: flex; flex-direction: row; align-items: center; margin-left: 2%; margin-right: 2%;">
                    <a style="color: coral; display: flex; margin: 0%; padding-left: 2%;" class="navbar-brand" href="">
                        <h1 style="font-family:'Bungee'; transform: translateY(20%);">GOBBLE</h1>
                    </a>
                </div>
                    <div class="search-container" style="display:flex ; margin-left: 2%; margin-right: 2%; transform: translate(0%,12%); ">
                        <form  method="post" class="search" action="result page.php" style="flex-direction: row; align-items:center; display: flex;">
                            <input class="" type="text" placeholder="Search.." name="search" />
                            <button style="float:initial" type="submit" name="searchbtn"><i class="fa fa-search"></i></button>

                        </form>
                    </div>
                    <div style="transform:translate(10%,10%);">
                        <ul style="list-style: none; align-items: center; padding-left:3%; display: flex;">  
        
                            <div class="dropdown">
                                <button type="button" class="btn btn-link btn-floating mx-1 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
                                    <i class="fa fa-bell fa-2x" style="color:coral;" onclick="toggleNotifi()"></i>
                                </button>
                                
                                <ul class="dropdown-menu" id="box1">
                                    <h2>Notifications <span>  17</span></h2>
                                    <div class="notifi-item">
                                        <img src="Avatars Set Flat Style-13.png" alt="img">
                                        <div class="text">
                                           <h4>Elias Abdurrahman</h4>
                                           <p>@lorem ipsum dolor sit amet</p>
                                        </div> 
                                    </div>
                        
                                    <div class="notifi-item">
                                        <img src="Avatars Set Flat Style-03.png" alt="img">
                                        <div class="text">
                                           <h4>John Doe</h4>
                                           <p>@lorem ipsum dolor sit amet</p>
                                        </div> 
                                    </div>
                        
                                    <div class="notifi-item">
                                        <img src="Avatars Set Flat Style-02.png" alt="img">
                                        <div class="text">
                                           <h4>Emad Ali</h4>
                                           <p>@lorem ipsum dolor sit amet</p>
                                        </div> 
                                    </div>
                                    <div class="notifi-item">
                                        <img src="Avatars Set Flat Style-01.png" alt="img">
                                        <div class="text">
                                           <h4>Emad Ali</h4>
                                           <p>@lorem ipsum dolor sit amet</p>
                                        </div> 
                                    </div>
                                </ul>

                            </div>
                            <div>
                                 <button type="button" class="btn btn-link btn-floating mx-1 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" style="color: white;">
                                    <i class="fa fa-message fa-2x" style="color:coral;" onclick="toggleNotifi2()"></i>
                                </button>
                                <div class="dropdown-menu" id="box2">
                                <?php
                                        
                                        
                                        $id=$_SESSION['userid'];

                                        $sql = "SELECT friendid,lastmsg FROM following WHERE userid = '$id' ";
                                        $result = mysqli_query($conn,$sql);
                                        $count=mysqli_num_rows($result);
                                        echo "<h2>Messages<span> $count</span></h2>";
                                        
                                                while($row=mysqli_fetch_array($result)){
                                                  $friendid=$row['friendid'];
                                                  $lstmsg=$row['lastmsg'];
                                                  
                                                  $sql2="Select * from userdata where userid='$friendid'";
                                                  $result2 = mysqli_query($conn,$sql2);
                                                  $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
                                                  $friendname=$row2['Fname']." ".$row2['Lname'] ;
                                                  $friendimg=$row2['img'];
                                                 
                                                  echo " <div class='notifi-item'>
                                                  <img src='$friendimg' >
                                                  <div class='text'>
                                                     <h4>$friendname</h4>
                                                     <p>$lstmsg</p>
                                                  </div> 
                                              </div>";
                                                }
                                        ?>
                                </div>
                            </div> 
                            <div style="display: inline-block; position: relative; width: 40px; height: 40px; overflow: hidden;">
                                    <a href="profile.php" style="right: auto;">
                                        <img src="<?php echo $_SESSION['img']; ?>" style="width: 100%; height: auto;">
                                      </a>
                                    </div>
                            
                        </ul>
                    </div>
                
            </nav>
        </div>
    </div>
    <div class="sidebar bg-white p-20 "
        style="text-decoration: none; margin-top: 10%; height: fit-content; width: 17%; border-radius: 15px 50px; margin-left: 2%; transform: translateY(10%);">


        <ul style="text-decoration:none; align-items: center; margin-top: -5px;">
            <li>
                <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="edit profile.php">
                    <i class="fa fa-info fa-2x"></i>
                    <span>General Details</span>
                </a>
            </li>
            <li>
                <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="Social Links.php">
                    <i class="fa fa-link fa-2x"></i>
                    <span>Social Links</span>
                </a>
            </li>
            <li>
                <a class=" active d-flex align-center fs-14 c-black rad-6 p-10" href="Password.php">
                    <i class="fa fa-lock fa-2x"></i>
                    <span>Password</span>
                </a>
            </li>

        </ul>


    </div>
          <div class="social-boxes p-20 bg-white rad-10" style="width:70%; height:fit-content; transform: translate(300px,-200px);">
            <h2  style="color:#777" class="m-15">Password</h2>
            <form method="post">
            <?php
            if(!empty($error)){
            echo '<div class="alert alert-danger">' . $error . '</div>';
            }
            if(!empty($error1)){
                echo '<div class="alert alert-success">' . $error1 . '</div>';
            }        
            ?>
            <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label" style="transform: translate(30px,40px); font-size: large; color: #777;">Old Password: </label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="inputPassword-old" style=" border-style: solid; margin-top: 6%;" name="oldpassword" required/>
                </div>
              </div>
              <br>
              <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label" style="transform: translate(30px,40px); font-size: large; color: #777;">New Password: </label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="inputPassword-new" style="height: 40px; transform: translateY(35px);border-style: solid;" name="newpassword" required/>
                </div>
              </div>
              <br><br>
              <div class="mb-3 row">
                <label for="inputPassword" class="col-sm-2 col-form-label" style="transform: translate(30px,40px); font-size: large; color: #777;">Confirm New Password: </label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="inputPassword-confirm" style="height: 40px; transform: translateY(50px);border-style: solid;" name="confirm" required/>
                </div>
              </div>
            <div style="transform: translateX(77%);">
              <input class="btn btn-warning btn-lg" type="submit" value="Submit" style="margin-top: 80px; background-color: coral; border-color: coral;" role="button" name="insert">
              <input class="btn btn-light btn-lg" type="reset" value="Reset" style="margin-top: 80px; border-color: gray;" role="button" >
            </div>
            </form>
            </div>
    </div>
    <script src="js/yassinscript.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>