<?php
  include('php-includes/connect.php');

  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MLM</title>
    <link rel="stylesheet" href="./css/card.css">   
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="./css/all.css">
    <!-- Custom Style   -->
    <link rel="stylesheet" href="./css/Style.css">


  <link rel="stylesheet" href="./css/dropdown.css">

</head>

<body>
    <main>
<?php include('php-includes/outerTopMenu.php'); ?>
    <div class="container">
        <br>
        <br>
        <h2 align="center">Select Log In type</h2>
        <hr>
        <br>
        <a href="./afterLogin/admin/index.php">
        <div class="card" >
          <div>Admin</div>
        </div>
    </a>
        <br>
        <a href="./afterLogin/index.php">
        <div class="card">
          <div>User</div>
        </div>
    </a>
        <br>
        <form align="center" class="selfRegistration" method="post" action="loginType.php">
        <button  type="submit" style="background: none; border: none">
        <a style="color: brown; font-size: 17px;text-decoration: none" href="precheckout.php">
      
          <div >New User? Register here.</div>
    
    </a></button>
    </form>
      </div>
</main>

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