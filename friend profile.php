<?php


session_start();
 require_once "conn.php";
 #olduser
    
    $id=$_GET['id'];
    echo '<script>alert($id)</script>';
    $sql = "SELECT * FROM userdata WHERE userid = $id ";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    $name=$row['Fname']." ".$row['Lname'] ;
    $loc=$row['State'].", ".$row['Country'] ;
    $rel =$row['RelationshipStatus'];
    $work =$row['job'];
    $edu=$row['Education'];
    $bio=$row['Bio'];
    $img=$row['img'];
    $friends=$row['friends'];
    $reviews=$row['reviews'];
    $star=$row['5stars'];
    $userid=$row['userid'];
   
        
        if(isset($_POST['pstcmnt'])){
            
        $authorid=$_SESSION['userid'];
            $namecom=$_SESSION['name'];
            $imgcom=$_SESSION["img"];
            $date=date("y-m-d");
            $comdata=$_POST['comment'];
            $postid=$_POST['id'];
        
            $sqll="INSERT INTO `comments`(`postid`, `comdata`, `commauthor`, `date`, `authorimg`,`authorid`) VALUES ($postid,'$comdata','$namecom',' $date','$imgcom',$authorid)";
            if ($conn->query($sqll) === TRUE) {
                $msg='done';
            
            }
            $sqll2="UPDATE `posts` SET `cmntsno`=cmntsno+1 WHERE postid=$postid";
            if ($conn->query($sqll2) === TRUE) {
                $msg='done';
            
            }
        }
    
        $myid=$_SESSION['userid'];
        $query = "SELECT * FROM `following` WHERE userid=$myid and friendid=$id";
        $result = mysqli_query($conn,$query);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $count = mysqli_num_rows($result);
        $output = '';
    if($count > 0)
    {
     $output = " <button
     style='margin-left: 500px;margin-top: -80px; height: 50px; background-color: coral; border-color: coral; width: 150px; transform: translateX(100%); '
     type='submit' class='btn btn-primary' name='following'  id='follow_btn' >Following</button>";
    }
    else
    {
     $output = " <button
     style='margin-left: 500px;margin-top: -80px; height: 50px; background-color: coral; border-color: coral; width: 150px; transform: translateX(100%); '
     type='submit' class='btn btn-primary' name='follow'  id='follow_btn' >Follow</button>";
    }

    if(isset($_POST['follow'])){
        $sqlin="INSERT INTO `following`(`friendid`, `userid`) VALUES ('$id','$myid')";
        $sql2="UPDATE `userdata` SET `friends`= (friends+1) WHERE userid=$id";
        if ($conn->query($sqlin) === TRUE) {
            if ($conn->query($sql2) === TRUE) {
                header("location: friend profile.php?id=$id");
               /*  $friends=$friends+1;
            $output = " <button
            style='margin-left: 500px;margin-top: -80px; height: 50px; background-color: coral; border-color: coral; width: 150px; transform: translateX(100%); '
            type='submit' class='btn btn-primary' name='following'  id='follow_btn' >Following</button>"; */
        }
        
    }
    }
    if(isset($_POST['following'])){
        $sqlin="DELETE FROM `following` WHERE friendid=$id and userid=$myid";
        $sql2="UPDATE `userdata` SET `friends`= (friends-1) WHERE userid=$id";
        if ($conn->query($sqlin) === TRUE) {
            if ($conn->query($sql2) === TRUE) {
                header("location: friend profile.php?id=$id");
               /*  $friends=$friends-1;
            $output = " <button
     style='margin-left: 500px;margin-top: -80px; height: 50px; background-color: coral; border-color: coral; width: 150px; transform: translateX(100%); '
     type='submit' class='btn btn-primary' name='follow'  id='follow_btn' >Follow</button>"; */
        }
    }
    }
    if(isset($_POST['send'])){
        
        $msg=$_POST['msg'];
        $sqlll="update following set lastmsg = '$msg' WHERE friendid=$id and userid=$myid";
        if ($conn->query($sqlll) === TRUE) {
            $msgs='done';
        }
    
    }
      

 ?>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link rel="stylesheet" href="profilecss.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/editprofilecss.css">
    <link rel="stylesheet" href="all.min.css">
    <link rel="stylesheet" href="framework.css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>

