
<?php ob_start(); ?>
<?php include "include\hader.php"?>
<?php include "include\db.php"?>

	<!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

<!-- Header Start -->
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="New/css/home.css" />
    <script src="New/js/home.js"></script>
</head>

<body>

    <!.........................................header start................................................>

    <div class="parallax">
        <div class="page-title">Food Call</div>
    </div>

    <div class="nav" id="nav-bar">
        <ul class="nav-ul">
            <a href="#" class="a-nav">
                <li>Home</li>
            </a>
            <a href="#" class="a-nav">
                <li>Menu</li>
            </a>
            <a href="#" class="a-nav">
                <li>Restuarent</li>
            </a>
            <a href="#" class="a-nav">
                <li>cart</li>
            </a>
            <a href="#" class="a-nav">
                <li>User</li>
            </a>
        </ul>
        <div class="search-box">
            <form>
                <input type="text" placeholder="search..." name="search" class="search-input" />
                <button type="submit"><i class="fa fa-search" ></i></button>
            </form>
        </div>
    </div>
    <!.....................................header end.................................................................>



<!-- Header ends here -->

 

    <!-- Categories Section Begin -->
    
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->

<?php
session_start(); 
if(isset($_POST["add_to_cart"]))
{
	if(isset($_SESSION["shopping_cart"]))
	{
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
		if(!in_array($_GET["id"], $item_array_id))
		{
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
				'item_name'			=>	$_POST["hidden_name"],
				'item_price'		=>	$_POST["hidden_price"],
				'item_quantity'		=>	$_POST["quantity"]
			);
			$_SESSION["shopping_cart"][$count] = $item_array;
		}
		else
		{
			echo '<script>alert("Item Already Added")</script>';
		}
		
	}
	else
	{
		$item_array = array(
			'item_name'			=>	$_POST["hidden_name"],
			'item_price'		=>	$_POST["hidden_price"],
			'item_quantity'		=>	$_POST["quantity"]
		);
		$_SESSION["shopping_cart"][0] = $item_array;
	}
}

if(isset($_GET["action"]))
{
	if($_GET["action"] == "delete")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
			if($values["item_id"] == $_GET["id"])
			{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>alert("Item Removed")</script>';
				echo '<script>window.location="index.php"</script>';
			}
		}
	}
}

