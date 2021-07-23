<?php
    include('php-includes/connect.php');
?>


<?php

$product_id = '';

   
if(isset($_GET["product_id"]))
{
    $product_id = $_GET["product_id"];
   
    
}


function get_safe_value($con,$str){
	if($str!=''){
		$str=trim($str);
		return mysqli_real_escape_string($con,$str);
	}
}

function get_product($con,$product_id='',$cat_id='',$limit=''){
	$sql="select products.* from products where products.status=1";
	if($cat_id!=''){
		$sql.=" and products.category_id=$cat_id ";
	}
	if($product_id!=''){
		$sql.=" and products.id=$product_id ";
	}
	
	$sql.=" order by products.id desc";
	if($limit!=''){
		$sql.=" limit $limit";
	}
	
	$res=mysqli_query($con,$sql);
	$data=array();
	while($row = mysqli_fetch_assoc($res)){
		$data[]=$row;
	}
	return $data;
}


function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Product Details</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <!-- CSS here -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/flaticon.css">
        <link rel="stylesheet" href="assets/css/slicknav.css">
        <link rel="stylesheet" href="assets/css/animate.min.css">
        <link rel="stylesheet" href="assets/css/magnific-popup.css">
        <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
        <link rel="stylesheet" href="assets/css/themify-icons.css">
        <link rel="stylesheet" href="assets/css/slick.css">
        <link rel="stylesheet" href="assets/css/nice-select.css">
        <link rel="stylesheet" href="assets/css/style.css">


        <link rel="stylesheet" href="./css/all.css">
    
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- --------- Owl-Carousel ------------------->
    <link rel="stylesheet" href="./css/owl.theme.default.min.css">

    <!-- ------------ AOS Library ------------------------- -->
    <link rel="stylesheet" href="./css/aos.css">

    <!-- Custom Style   -->
    <link rel="stylesheet" href="./css/Style.css">
    <link rel="stylesheet" href="./css/dropdown.css">

</head>
    

<body>
    
<?php include('php-includes/outerTopMenu.php'); ?>

    <main>
                            <?php
                                 
                                 $get_product = get_product($con, $product_id );
                                 foreach($get_product as $list){
                            ?>
                            
        <br>
            <div class="container" style="margin: auto;width: 50%;padding: 10px;">
            <div class="row justify-content-center">
                <div class="col-lg-10"> 
                <h2>
                        <?php
                            echo $list['name'];
                        ?>
                    </h2>
                    <br>
                    <div class="single_product_img">
                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image'] ?>" alt="#" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-8">
               
                    
                    <div align="center" class="card_area">
                    
                   
                        

                            <form align="center"  method="post" action="">


                                <div style="margin: auto;width: 50%;padding: 10px;"  class="numbers-row">
                                    <p>Quantity</p>
                                    <input class="product_count_item input-number" type="text" value="1" min="0" max="10">
                                </div> 
                        
                              
                            </form>





                            <p>
                            <i class="fa fa-inr"></i> 
                            <?php
                                echo $list['price'];
                            ?>
                            </p>

                        </div>
                        
                        <div style="margin: auto;width: 50%;padding: 10px;" class="add_to_cart">
                             <a href="#" class="btn btn-primary">add to cart</a>
                        </div>
                    </div>
                    <h3 align="center">
                        <?php
                            echo $list['short_descrip'];
                        ?>
                    </h3>

                        <hr>
                            <p align="center">
                        <?php
                            echo $list['descrip'];
                        ?>
                        </p>
                    
                
                </div>
            </div>
            </div>
   
        <?php
                                 }
        ?>
        <!--================End Single Product Area =================-->
       
      
    </main>
   
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
            <h4  class="text-gray">
                Copyright ©2020 | made by Abhilekh
            </h4>
        </div>
        <div class="move-up">
            <span><i class="fas fa-arrow-circle-up fa-2x"></i></span>
        </div>
    </footer>
    <!-- JS here -->

    <script src="./js/Jquery3.4.1.min.js"></script>

    <!-- --------- Owl-Carousel js ------------------->
    <script src="./js/owl.carousel.min.js"></script>

    <!-- ------------ AOS js Library  ------------------------- -->
    <script src="./js/aos.js"></script>

    <!-- Custom Javascript file -->
    <script src="./js/main.js"></script>

    <script>
        $(function() {

            $(".numbers-row").append('<div class="inc button">+</div><div class="dec button">-</div>');

            $(".button").on("click", function() {

            var $button = $(this);
            var oldValue = $button.parent().find("input").val();

            if ($button.text() == "+") {
                var newVal = parseFloat(oldValue) + 1;
                } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
                } else {
                newVal = 0;
                }
                }

            $button.parent().find("input").val(newVal);

            });

        });

</script>

</body>

</html>