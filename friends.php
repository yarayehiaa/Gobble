<?php 
require_once "conn.php";
session_start();
$myid=$_SESSION['userid'];

if(isset($_POST['remove'])){
  $id=$_POST['friendid'];
  $sqlin="DELETE FROM `following` WHERE friendid=$id and userid=$myid";
  if ($conn->query($sqlin) === TRUE) {
      $msg='done';
     
  }
}


?>
<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Friends</title>
  <link rel="stylesheet" href="profilecss.css">
  <link rel="stylesheet" href="Friends.css">
  <link rel="stylesheet" href="all.min.css">
  <link rel="stylesheet" href="css/editprofilecss.css">
  <link rel="stylesheet" href="framework.css.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body style="background-image: url(3575868.jpg); height: 100vh;">
  <div class="page">
    <div class="sidebar bg-white p-20 " style="text-decoration: none; position: sticky; top: 0; left:0px; height: 100vh;">
      <h1 style="font-family:'Bungee', 'Arial Narrow', Arial, sans-serif; color: coral; ">
          GOBBLE</h1>

      <ul style="text-decoration: none;">
          <li>
              <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="feed.php">
                  <i class="fa fa-home fa-fw"></i>
                  <span style="text-decoration: none;">Feed</span>
              </a>
          </li>
          <li>
              <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="edit profile.php">
                  <i class="fa fa-cog fa-fw"></i>
                  <span>Settings</span>
              </a>
          </li>
          <li>
              <a class="  d-flex align-center fs-14 c-black rad-6 p-10" href="profile.php">
                  <i class="fa fa-user fa-fw"></i>
                  <span>Profile</span>
              </a>
          </li>
          <li>
              <a class=" active d-flex align-center fs-14 c-black rad-6 p-10" href="friends.php">
                  <i class="fa fa-users"></i>
                  <span>Friends</span>
              </a>
          </li>
          <li>
              <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="logout.php">
                <i class="fa fa-sign-out"></i>
                <span>Log Out</span>
              </a>
            </li>
      </ul>
  </div>
  <div class="content " style=" position: absolute;top: 0; left: 0%; width: 110%;">
      <div>
          <nav class="nav sticky-top navbar-default" style="background-color:white ; width: 77%; transform: translateX(19%); ">
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
   <div class="friends-page d-grid m-20 gap-20" style="margin-top: -37%; margin-left: 23%;">
    
<?php
$id=$_SESSION['userid'];

$sql = "SELECT friendid FROM following WHERE userid = '$id' ";
$result = mysqli_query($conn,$sql);

        while($row=mysqli_fetch_array($result)){
          $friendid=$row['friendid'];
          $sql2="Select * from userdata where userid='$friendid'";
          $result2 = mysqli_query($conn,$sql2);
          $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
          $friendname=$row2['Fname']." ".$row2['Lname'] ;
          $friendimg=$row2['img'];
          $friendjob=$row2['job'];
          $friendno=$row2['friends'];
          $friendreview=$row2['reviews'];
          $friendbday=$row2['bday'];
          echo " <div class='friend bg-white rad-6 p-20 p-relative' style='width: fit-content;'>
          <div class='contact'>
            <i class='fa fa-envelope'></i>
          </div>
          <div class='txt-c'>
            <img class='rad-half mt-10 mb-10' src='$friendimg'  
              style='width: 100px; '/>
              <form method='POST'>
            <h4 class='m-0' name='frndname'>$friendname</h4>
            <p class='c-grey fs-13 mb-0'>$friendjob</p>
          </div>
          <div class='icons fs-14 p-relative'>
            <div class='mb-10'>
              <i class='fa fa-face-smile fa-fw'></i>
              <span> $friendno Friend</span>
            </div>
            <div>
              <i class='fa fa-newspaper fa-fw'></i>
              <span>$friendreview Reviews</span>
            </div>
            <br>
            <span class='vip fw-bold c-orange'>TOP REVIEWER</span>
          </div>
          <div class='info between-flex fs-13'>
            <span class='c-grey'>Joined $friendbday</span>
            <div>
              <a class='bg-blue c-white btn-shape' href='friend profile.php?id=$friendid'
                style='margin-right: 10px; margin-left:10px;text-decoration: none;' name='profile'>
                
                Profile
                </a>
                
              <button onclick='remove(this)' name='remove' type='submit' class='bg-red c-white btn-shape'  style='text-decoration: none;'>Remove</button>
            </div>
            <input type='hidden'  name='friendid' value=' $friendid '>
            </form>
          </div>
        </div>" ;

        }

?>


    
  


   </div>
   <script src="js/yassinscript.js?v=<?php echo time(); ?>"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>