?>



    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2 id="shop">Pizza Categories</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
						<li><a href = 'index.php' class='btn btn-primary'>All</a></li>
						<?php
						$query = "SELECT*FROM category";
						$select_category = mysqli_query($con,$query);
						
						while($row = mysqli_fetch_assoc($select_category)){
							$title = $row['category_name'];
							$ID = $row['category_ID'];
							echo "<li ><a href = 'index.php?category=$ID' class='btn btn-primary'>{$title}</a></li>";
						}
						?>
						
						
                         
                            
						
                        </ul>
                    </div>
                </div>
            </div>
			
			
			
			<div class="row featured__filter">
			<?php
			
				if(isset($_GET['category'])){
					
					$post_category_ID = $_GET['category'];
			
				$query = "SELECT*FROM approved_item WHERE category_ID = $post_category_ID ";
				$select_approved_item = mysqli_query($con,$query);
						
				while($row = mysqli_fetch_assoc($select_approved_item)){
					$product_name = $row['product_name'];
					$market_price = $row['market_price'];
					$poduct_image = $row['poduct_image'];
					$category_ID = $row['category_ID'];
					$product_ID = $row['produt_ID'];
					
					
					
	
					
			?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix">
                   <div class="featured__item">
					
							
						
				    <form method="post" action="index.php?action=add&id=<?php echo $row['produt_ID'] ?>">
						<div class="featured__item__pic set-bg" data-setbg="../admin/image/<?php echo$poduct_image?>">
                            <ul class="featured__item__pic__hover">
                            
                    
                    
                            
                                <input type="hidden"  name="hidden_name" value="<?php echo $product_name ?>">
                                <input type="hidden"  name="hidden_price" value="<?php echo $market_price ?>">
                                <input type="text" name="quantity" size ="1" value="1" />
                                <li><input type="submit" name="add_to_cart" class='btn btn-primary' value="ADD TO CART"></li>
                            
															
								
                            </ul>
                        </div>
                        </form>
                        <div class="featured__item__text">
                            
                            <h6><a href="#"><?php echo $product_name ?></a></h6>
                            <h5> RS <?php echo $market_price ?> .00 </h5>
                        </div>
					
				</div>
			</div>
			<?php } 
			
			}else{
				
				$query = "SELECT*FROM approved_item ";
				$select_approved_item = mysqli_query($con,$query);
						
				while($row = mysqli_fetch_assoc($select_approved_item)){
                    $product_name = $row['product_name'];
					$product_ID = $row['produt_ID'];
					$market_price = $row['market_price'];
					$poduct_image = $row['poduct_image'];
					$category_ID = $row['category_ID'];
					
			?>
                <div class="col-lg-3 col-md-4 col-sm-6 mix">
                   <div class="featured__item">
					
							
						
				    <form method="post" action="index.php?id=<?php echo $row['produt_ID'] ?>">
						<div class="featured__item__pic set-bg" data-setbg= "../admin/image/<?php echo$poduct_image?> ">
                            <ul class="featured__item__pic__hover">
                            
                                <input type="hidden"  name="hidden_name" value="<?php echo $product_name ?>">
                                <input type="hidden"  name="hidden_price" value="<?php echo $market_price ?>">
                                <input type="text" name="quantity" size ="1" value="1" />
                                <li><input type="submit" name="add_to_cart"  class='btn btn-primary' value="ADD TO CART"></li>
                            </ul>
                        </div>
                     </form>
                    

                        <div class="featured__item__text">
                            <h6><a href="#"><?php echo $product_name ?></a></h6>
                            <h5> RS <?php echo $market_price ?> .00 </h5>
                        </div>
					
				</div>
			</div>
       
			<?php } 
				
				
				
			}
			
			
			?>
          </div>
		
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="section-title">
                <h2 id="id">Shopping Cart</h2>
            </div>
            <div class="row">
                <div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>RS <?php echo $values["item_price"]; ?></td>
						<td>RS <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						<td><a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">RS <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<?php
					}
					?>
						
				</table>
				<tr> <a href="payment.php" class="btn btn-primary">Pay</a> </tr>
			</div>
            </div>
        </div>
    </div>
	<br>
    <!-- Banner End -->


<!-- Footer Start Here -->
    <footer>

        <div id="footer-followus">
            <p id="foot-follow">Follow Us</p>

            <div id="foot-ssites">
                <a href="#" id="flink"><i id="fp" aria-hidden="true" class="fa fa-instagram" ></i></a>
                <a href="#" id="flink"><i id="fp" aria-hidden="true" class="fa fa-facebook-official" ></i></a>
                <a href="#" id="flink"><i id="fp" aria-hidden="true" class="fa fa-youtube-play" ></i></a>
                <a href="#" id="flink"><i id="fp" aria-hidden="true" class="fa fa-twitter-square" ></i></a>
            </div>
        </div>

        <div id="footer-contactus">
            <p id="foot-follow-q">Got Questions ? Call us!</p>
            <div id="footer-q">

                <p id="pnumber">+94 11 5998877 ,</p>
                <p id="pnumber"> +94 76 5998877</p>
            </div>
            <br>
            <br>

            <p id="pnumber-1">ONLINE FOOD DELIVERY<br>No. 157, S.D.S, Jayasinghe Mawatha, <br>Nugegoda, Sri Lanka</p>

            <p id="pnumber-2">©The ONLINE FOOD DELIVERY ALL RIGHTS RESERVED. CONCEPT, DESIGN & DEVELOPMENT BY SLIITSTUDENTS</p>



        </div>




    </footer>




<!-- Footer Ends Here -->

    <!-- Js Plugins -->
  	<script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>



</body>
