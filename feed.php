<?php
session_start();
require_once "conn.php";
$id=$_SESSION['userid'];
if(isset($_POST['nwpst'])) {

    
    
    $img=$_FILES["img"]["name"];
    $tempname = $_FILES["img"]["tmp_name"];
    $folder = "./images/" . $img;
    if($_POST['content']==''){
        echo '<script>alert("please enter a caption")</script>';
    }else {
    $content=$_POST['content'];
    $msg= $_POST['content'];
    $sql="INSERT INTO `posts`( `userid`, `postimg`, `postcontent`, `likes`, `cmntsno`) VALUES ($id,'$img','$content',0,0);
    ";
    if ($conn->query($sql) === TRUE) {
        if (move_uploaded_file($tempname, $folder)) {
            $msg='posted!';


        }
        $sqll="UPDATE `userdata` SET reviews = reviews+1 where userid=$id";
        if ($conn->query($sqll) === TRUE) {
            $msg='done';
           
        }
       
    }
}
    
    
}
if(isset($_POST['pstcmnt'])){
    

    $namecom=$_SESSION['name'];
    $imgcom=$_SESSION["img"];
    $date=date("y-m-d");
    $comdata=$_POST['comment'];
    $postid=$_POST['id'];

    $sqll="INSERT INTO `comments`(`postid`, `comdata`, `commauthor`, `date`, `authorimg`,`authorid`) VALUES ($postid,'$comdata','$namecom',' $date','$imgcom',$id)";
    if ($conn->query($sqll) === TRUE) {
        $msg='done';
       
    }
    $sqll2="UPDATE `posts` SET `cmntsno`=cmntsno+1 WHERE postid=$postid";
    if ($conn->query($sqll2) === TRUE) {
        $msg='done';
       
    }
}


?>




