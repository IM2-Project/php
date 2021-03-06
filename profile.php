<?php
    session_start(); #start session in each form validation page so that we can all access the super global var $_SESSION
    include "connectDB.php";
    include "checkLogin.php";
    displayAlert();    
  ?>
<html>
  <head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
      integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/bootstrap.min.css">
    <title> <?php echo ''.$_SESSION['Succeed']['username'].''?> </title>
  </head>

  <body class="bg-secondary">
    <div class="container w-50 position-relative mx-auto p-5 my-5 bg-light shadow">             
      <a class="btn btn-danger" href="profile.php?delete_ID=<?php echo$_SESSION['Succeed']['id'] ?>">Delete Profile</a>
      <a class="btn btn-info" href="editProfile.php?edit_ID=<?php echo $_SESSION['Succeed']['id'] ?>">Change Username</a>
      <a class="btn btn-info" href="changePassword.php?pass_ID=<?php echo $_SESSION['Succeed']['id'] ?>">Change Password</a>
    </div>              

    <?php 
    #I did not make a delete handler/page because this should not run if the user did not click on Delete
       $conn = new mysqli("localhost","root","","im2");
        //check connection
        if(isset($_GET['delete_ID'])){#deleting
            $userID=$_GET['delete_ID'];
        if($conn->connect_error){
          die("Connection failed: " . $conn->connect_error);
        }else{
            $sql = "DELETE FROM users WHERE user_id= $userID";
              if($conn->query($sql)===TRUE){
                  echo "<script language='javascript'>alert('Profile Successfully Deleted!');window.location.href='?logout=true';</script>";
              }
              else{
                  echo "<script language='javascript'>alert('Uh oh! That wasn't supposed to happen!');</script>";
              }
          }
        }        
     ?>     
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
      </script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
      </script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
      </script>
    </body>
</html>