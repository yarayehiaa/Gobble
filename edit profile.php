<?php
session_start();
require_once "conn.php";
$id=$_SESSION['userid'];
if(isset($_POST['save'])){
    echo '<script>alert($id)</script>';
    $lname=$_POST["lastn"];
    $fname= $_POST['firstn'];
    $phone=$_POST["phone"];
    $bday=$_POST["bdate"];
    $email=$_POST['email'];
    $edu=$_POST["edu"];
    $job=$_POST["job"];
    $country=$_POST["country"];
    $state=$_POST["state"];
    $bio=$_POST["bio"];
    $rel=$_POST["rel"];
    $img = $_FILES["img"]["name"];
    if(empty($img)){
        $img=$_SESSION['img'];
    }
    $tempname = $_FILES["img"]["tmp_name"];
    $folder = "./images/" . $img;

    $sql = "UPDATE `userdata` SET `Fname`='$fname',`Lname`='$lname',
    `phone`='$phone',`bday`='$bday',`RelationshipStatus`='$rel',
    `Education`='$edu',`job`='$job',`Country`='$country',`State`='$state',
    `Bio`='$bio',`img`='$img',`email`='$email'where `userid`=$id";
         
         if ($conn->query($sql) === TRUE) {
            if (move_uploaded_file($tempname, $folder)) {
                $error= "Image uploaded successfully!";
               
            }
            header("location: profile.php");
         } else {
            echo '<script>alert("Couldnt save changes.Try again")</script>';
        }
}
?>

<html>

<head>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="css/editprofilecss.css">
    <link rel="stylesheet" href="all.min.css">
    <link rel="stylesheet" href="framework.css.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <script src=
        "https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
                integrity=
        "sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
                crossorigin="anonymous">
            </script>
            <script src=
        "https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js"
                integrity=
        "sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/"
                crossorigin="anonymous">
            </script>
</head>

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
                <a class=" active d-flex align-center fs-14 c-black rad-6 p-10" href="edit profile.php">
                    <i class="fa fa-info fa-2x"></i>
                    <span>General Details</span>
                </a>
            </li>
            <li>
                <a class=" d-flex align-center fs-14 c-black rad-6 p-10" href="Social Links.php">
                    <i class="fa fa-link fa-2x"></i>
                    <span>Social Links</span>
                </a>
            </li>
            <li>
                <a class="d-flex align-center fs-14 c-black rad-6 p-10" href="Password.php">
                    <i class="fa fa-lock fa-2x"></i>
                    <span>Password</span>
                </a>
            </li>

        </ul>
    </div>
    <div style="margin:20px; ">

        <div class="card-body" style="transform: translate(10%,-32%);">
            <div class="container rounded bg-white mt-5 mb-5" style="width: 80%;">
                <div class="row" style="width:120% ;">
                    
                    <div class="col-md-4 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5"> 
                            <img 
                                class="rounded-circle border-2 mt-5" width="150px"  src="<?php echo $_SESSION['img']; ?>" id="image-preview"><span
                                class="font-weight-bold fs-25"><?php echo $_SESSION['name']; ?></span> <br>
                                <h5 style="color: coral;">Change Profile Picture</h5>
                                <form method="POST" enctype="multipart/form-data">
                                <input style="background-color: coral; border-color:coral; width: fit-content; " name="img" type="file" class="form-control" accept="image/*" name="image" onchange="updatePreview(this, 'image-preview')">
                                </input>
                                <br>
                                <label  style="font-size: large;" class="labels">BIO</label>
                                <textarea placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempo...." 
                                class="form-control" type="text" style="height: 100px; width: 300px;" name="bio" maxlength="200"><?php echo $_SESSION['bio']; ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6 border-right">
                        <div class="p-3 py-5">
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right" style="color: #777;">Profile Settings</h4>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6"><label class="labels"> First Name</label><input type="text"
                                        class="form-control" placeholder="First name" name="firstn" value="<?php echo $_SESSION['Fname']; ?>"></div>
                                <div class="col-md-6"><label class="labels">Last name</label><input type="text" name="lastn"
                                        class="form-control" value="<?php echo $_SESSION['Lname']; ?>" placeholder="Last name"></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12"><label class="labels">Mobile Number</label><input type="number" name="phone"
                                        class="form-control" placeholder="Phone Number" value="<?php echo $_SESSION['phone']; ?>"></div>
                                <div class="col-md-12"><label class="labels">Email</label>
                                <input type="email" name='email'
                                        class="form-control" placeholder="Email" value="<?php echo $_SESSION['email']; ?>"></div>
                                <div class="col-md-12"><label class="labels">Birthday</label>
                                <input type="date" name="bdate"
                                        class="form-control" value="<?php echo $_SESSION['bday']; ?>"></div>

                                <div class="col-md-12"><label class="labels">Relationship Status</label><select
                                        class="form-control"  name="rel">
                                        <option>Single</option>
                                        <option>In A Relationship</option>
                                    </select></div>
                                <div class="col-md-12"><label class="labels">Education</label><input type="text" name="edu"
                                        class="form-control" placeholder="Education" value="<?php echo $_SESSION['edu']; ?>"></div>
                                <div class="col-md-12"><label class="labels">Work</label><input type="text" name="job"
                                        class="form-control" placeholder="Area" value="<?php echo $_SESSION['work']; ?>"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6"><label class="labels">Country</label><input type="text" name="country"
                                        class="form-control" placeholder="country" value="<?php echo $_SESSION['country']; ?>"></div>
                                <div class="col-md-6"><label class="labels">State/Region</label><input type="text" name="state"
                                        class="form-control" value="<?php echo $_SESSION['state']; ?>" placeholder="state"></div>
                            </div>
                            <div class="mt-5 text-center">
                                <button style="background-color: coral;border-color: coral;" type="submit"
                                    class="btn btn-primary btn-block mb-3"  name='save'>Save Profile</button>
                                <button style="border-color: gray;" type="reset"
                                    class="btn btn-light btn-block mb-3" type="reset">Clear</button>
                            </div>
                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="js/yassinscript.js?v=<?php echo time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>