<body style="background-image: url(3575868.jpg); position: relative; overflow-x: hidden;">
    <div class="page d-flex" style="flex-direction:column ;">
        
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
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="friends.php">
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
                    <div class="search-container" style="display:flex ; margin-left: 2%; margin-right: 2%; transform: translate(5%,12%); ">
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
                                        
                                        
                                        $myid=$_SESSION['userid'];

                                        $sql = "SELECT friendid,lastmsg FROM following WHERE userid = '$myid' ";
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



        <div style="margin:40px; ">
            <div class="card mx-auto" style="height: fit-content; transform: translate(120px,-350px); width: 80%;">
                <div class="card-body">
                    <pre><h2> &nbsp;  <?php echo $reviews; ?>  &nbsp;  &nbsp;   <?php echo $friends; ?>   &nbsp; &nbsp;    <?php echo $star; ?> </h2></pre>
                  
                    <p style="font-size: 25 px; font-style:oblique;"> &nbsp; &nbsp; &nbsp; &nbsp; Reviews
                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Followers &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                        5star-ratings
                    </p>
                    <form method="POST">
                    <?php 
                    echo $output;
                    ?>
                    </form>
                    <div class="chatbox-wrapper">
                            <div class="chatbox-toggle">
                    <button
                        style="margin-left: 660px;margin-top: -80px; height: 50px; background-color: coral; border-color: coral; width: 150px; transform: translate(100%,-30%) "
                        type="button" class="btn btn-primary">Message</button>
                            </div>
                    </div>
                                    
                    <p style="font-size:50px; font-style:oblique; text-align:center; margin-top: 5%; margin-bottom:5%"><?php echo $name; ?></p>
                    <div style="margin-left: 00px ; text-align: center;">
                        <p> <i class="fa fa-location-arrow"> </i> <?php echo $loc; ?></p>
                        <p> <i class="fa fa-heart-o"> </i> <?php echo $rel; ?></p>
                        <p> <i class="fa fa-desktop"> </i> Works at <?php echo $work; ?></p>
                        <p><i class="fa fa-book"> </i> Studied at <?php echo $edu; ?></p>
                    </div>
                    <div style="margin: 40px;">
                        <p style="text-align: center;"><?php echo $bio; ?></p>
                    </div>
                </div>
            </div>

            <div id="avatar" class="card"
                style="width: 15rem; position: absolute;box-shadow: 10px 10px 5px lightblue; border-width: 0px; transform: translate(630px,-1070px); ">
                <img src="<?php echo $img; ?>"
                    class="card-img-top" style="background-color: white;">

            </div>
        </div>
    
        <!-- posts -->
        <div  id="postlist">

        <div style="width:1010px; margin-left: 300px; margin-top: -350px;">
        <?php
        $seshimg=$_SESSION['img'];
     
        
        $getposts="Select * from posts where userid='$id' order by 1 DESC";
        $posts=mysqli_query($conn,$getposts);
        while($row=mysqli_fetch_array($posts)){
            $avatar=$img;
            $name=$name;
            $post_id = $row['postid'];
		    $user_id = $row['userid'];
		    $content = $row['postcontent'];
		    $upload_image = $row['postimg'];
		    $post_date = $row['postdate'];
            $likes=$row["likes"];
            $cmntsno=$row["cmntsno"];
            
            if(strlen($upload_image) == 0){
                
        
                echo  " 
                <div class='central-meta item'>
                    <div class='latest-post' style='width:100%'>
         
                        <div class='top' style='display:flex; align-items:center;'>
                            <div class='friend-info'>
                                 <figure>
                                    <img class='avatar' style='margin-right: 15px; margin-bottom: 15px; height: 70px;'
                                        src='$avatar'>
                                 </figure>
                                    <div class='friend-name'>
                                        <ins><a href='profile.php' >$name</a></ins>
                                         <span>published: $post_date</span>
                                    </div>
                            </div>
                            <br>
                        </div>
                        <div style='padding: 10px; margin:10px,0px,10px,0px' class='post-content'>
                         $content
                        </div>
                        <div class='post-stats'
                            style='display: flex; align-items: center; justify-content: space-between; color:gray;'>
                            <div>
                                <span 'Change_CLR2(this)' class='fa fa-heart'>$likes</span>
                            </div>
                            <div>
                                <span class='fa fa-comment'></span>
                                <span class='commnum'>$cmntsno</span>
                            </div>
                        </div>
                        <div class='coment-area' style='width:100%'>
                             <ul class='we-comet' id='x'>";
                             $sql5 = "SELECT * FROM comments WHERE postid = $post_id ";
                             $result5 = mysqli_query($conn,$sql5);
                             while($row5=mysqli_fetch_array($result5)){
                                 
                                 $commauthor=$row5['commauthor'];
                                 $authorimg=$row5['authorimg'];
                                 $commdata=$row5['comdata'];
                                 $comdate=$row5['date'];
                                 $authorid=$row5['authorid'];
 
 
 
                                 echo " <li >
                                 <div class='comet-avatar'>
                                 <img src='$authorimg' class='avatar' style='margin-right: 15px;  height: 70px;'>
                                 </div>
                                 <div class='we-comment'>
                                 <div class='coment-head'>
                                 <h5><a href='friend profile.php?id=$authorid' >$commauthor</a></h5>
                                 <span>$comdate</span>
                                 
                                 </div>
                                 <p> $commdata</p>
                                 </div>
                                 </li>";
                             }

                            echo " </ul>
                            <div class='post-comment' style='width:100%'>
                                <div class='comet-avatar'>
                                    <img src='$seshimg' class='avatar' style='height:50px ;'>
                                </div>
                                <div class='post-comt-box' style='width:100%'>
                                <form method='post'  style='width:100%'>
                                <textarea placeholder='Post your comment' style='width:100%' name='comment' value='' ></textarea>
                                <input type='hidden' name='id' value=' $post_id '>
        
                                <button class='float-right' name='pstcmnt'  type='submit' style='margin-right:-150px' >POST</button>
                            </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>";
             }
             else{
            
              echo
                 "
                 <div class='central-meta item'>
                    <div class='latest-post'>
                        <div class='friend-info'>
                             <figure>
                                 <img src='$avatar' style='height: 70px ; '>
                             </figure>
                             <div class='friend-name'>
                                 <ins><a href='profile.php' >$name</a></ins>
                                 <span>published.$post_date</span>
                             </div>
                             </div>
                             <div class='post-meta'>
                             <div style='text-align:center ;'>
                                     <img src='images/$upload_image' 
                                     style='height: 500px ; width:auto; align-self: center;padding-bottom: 20px;'>
                             </div>
                             
                             <div class='post-content' style='padding: 10px; margin:10px,0px,10px,0px'>
                                $content
                             </div>
                            
                             <div class='post-stats'
                                 style='display: flex; align-items: center; justify-content: space-between; color:gray;'>
                                 <div>
                                     <span onclick='Change_CLR2(this)' class='fa fa-heart'>$likes</span>
                                 </div>
                                 <div>
                                     <span class='fa fa-comment'></span>
                                     <span class='commnum'>$cmntsno</span>
                                 </div>
                             </div>
         
         
         
         
                             <div class='coment-area'>
                                 <ul class='we-comet'>";
                                 $sql5 = "SELECT * FROM comments WHERE postid = $post_id ";
                                 $result5 = mysqli_query($conn,$sql5);
                                 while($row5=mysqli_fetch_array($result5)){
                                     
                                     $commauthor=$row5['commauthor'];
                                     $authorimg=$row5['authorimg'];
                                     $commdata=$row5['comdata'];
                                     $comdate=$row5['date'];
                                     $authorid=$row5['authorid'];
     
     
     
                                     echo " <li >
                                     <div class='comet-avatar'>
                                     <img src='$authorimg' class='avatar' style='margin-right: 15px;  height: 70px;'>
                                     </div>
                                     <div class='we-comment'>
                                     <div class='coment-head'>
                                     <h5><a href='friend profile.php?id=$authorid' >$commauthor</a></h5>
                                     <span>$comdate</span>
                                     
                                     </div>
                                     <p> $commdata</p>
                                     </div>
                                     </li>";
                                 }
                                 echo "
                                 </ul>
         
                                 <div class='post-comment'>
                                     <div class='comet-avatar'>
                                         <img src='$seshimg' style='height:50px ;'>
                                     </div>
                                     <div class='post-comt-box'>
                                     <form method='post'  style='width:100%'>
                                     <textarea placeholder='Post your comment' style='width:100%' name='comment' value='' ></textarea>
                                     <input type='hidden' name='id' value=' $post_id '>
             
                                     <button class='float-right' name='pstcmnt'  type='submit' style='margin-right:-150px' >POST</button>
                                 </form>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     </div>
                     
                      ";

	

        }
    }


        ?>

        
    
    </div>
    <div class="chatbox-message-wrapper">
        <div class="chatbox-message-header">
            <div class="chatbox-message-profile">
                <img src="<?php echo $img; ?>" alt="" class="chatbox-message-image">
                <div>
                    <h4 class="chatbox-message-name"><?php echo $name; ?></h4>
                    <p class="chatbox-message-status">online</p>
                </div>
            </div>
            <div class="chatbox-message-dropdown chatbox-message-dropdown-toggle">
                <i class='fa fa-user' style="color: green;"></i>
                
               
            </div>
        </div>
        <div class="chatbox-message-content">
            <h4 class="chatbox-message-no-message">You don't have any messages yet!</h4>
        </div>
        <div class="chatbox-message-bottom">
            <form method='POST'  >
                <textarea rows="1" placeholder="Type message..." class="chatbox-message-input" name='msg' value='' ></textarea>
                <button type="submit"  name='send' class="chatbox-message-submit"><i class='bx bx-send'  ></i></button>
                
            </form>
        </div>
    </div>    
    
    

<script src="js/myjs.js"></script>
<script src="js/yassinscript.js?v=<?php echo time(); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>