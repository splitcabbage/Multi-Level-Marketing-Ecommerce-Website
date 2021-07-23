

<?php
  include('php-includes/connect.php');

  ?>

<?php
function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($con,$str){
	if($str!=''){
		$str=trim($str);
		return mysqli_real_escape_string($con,$str);
	}
}

function get_product($con,$limit='',$cat_id='',$product_id=''){
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products </title>

    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  
    <link rel="stylesheet" href="./css/card.css">   
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="./css/all.css">
    <!-- Custom Style   -->
    <link rel="stylesheet" href="./css/Style.css">

      
        <link rel="stylesheet" href="assets/css/style.css">

       
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body>

    <!-- ----------------------------  navaigation ---------------------------------------------- -->

   
    <!-- ------------x---------------  navaigation --------------------------x------------------- -->

    <main>
         <?php include('php-includes/outerTopMenu.php'); 
        
         
         ?>
         
                <div class="row product-btn justify-content-between mb-40">
                    <div class="properties__button">
                        <!--nava Button  -->
                        <!-- <nav>                                                      
                            <div class="nava nava-tabs" id="nava-tab" role="tablist">
                                <a class="nava-item nava-link active" id="nava-home-tab" data-toggle="tab" href="#nava-home" role="tab" aria-controls="nava-home" aria-selected="true">NewestArrivals</a>
                                <a class="nava-item nava-link" id="nava-profile-tab" data-toggle="tab" href="#nava-profile" role="tab" aria-controls="nava-profile" aria-selected="false"> Price high to low</a>
                                <a class="nava-item nava-link" id="nava-contact-tab" data-toggle="tab" href="#nava-contact" role="tab" aria-controls="nava-contact" aria-selected="false"> Most populer </a>
                            </div>
                        </nav> -->
                        <!--End nava Button  -->
                    </div>
                    <!-- Grid and List view -->
                   
                    <!-- Select items -->
                    <!-- <div class="select-this">
                        <form action="#">
                            <div class="select-itms">
                                <select name="select" id="select1">
                                    <option value="">40 per page</option>
                                    <option value="">50 per page</option>
                                    <option value="">60 per page</option>
                                    <option value="">70 per page</option>
                                </select>
                            </div>
                        </form>
                    </div> -->
                </div>
        
         
        <!-- Latest Products Start -->
        <div class="container">
        <section class="popular-items latest-padding">
            
                <!-- navaa Card -->
                <div class="tab-content" id="nava-tabContent">
                    <!-- card one -->
                    <div class="tab-pane fade show active" id="nava-home" role="tabpanel" aria-labelledby="nava-home-tab">
                        <div class="row">
                            <?php
                                 $get_product = get_product($con);
                                 foreach($get_product as $list){
                            ?>
                            <div class="col-md-4 ">
                                <div class="single-popular-items mb-50 text-center">
                                    
                                    <div class="popular-img">
                                        <a href="product_details.php">
                                            <img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image'] ?>" alt="">
                                        </a>
                                        <div class="img-cap">
                                            <span>Add to cart</span>
                                        </div>
                                        
                                    </div>
                                    <div class="popular-caption">
                                        <h3><a href="product_details.php"><?php echo $list['name'] ?></a></h3>
                                        
                                        <span style="padding=10px;  "> <i class="fa fa-inr"></i> <?php echo $list['price'] ?></span>
                                    </div>
                                </div>
                            </div>
                                 <?php } ?>
                                 </div>
                            </div>
                    
                </div>
                <!-- End nava Card -->
            
        </section>
        </div>
        <!-- Latest Products End -->
        <!--? Shop Method Start-->
        <!-- <div class="shop-method-area">
            <div class="container">
                <div class="method-wrapper">
                    <div class="row d-flex justify-content-between">
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single-method mb-40">
                                <i class="ti-package"></i>
                                <h6>Free Shipping Method</h6>
                                <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                            </div>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single-method mb-40">
                                <i class="ti-unlock"></i>
                                <h6>Secure Payment System</h6>
                                <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                            </div>
                        </div> 
                        <div class="col-xl-4 col-lg-4 col-md-6">
                            <div class="single-method mb-40">
                                <i class="ti-reload"></i>
                                <h6>Secure Payment System</h6>
                                <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Shop Method End-->
    </main>

    <!-- --------------------------- Footer ---------------------------------------- -->

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





