<?php
require_once "conn.php";
session_start();
$id=$_SESSION['userid'];


$query1 = "SELECT Fname,Lname,img,Bio,userid FROM userdata WHERE (Fname LIKE '%".$_POST['search']."%' OR Lname LIKE '%".$_POST['search']."%') and userid !=$id";
$result1 = mysqli_query($conn,$query1);



?>
<!doctype html>
<html lang="en">
    <head>

        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>result page</title>
    <link rel="stylesheet" href="css/editprofilecss.css">
    <link rel="stylesheet" href="profilecss.css">
    <link rel="stylesheet" href="css/style.css">
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
                    <div style="transform:translate(0%,10%);">
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
 <div class="social-boxes p-20  bg-white rad-10" style="width:90%; height:fit-content; transform: translate(5%,10%); margin-top:5%">
        <h1 style="color:coral;">Search Results</h1><hr>
        <?php
        while($row=mysqli_fetch_array($result1)){
            $username=$row['Fname']." ".$row['Lname'];
            $image=$row['img'];
            $bio=$row['Bio'];
            $friendid=$row['userid'];
            echo"
            <div class='card'>
            <div class='card-body'>
            <div class='top' style='display:flex; align-items:center;'>
                                  <div class='friend-info' >
                                  <figure><img src='$image'></figure>
                                  <div class='friend-name'>
                                      <ins><a href='friend profile.php?id=$friendid'>$username</a></ins>
                                      <span>$bio</span>
                                  </div>
                                  </div>
                                  <br>
                              </div>
            </div>
          </div>";
        }
        ?>
        </div>
    <script src="js/yassinscript.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>