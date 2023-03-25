<?php


        echo $_GET["msg"];
        $msg=$_GET['msg'];
        $sqlll="update following set lastmsg = '$msg' WHERE friendid=$id and userid=$myid";
        if ($conn->query($sqlll) === TRUE) {
            $msgs='done';
        }
    
    
    ?>
    class="chatbox-message-form"