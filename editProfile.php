<?php
    session_start(); #start session in each form validation page so that we can all access the super global var $_SESSION    
    include "connectDB.php";
    include "checkLogin.php";
    displayAlert();        
    $user="";  
    $conn = new mysqli("localhost","root","","im2");
?>

<html>
  <head>
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/ Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> 
      <link rel="stylesheet" href="./styles/bootstrap.min.css"> 
      <title><?php echo ''.$_SESSION['Succeed']['username'].''?> Profile Edit </title>
  </head>

<body class="bg-secondary">     
          <div class="container w-50 position-relative mx-auto p-5 my-5 bg-light shadow">
<?php     
           #start of username changing
           if(isset($_GET['edit_ID'])){
            $user=$_GET['edit_ID'];
            }
              //check connection
              if($conn->connect_error){
                die("Connection failed: " .$conn->connect_error);
              }else{            
                $sql_1="SELECT * FROM users WHERE user_id=$user";
                      if($conn->query($sql_1)){              
                          $result1=$conn->query($sql_1);
                          $data=$result1->fetch_assoc();
                              echo'
                                  <form action="editProfile.php" method="POST" enctype="multipart/form-data">
                                        <div class="form-row">
                                             <div class="form-group col-md-6">
                                                 <label for="fname">Username</label>
                                                 <input type="text" class="form-control" name="new_name" placeholder="Enter new username" required>
                                                 <input type="hidden"  class="form-control" name="user_id" value="'.$data['user_id'].'" id="user_id"  required>
                                              </div>
                                         </div>                      
                                              <input type="submit" class="btn btn-dark text-white" value="Submit" name="submit" required>
                                              <a href="profile.php?user_id='.$data['user_id'].'">
                                              <button type="button" class="btn btn-warning text-white" data-dismiss="modal">Close</button>
                                              </a>
                                  </form>
                              ';                        
                      }                                
                      if(isset($_POST['submit'])){
                            $user_name = $_POST['new_name'];
                            $user_id = $_POST['user_id'];
                            $findUsername = $conn->query("SELECT * FROM users WHERE username = '$user_name'");

                            if($findUsername->num_rows > 0) {
                              echo"<script language='javascript'>alert('Username is already taken :(!');window.location.href='editProfile.php?edit_ID=$user_id';</script>";
                            }else if(strlen($user_name)<4){
                              echo"<script language='javascript'>alert('Username must be more than 4 characters! :(!');window.location.href='editProfile.php?edit_ID=$user_id';</script>";
                            }else{                              
                              $sql = "UPDATE users SET username='$user_name' WHERE user_id=$user_id;";
                                if($conn->query($sql)===TRUE){
                                  $_SESSION['Succeed']['username']=$user_name;
                                  echo "<script language='javascript'>alert('Username Updated!');window.location.href='profile.php?user_id=$user_id';</script>";
                                }else{
                                  echo "ERROR!:".$conn->error;
                                }              
                            }
                      }
            }#end of username changing
?>                           
          </div>

   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
</body>
</html>