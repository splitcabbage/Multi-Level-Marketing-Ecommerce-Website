<?php
  include('php-includes/connect.php');

  ?>
  <?php
  //User cliced on join
  if(isset($_GET['send_message'])){
    
     // $pin = mysqli_real_escape_string($con,$_GET['pin']);
     $name = mysqli_real_escape_string($con, $_GET['name']);
      $email = mysqli_real_escape_string($con,$_GET['email']);
      $mobile = mysqli_real_escape_string($con,$_GET['mobile']);
      $message = mysqli_real_escape_string($con,$_GET['message']);
      $date = date("Y-m-d");
    //   $side = mysqli_real_escape_string($con,$_GET['side']);
    //   $downPosition = mysqli_real_escape_string($con,$_GET['downPosition']);
    //   $direct_down_count = mysqli_real_escape_string($con, $_GET['directDownCount']);
      $password = "123456";
      
      $flag = 0;
      
      if($name!='' && $email!='' && $mobile!='' && $message!='' ){
          //User filled all the fields.
              if(email_check($email)){
                  //Email is ok
                      
                          $flag=1;

              }
              else{
                  //check email
                  echo '<script>alert("Please wait till your last message is acknowledged.");</script>';
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

        //Update directDownCount
        
         
          $query = mysqli_query($con,"insert into contact_us(`name`, `email`, `mobile`,`comment`, `added_on`) values('$name','$email','$mobile','$message','$date')");
          
          echo mysqli_error($con);
          
          echo '<script>alert("Message Sent !");</script>';
      }
      
  }

  function email_check($email){
    global $con;
    
    $query =mysqli_query($con,"select * from contact_us where email='$email'");
    if(mysqli_num_rows($query)>0){
        return false;
    }
    else{
        return true;
    }
}
  ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MLM</title>
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="./css/all.css">
    <!-- Custom Style   -->
    <link rel="stylesheet" href="./css/Style.css">


  <link rel="stylesheet" href="./css/dropdown.css">


  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.css" rel="stylesheet">


</head>

<body>
<?php include('php-includes/outerTopMenu.php'); ?>


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

<div class="col-xl-6 col-lg-12 col-md-9">

<div class="card o-hidden border-0 shadow-lg my-5" >
<div class="card-body p-0" style="border:2px solid orange; border-radius:10px;">
  <!-- Nested Row within Card Body -->
  <div class="row">



      <!-- Page Heading -->
      <br>
      <div class="col-lg-12">
            <div class="p-5">
      <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Contact Lira</h1>
              </div>
     
        <!-- <div class="col-lg-4"></div> -->
        <div class="col-lg-8">
            <form method="get">
                <!-- <div class="form-group">
                    <label>Pin</label>
                    <input type="text" name="pin" class="form-control" >
                </div> -->
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="text" name="mobile" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Message</label>
                    <textarea type="text" name="message" class="form-control" required></textarea>

                </div>
               
                
                <div align="center" class="form-group">
                    <input type="submit" name="send_message" class="btn btn-primary" value="Send Message">
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


</div>
<!-- End of Content Wrapper -->

</div>
<br>
<br>
<br>
      <footer class="footer">
        <div class="container">
            <div class="about-us" data-aos="fade-right" data-aos-delay="200">
                <h2>About us</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium quia atque nemo ad modi officiis
                    iure, autem nulla tenetur repellendus.</p>
            </div>
           
            <div class="follow" data-aos="fade-left" data-aos-delay="200">
                <h2>Follow us</h2>
                <p>Let us be Social</p>
                <div>
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-youtube"></i>
                </div>
            </div>
        </div>
        <div class="rights flex-row">
            <h4 class="text-gray">
                Copyright ©2020 | made by Abhilekh
            </h4>
        </div>
        <div class="move-up">
            <span><i class="fas fa-arrow-circle-up fa-2x"></i></span>
        </div>
    </footer>

    <script src="./js/Jquery3.4.1.min.js"></script>

<!-- --------- Owl-Carousel js ------------------->
<script src="./js/owl.carousel.min.js"></script>

<!-- ------------ AOS js Library  ------------------------- -->
<script src="./js/aos.js"></script>

<!-- Custom Javascript file -->
<script src="./js/main.js"></script>

</body>
</html>













































