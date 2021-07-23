<?php
  include('php-includes/connect.php');
  include('php-includes/check-login.php');
  if($_SESSION['paid']){

  }
  else{
    header('location: Index.php');
  }

  $capping = 50000;
  ?>
  <?php
  //User cliced on join
  if(isset($_GET['pay700'])){
    
    // $pin = mysqli_real_escape_string($con,$_GET['pin']);
    $name = mysqli_real_escape_string($con, $_GET['name']);
     $email = mysqli_real_escape_string($con,$_GET['email']);
     $mobile = mysqli_real_escape_string($con,$_GET['mobile']);
     $address = mysqli_real_escape_string($con,$_GET['address']);
     $account = mysqli_real_escape_string($con,$_GET['account']);
     $ifsc = mysqli_real_escape_string($con,$_GET['ifsc']);
     $under_userid = mysqli_real_escape_string($con,$_GET['under_userid']);
   //   $side = mysqli_real_escape_string($con,$_GET['side']);
   //   $downPosition = mysqli_real_escape_string($con,$_GET['downPosition']);
   //   $direct_down_count = mysqli_real_escape_string($con, $_GET['directDownCount']);
     $password = mysqli_real_escape_string($con,$_GET['password']);
     
     $flag = 0;
     
     if($name!='' && $email!='' && $mobile!='' && $address!='' && $account!='' && $ifsc!=''){
         //User filled all the fields.
             if(email_check($email)){
                 //Email is ok
                 if(!email_check($under_userid)){
                     
                     //Under userid is ok
                     
                         $flag=1;
                     
                     
                 }
                 else{
                    if($under_userid == ''){
                      $flag = 1;
                    }
                    else{
                     echo '<script>alert("Invalid Under userid.");</script>';
                    } 
                   }
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
      
      //payu


                  $MERCHANT_KEY = "gtKFFx"; 
                  $SALT = "eCwWELxi";
                  $hash_string = '';
                  //$PAYU_BASE_URL = "https://secure.payu.in";
                  $PAYU_BASE_URL = "https://test.payu.in";
                  $action = '';
                  $posted = array();
                  if(!empty($_POST)) {
                    foreach($_POST as $key => $value) {    
                      $posted[$key] = $value; 
                    }
                  }
                  $formError = 0;
                  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
                  $posted['txnid']=$txnid;
                  $posted['amount']=700;
                  $posted['firstname']=$name;
                  $posted['email']=$email;
                  $posted['phone']=$mobile;
                  $posted['productinfo']="productinfo";
                  $posted['key']=$MERCHANT_KEY ;
                  $hash = '';
                  $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
                  if(empty($posted['hash']) && sizeof($posted) > 0) {
                    if(
                            empty($posted['key'])
                            || empty($posted['txnid'])
                            || empty($posted['amount'])
                            || empty($posted['firstname'])
                            || empty($posted['email'])
                            || empty($posted['phone'])
                            || empty($posted['productinfo'])
                          
                    ) {
                      $formError = 1;
                    } else {    
                    $hashVarsSeq = explode('|', $hashSequence);
                    foreach($hashVarsSeq as $hash_var) {
                        $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
                        $hash_string .= '|';
                      }
                      $hash_string .= $SALT;
                      $hash = strtolower(hash('sha512', $hash_string));
                      $action = $PAYU_BASE_URL . '/_payment';
                    }
                  } elseif(!empty($posted['hash'])) {
                    $hash = $posted['hash'];
                    $action = $PAYU_BASE_URL . '/_payment';
                  }


                  $formHtml ='<form method="post" name="payuForm" id="payuForm" action="'.$action.'">
                  <input type="hidden" name="key" value="'.$MERCHANT_KEY.'" />
                  <input type="hidden" name="hash" value="'.$hash.'"/>
                  <input type="hidden" name="txnid" value="'.$posted['txnid'].'" />
                  <input name="amount" type="hidden" value="'.$posted['amount'].'" />
                  <input type="hidden" name="firstname" id="firstname" value="'.$posted['firstname'].'" />
                  <input type="hidden" name="email" id="email" value="'.$posted['email'].'" />
                  <input type="hidden" name="phone" value="'.$posted['phone'].'" />
                  <textarea name="productinfo" style="display:none;">'.$posted['productinfo'].'</textarea><input type="hidden" name="surl" value="http://localhost/demoMlm/payU/payment_complete.php" />
                  <input type="hidden" name="furl" value="http://localhost/demoMlm/payU/payment_fail.php"/><input type="submit" style="display:none;"/>
                  </form>';
                  echo $formHtml;
                  echo '<script>document.getElementById("payuForm").submit();</script>';


  //if successful Payment

      
	$q = mysqli_query($con,"select * from tree where userid='$under_userid'");
  $r = mysqli_fetch_array($q);
  $temp_down_count = $r['directDownCount'];
  $current_temp_down_count = $temp_down_count + 1 ;
 
  mysqli_query($con,"update tree set directDownCount ='$current_temp_down_count' where userid='$under_userid'");
   
  
    
    //Insert into User profile
   // $total_downCount = '1count' + '2count' + '3count' + '4count' + '5count';

    $query = mysqli_query($con,"insert into user(`name`,`email`,`password`,`mobile`,`address`,`account`,`under_userid`,`ifsc`) values('$name','$email','$password','$mobile','$address','$account','$under_userid','$ifsc')");

    //Insert into Tree
    //So that later on we can view tree.
    $query = mysqli_query($con,"insert into tree(`userid`) values('$email')");
    
    //Insert to side
 //   $query = mysqli_query($con,"update tree set `$downPosition`='$email' where userid='$under_userid'");
//      $query = mysqli_query($con,"update tree set totalDownCount='$total_downCount' where userid='$userid'");
    
    //Update pin status to close
   // $query = mysqli_query($con,"update pin_list set status='close' where pin='$pin'");
    
    //Insert into Icome
    $query = mysqli_query($con,"insert into income (`userid`) values('$email')");
    echo mysqli_error($con);
    //This is the main part to join a user\
    //If you will do any mistake here. Then the site will not work.
    
    //Update count and Income.
    $temp_under_userid = $under_userid;
    //$temp_down_count = 'directDownCount'; //leftcount or rightcount
    if($temp_under_userid!=""){
      $qer = mysqli_query($con, "select * from income where userid='$temp_under_userid'");
      $income_data = mysqli_fetch_array($qer);
//      $income_data = income($temp_under_userid);
      //check capping
      //$income_data['day_bal'];
      if($income_data['day_bal']<$capping){

        $new_day_bal = $income_data['day_bal'] + 250;
        $new_current_bal = $income_data['current_bal'] + 250;
        $new_total_bal = $income_data['total_bal'] + 250;
          
          //update income
        mysqli_query($con,"update income set day_bal='$new_day_bal', current_bal='$new_current_bal', total_bal='$new_total_bal' where userid='$temp_under_userid' ");	
      }
    }
    //Total count is below by 1 so increment it outside loop
    $q = mysqli_query($con,"select * from tree where userid='$temp_under_userid'");
     $r = mysqli_fetch_array($q);
     $temp_down_count = $r['totalDownCount'];
     $current_temp_down_count = $temp_down_count + 1 ;
     mysqli_query($con,"update tree set totalDownCount ='$current_temp_down_count' where userid='$temp_under_userid'");
    
    //Traversing the tree through userids
    $next_under_userid = getUnderId($temp_under_userid);
     $temp_under_userid = $next_under_userid;	
     
   
    $total_count=1;
    $i=1;
    $j = 1;
    while($total_count>0){
        $i;
        $j++ ;
        $q = mysqli_query($con,"select * from tree where userid='$temp_under_userid'");
        $r = mysqli_fetch_array($q);
        $temp_down_count = $r['totalDownCount'];
        $current_temp_down_count = $temp_down_count + 1 ;
        $temp_under_userid;
        $temp_down_count;
        mysqli_query($con,"update tree set totalDownCount ='$current_temp_down_count' where userid='$temp_under_userid'");

        //income
        


        //income
        if($temp_under_userid!="" && $j == 2){
            $qer = mysqli_query($con, "select * from income where userid='$temp_under_userid'");
            $income_data = mysqli_fetch_array($qer);
      //      $income_data = income($temp_under_userid);
            //check capping
            //$income_data['day_bal'];
            if($income_data['day_bal']<$capping){

              $new_day_bal = $income_data['day_bal'] + 50;
              $new_current_bal = $income_data['current_bal'] + 50;
              $new_total_bal = $income_data['total_bal'] + 50;
                
                //update income
              mysqli_query($con,"update income set day_bal='$new_day_bal', current_bal='$new_current_bal', total_bal='$new_total_bal' where userid='$temp_under_userid' ");	
                  
            
    
                  }
           
        }
        if($temp_under_userid!="" && $j == 3){
          $qer = mysqli_query($con, "select * from income where userid='$temp_under_userid'");
          $income_data = mysqli_fetch_array($qer);
    //      $income_data = income($temp_under_userid);
          //check capping
          //$income_data['day_bal'];
          if($income_data['day_bal']<$capping){

            $new_day_bal = $income_data['day_bal'] + 10;
            $new_current_bal = $income_data['current_bal'] + 10;
            $new_total_bal = $income_data['total_bal'] + 10;
              
              //update income
            mysqli_query($con,"update income set day_bal='$new_day_bal', current_bal='$new_current_bal', total_bal='$new_total_bal' where userid='$temp_under_userid' ");	
                
          
  
                }
         
      }
        //Traversing the tree through userids
         //change under_userid
         $next_under_userid = getUnderId($temp_under_userid);
        //  $temp_downPosition = getUnderIdPlace($temp_under_userid);
        // $temp_down_count = $temp_downPosition.'count';
         $temp_under_userid = $next_under_userid;	
         
         $i++;
        
        
        //Check for the last user
        if($temp_under_userid==""){
            $total_count=0;
        }
        
    }//Loop
    
    
    
    
    echo mysqli_error($con);
    
    echo '<script>alert("Testing success.");</script>';


        
      }
      
  
}
  ?><!--/join user-->
  <?php 
  //functions
  function pin_check($pin, $under_userid){
      global $con,$userid;
      
      $query =mysqli_query($con,"select * from pin_list where pin='$pin' and userid='$under_userid' and status='open'");
      if($pin == ''){
        echo '<script>alert("You are added under no user .");</script>';
        return true;
      }
      else{
      if(mysqli_num_rows($query)>0){
          return true;
      }
      else{
          return false;
      }
      }
  }
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

  function income($userid){
      global $con;
      $data = array();
      $query = mysqli_query($con,"select * from income where userid='$userid'");
      $result = mysqli_fetch_array($query);
      $data['day_bal'] = $result['day_bal'];
      $data['current_bal'] = $result['current_bal'];
      $data['total_bal'] = $result['total_bal'];
      
      return $data;
  }

function tree($userid){
    global $con;
    $data = array();
    $query = mysqli_query($con,"select * from tree where userid='$userid'");
    $result = mysqli_fetch_array($query);
  
    $data['directDownCount'] = $result['directDownCount'];
    $data['totalDownCount'] = $result['totalDownCount'];
    
    return $data;
}
  function getUnderId($userid){
      global $con;
      $query = mysqli_query($con,"select * from user where email='$userid'");
      $result = mysqli_fetch_array($query);
      return $result['under_userid'];
  }
//   function getUnderIdPlace($userid){
//       global $con;
//       $query = mysqli_query($con,"select * from user where email='$userid'");
//       $result = mysqli_fetch_array($query);
//       return $result['side'];
//   }
// function getUnderIdPlace($userid){
//     global $con;
//     $query = mysqli_query($con,"select * from user where email='$userid'");
//     $result = mysqli_fetch_array($query);
//     return $result['downPosition'];
// }

  ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Demo MLM Website Join</title>

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
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Account</label>
                        <input type="text" name="account" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>IFSC</label>
                        <input type="text" name="ifsc" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Under User Id</label>
                        <input type="text" name="under_userid" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" id="myInput"  required>
                        <input type="checkbox" onclick="myFunction()">Show Password

                    </div>
                    <div align="center" class="form-group">
                       
                        <input type="submit" name="pay700" class="btn btn-primary" value="Pay Rs 700 and Join">

                    </div>
                   
                    
                    <div align="center" class="form-group">
                        <button type="submit" name="logout" class="btn btn-primary" ><a href="back.php" style="text-decoration: none; color: white">Back</a></button>
                    </div>

                </form>

                <script>
                    function myFunction() {
                      var x = document.getElementById("myInput");
                      if (x.type === "password") {
                        x.type = "text";
                      } else {
                        x.type = "password";
                      }
                    }
                </script>
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
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Abhilekh 2020</span>
          </div>
        </div>
      </footer>
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