<html style="height: 100vh;">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Feed</title>
    <link rel="stylesheet" href="profilecss.css">
    <link rel="stylesheet" href="Friends.css">
    <link rel="stylesheet" href="all.min.css">
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="css/editprofilecss.css">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/color.css">
    <link rel="stylesheet" href="css/responsive.css">
    <link rel="stylesheet" href="framework.css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body style="background-image: url(3575868.jpg); height: 100vh; overflow-x:hidden">
    <div class="page" style="height: 100vh;">
        <div class="sidebar bg-white p-20"
            style="text-decoration: none; position: sticky; top:0px; left:0px; height: 100%;  border-radius: 0px 0px 15px 15px;">
            <h1 style="font-family:'Bungee', 'Arial Narrow', Arial, sans-serif; color: coral;  ">
                GOBBLE</h1>

            <ul style="text-decoration: none;">
                <li>
                    <a class=" active d-flex align-center fs-14 c-black rad-6 p-10" href="feed.php">
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
                    <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="profile.php">
                        <i class="fa fa-user fa-fw"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li>
                    <a class="  d-flex align-center fs-14 c-black rad-6 p-10" href="friends.php">
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


        <div class="card" style="width: 250px; padding: 20px; margin-top: 20px;  border-radius: 15px 50px;">
            <div class="widget">
                <h4 class="widget-title">Recent Activity</h4>
                <ul class="activitiez">
                    <li>
                        <div class="activity-meta">
                            <i>10 hours Ago</i>
                            <span><a href="#" title="">Refaat commented on a video </a></span>

                        </div>
                    </li>
                    <li>
                        <div class="activity-meta">
                            <i>30 Days Ago</i>
                            <span><a href="#" title=""> Omar Posted “Hello guys....”</a></span>
                        </div>
                    </li>
                    <li>
                        <div class="activity-meta">
                            <i>2 Years Ago</i>
                            <span><a href="#" title="">Aisha Shared a video on her timeline.</a></span>

                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-lg-9" style="margin-top: -60%; margin-left:20%;  ">
            <div class="central-meta">
                <div class="new-postbox">
                    <figure>
                        <img src="<?php echo $_SESSION['img']; ?>" >
                    </figure>
                    <div class="newpst-input">
                        <form method="POST" enctype="multipart/form-data" >
                            <textarea rows="2" style="resize:none; " type=text placeholder="write something...." name=content
                            id="nwpst"  value=''></textarea>
                            <div class="attachments" >
                                <ul >
                                  
                                    <li >
                                        <div >
                                        <img id="image-preview" style="height: 70px; "> 
                                        </div>
                                    </li>
                                    <li>
                                        <i class="fa fa-image"></i>
                                        <label class="fileContainer">
                                            <input type="file" name=img accept="image/*" onchange="Preview(this,'image-preview')">
                                        </label>
                                    </li>
                             
                                    <li>
                                        <button type="submit"  name='nwpst' style="background-color: coral;">Post</button>
                                    </li>
                                   
                                </ul>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div><!-- add post new box -->
            <div class="loadMore" id="postlist">
            <?php
     
     $id=$_SESSION['userid'];
     $image=$_SESSION['img'];
     $sql = "SELECT friendid FROM following WHERE userid = '$id' ";
     $result = mysqli_query($conn,$sql);
             while($row=mysqli_fetch_array($result)){
               $friendid=$row['friendid'];
               $sql3="Select * from userdata where userid='$friendid'";
               $result3 = mysqli_query($conn,$sql3);
               $row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC);
               $avatar=$row3['img'];
               $name=$row3['Fname']." ".$row3['Lname'] ;
               $sql2="Select * from posts where userid='$friendid'";
               $result2 = mysqli_query($conn,$sql2);
               while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)){
                $post_id = $row2['postid'];
                $user_id = $row2['userid'];
                $content = $row2['postcontent'];
                $upload_image = $row2['postimg'];
                $post_date = $row2['postdate'];
                $likes=$row2["likes"];
                $cmntsno=$row2["cmntsno"];
         
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
                                 
                                     <ins><a href='friend profile.php?id=$friendid' >$name</a></ins>
                                     
                                    
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
                             <span onclick='Change_CLR2(this)' class='fa fa-heart'>$likes</span>
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

                          echo "
                          </ul>
                         <div class='post-comment' style='width:100%'>
                             <div class='comet-avatar'>
                                 <img src='$image' class='avatar' style='height:50px ;'>
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
                          <ins><a href='friend profile.php?id=$friendid' >$name</a></ins>
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
                              
                              $sql6 = "SELECT * FROM comments WHERE postid = $post_id ";
                              $result6 = mysqli_query($conn,$sql6);
                              while($row5=mysqli_fetch_array($result6)){
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
                                      <img src='$image' style='height:50px ;'>
                                  </div>
                                  <div class='post-comt-box'>
                                      <form method='post'>
                                          <textarea placeholder='Post your comment' style='width:100%;' name='comment' value=''></textarea>
                                          <input type='hidden' name='id' value=' $post_id '>
      
                                          <button type='submit' name='pstcmnt' style='transform: translate(170%,-20%);' >POST</button>
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
 }


     ?>

            




               <!--  <div class="central-meta item">
                    <div class="latest-post">
                        <div class="friend-info">
                            <figure>
                                <img src="yassin.jpeg" style="height: 70px ; ">
                            </figure>
                            <div class="friend-name">
                                <ins><a href="time-line.html" title="">Yassin Emam</a></ins>
                                <span>published: june,2 2018 19:PM</span>
                            </div>

                            <div class="post-meta">
                                <div style="text-align:center ;">
                                    <img src="food.jpg" alt=""
                                        style="height: 500px ; width:auto; align-self: center; padding-bottom: 20px;">
                                </div>
                            </div>
                            <div class="post-content" style="padding: 10px; margin:10px,0px,10px,0px">


                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis
                                nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                                aute
                                irure

                            </div>
                            <div class="post-stats"
                                style="display: flex; align-items: center; justify-content: space-between; color:gray;">
                                <div>
                                    <span onclick="Change_CLR(this)" class="fa fa-heart">15</span>
                                    
                                </div>
                                <div>
                                    <span class="fa fa-comment"></span>
                                    <span class="commnum">3</span>
                                </div>
                            </div>




                            <div class="coment-area">
                                <ul class="we-comet">
                                    <li>
                                        <div class="comet-avatar">
                                            <img src="yara.jpg" style="height:70px ;">
                                        </div>
                                        <div class="we-comment">
                                            <div class="coment-head">
                                                <h5><a href="time-line.html" title="">Yara Yehia</a></h5>
                                                <span>1 year ago</span>

                                            </div>
                                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                                minim
                                                veniam, quis</p>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="comet-avatar">
                                            <img src="refaat.jpeg" style="height:70px ;">
                                        </div>
                                        <div class="we-comment">
                                            <div class="coment-head">
                                                <h5><a href="time-line.html" title="">Ahmed Refaat</a></h5>
                                                <span>1 month ago</span>

                                            </div>
                                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                                ad minim veniam, quis</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="comet-avatar">
                                            <img src="yassin.jpeg" style="height:70px ;">
                                        </div>
                                        <div class="we-comment">
                                            <div class="coment-head">
                                                <h5><a href="time-line.html" title="">Yassin Emam</a></h5>
                                                <span>16 days ago</span>

                                            </div>
                                            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                                eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim
                                                ad minim veniam, quis</p>
                                        </div>
                                    </li>


                                </ul>

                                <div class="post-comment">
                                    <div class="comet-avatar">
                                        <img src="Avatars Set Flat Style-16.png" style="height:50px ;">
                                    </div>
                                    <div class="post-comt-box">
                                        <form method="post">
                                            <textarea placeholder="Post your comment"></textarea>

                                            <button onclick="cc(this)" type="button">POST</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="central-meta item">
                    <div class="latest-post">
                        <div class="friend-info">
                            <figure>
                                <img src="refaat.jpeg" alt="">
                            </figure>
                            <div class="friend-name">
                                <ins><a href="time-line.html" title="">Ahmed Refaat</a></ins>
                                <span>published: june,2 2018 19:PM</span>
                            </div>
                            <div class="post-meta">
                                <div style="text-align:center ;">
                                    <img src="food2.jpg" alt=""
                                        style="height: 500px ; width:auto; align-self: center;padding-bottom: 20px;">
                                </div>



                                <div class="post-content" style="padding: 10px; margin:10px,0px,10px,0px">


                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis
                                    nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                                    aute
                                    irure

                                </div>
                                <div class="post-stats"
                                    style="display: flex; align-items: center; justify-content: space-between; color:gray;">
                                    <div>
                                        <span onclick="Change_CLR(this)" class="fa fa-heart">5</span>
                                    
                                    </div>
                                    <div>
                                        <span class="fa fa-comment"></span>
                                        <span class="commnum">0</span>
                                    </div>
                                </div>

                                <div class="coment-area">
                                    <ul class="we-comet">
                                    </ul>
                                    <div class="post-comment">
                                        <div class="comet-avatar">
                                            <img src="Avatars Set Flat Style-16.png" class="avatar"
                                                style="height:50px ;">
                                        </div>
                                        <div class="post-comt-box">
                                            <form method="post">
                                                <textarea placeholder="Post your comment"></textarea>

                                                <button onclick="cc(this)" type="button">POST</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="central-meta item">
                    <div class="latest-post">
                        <div class="friend-info">
                            <figure>
                                <img class="avatar" style="margin-right: 15px;  height: 70px;" src="baily.jpeg">
                            </figure>
                            <div class="friend-name">
                                <ins><a href="time-line.html" title="">Omar Ehab</a></ins>
                                <span>published: january,5 2018 19:PM</span>
                            </div>
                            <div class="post-meta">
                                <div class="post-map">
                                    <div class="nearby-map">
                                        <div id="map-canvas"></div>
                                    </div>
                                </div>
                               
                                <div class="post-content" style="padding: 10px; margin:10px,0px,10px,0px">


                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                    eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis
                                    nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis
                                    aute
                                    irure

                                </div>
                                <div class="post-stats"
                                    style="display: flex; align-items: center; justify-content: space-between; color:gray;">
                                    <div>
                                        <span onclick="Change_CLR(this)" class="fa fa-heart"> 3</span>
                                        
                                    </div>
                                    <div>
                                        <span class="fa fa-comment"></span>
                                        <span class="commnum">2</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="coment-area">
                            <ul class="we-comet">
                                <li>
                                    <div class="comet-avatar">
                                        <img src="WhatsApp Image 2022-11-18 at 7.31.51 PM.jpeg" class="avatar"
                                            style="margin-right: 15px;  height: 70px;">
                                    </div>
                                    <div class="we-comment">
                                        <div class="coment-head">
                                            <h5><a href="time-line.html" title="">Aisha Moghazy</a></h5>
                                            <span>1 year ago</span>

                                        </div>
                                        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                                            veniam, quis
                                        </p>
                                    </div>

                                </li>
                                <li>
                                    <div class="comet-avatar">
                                        <img src="farah.jpeg" class="avatar" style="margin-right: 15px;  height: 70px;">
                                    </div>
                                    <div class="we-comment">
                                        <div class="coment-head">
                                            <h5><a href="time-line.html" title="">Farah Abdelaziz</a></h5>
                                            <span>1 week ago</span>

                                        </div>
                                        <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                                            eiusmod tempor incididunt ut

                                        </p>
                                    </div>
                                </li>
                            </ul>
                            <div class="post-comment">
                                <div class="comet-avatar">
                                    <img src="Avatars Set Flat Style-16.png" class="avatar" style="height:50px ;">
                                </div>
                                <div class="post-comt-box">
                                    <form method="post">
                                        <textarea placeholder="Post your comment"></textarea>

                                        <button onclick="cc(this)" type="button">POST</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="central-meta item">
                    <div class="latest-post">

                        <div class="top" style="display:flex; align-items:center;">
                            <div class="friend-info">
                                <figure>
                                    <img class="avatar" style="margin-right: 15px; margin-bottom: 15px; height: 70px;"
                                        src="baily.jpeg">
                                </figure>
                                <div class="friend-name">
                                    <ins><a href="Profile.html" title="">Omar Ehab</a></ins>
                                    <span>published: january,5 2018 19:PM</span>
                                </div>
                            </div>
                            <br>
                        </div>
                        <div style="padding: 10px; margin:10px,0px,10px,0px" class="post-content">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                            eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                            irure
                        </div>
                        <div class="post-stats"
                            style="display: flex; align-items: center; justify-content: space-between; color:gray;">
                            <div>
                                <span onclick="Change_CLR(this)" class="fa fa-heart"> 0</span>
                                
                            </div>
                            <div>
                                <span class="fa fa-comment"></span>
                                <span class="commnum">0</span>
                            </div>
                        </div>
                        <div class="coment-area">
                            <ul class="we-comet" id="x">
                            </ul>

                            <div class="post-comment">
                                <div class="comet-avatar">
                                    <img src="Avatars Set Flat Style-16.png" class="avatar" style="height:50px ;">
                                </div>
                                <div class="post-comt-box">
                                    <form method="post">
                                        <textarea placeholder="Post your comment"></textarea>

                                        <button onclick="cc(this)" type="button" >POST</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
 -->


            </div>
        </div>
    </div>
    

    <!-- centerl meta -->
    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="js/main.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/map-init.js"></script>
    <script src="js/myjs.js"></script>
    <script src="js/yassinscript.js?v=<?php echo time(); ?>"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA8c55_YHLvDHGACkQscgbGLtLRdxBDCfI"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
 


</body>

</html>