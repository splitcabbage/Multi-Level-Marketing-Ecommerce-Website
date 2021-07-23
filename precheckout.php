<?php
  include('php-includes/connect.php');
  include('php-includes/check-login.php');

  ?>
  <?php
  //User cliced on join
  if(isset($_GET['pay700'])){
    

     $email = mysqli_real_escape_string($con,$_GET['email']);
     $mobile = mysqli_real_escape_string($con,$_GET['mobile']);
    

     $flag = 0;
     
     if($email!='' && $mobile!=''){
         //User filled all the fields.
             if(email_check($email)){
              
                         $flag=1;
                     
     
             }
             else{
                 //check email
                 echo '<script>alert("This user id already availble.");</script>';
             }
         
         
     }
     else{
         //check all fields are fill
         echo '<script>alert("Please fill all the fields.");</script>';
     }
     
     //Now we are heree
     //It means all the information is correct
     //Now we will save all the information
     if($flag==1){
      
    
    
     
      header('location: https://www.payumoney.com/paybypayumoney/#/6775F263A7F575B32D589E0559ACB7F8');


    
 
        
      }
      
  
}
  ?><!--/join user-->
  <?php 

  function email_check($email){
      global $con;
      
      $query =mysqli_query($con,"select * from user where email='$email'");
      if(mysqli_num_rows($query)>0){
          return false;
      }
      else{
          return true;
      }
  }
//   function side_check($email,$side){
//       global $con;
      
//       $query =mysqli_query($con,"select * from tree where userid='$email'");
//       $result = mysqli_fetch_array($query);
//       $side_value = $result[$side];
//       if($side_value==''){
//           return true;
//       }
//       else{
//           return false;
//       }
//   }

  ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Pay and Join Lira</title>
<link rel = "icon" href =  
    "assets/liraLogo.png" 
        type = "image/x-icon">
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
   
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

     
  
    <!-- Main Content -->
    <div id="content">

        <!-- Begin Page Content -->
        <div align="center" class="container-fluid">


        <div class="row justify-content-center">

<div class="col-xl-6 col-lg-6 col-md-9">

  <div class="card o-hidden border-0 shadow-lg my-5" >
    <div class="card-body p-0" style="border:2px solid orange; border-radius:10px;">
      <!-- Nested Row within Card Body -->
      <div class="row">
   


          <!-- Page Heading -->
          <br>
          <div class="col-lg-12">
                <div class="p-5">
          <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">New User Registration</h1>
                  </div>
         
            <!-- <div class="col-lg-4"></div> -->
            <div class="col-lg-8">
                <form method="get">
                    <!-- <div class="form-group">
                        <label>Pin</label>
                        <input type="text" name="pin" class="form-control" >
                    </div> -->
                    
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Mobile</label>
                        <input type="text" name="mobile" class="form-control" required>
                    </div>
                    
                    
                    <div align="center" class="form-group">
                       
                       
                        <input type="submit" name="pay700" class="btn btn-primary" value="Pay Rs 700 and Join">

                    </div>
                   
                    
                    <div align="center" class="form-group">
                        <button type="submit" name="logout" class="btn btn-primary" ><a href="back.php" style="text-decoration: none; color: white">Back</a></button>
                    </div>

                </form>

               
            </div>
            <div class="col-lg-4"></div>
        </div>
        </div>
        </div>  
        </div>
    </div>
    </div>
    </div>
        </div>
        <!-- /.container-fluid -->
        

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->


      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
