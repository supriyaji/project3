<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
    <link href="http://localhost/shopping/assets/css/bootstrap.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
    <link href="http://localhost/shopping/assets/css/style.css" rel="stylesheet">
</head>
<body>


<div class="container" >    
<div class="navbar navbar-dark bg-dark">
<a href="a" class="navbar-brand ">PRODUCTS</a>
</div>
        <a href="<?php echo base_url('cart');?>" class="cart-link" title="view cart"> 
        <i class="glyphicon glyphicon-shopping-cart"></i>
         <span>(<?php echo $this->cart->total_items();?>) </span></a>
</div>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
           <?php if(!empty($products))
            {
                foreach($products as $row) {?>
                <div class="col-md-5">
                <div class="col-md-12">
               
				    <div class="thumbnail">
                    <img src="<?php echo base_url('uploads/product_images/'.$row['image']); ?>" />
                        <div class="caption">
                          
                            <h4 class="pull-right">$ <?php echo $row['price'];?> USD</h4>
                            <h4><?php echo $row['name'];?></h4>
                              <p> <?php echo $row['description'];?></p>
                        </div>
                          <div class="atc">
                           <a href="<?php echo base_url('products/addtocart/'.$row['id']);?>"class="btn btn-success">add to cart</a>
                          </div>
                          </div>
                    </div>
                
                </div>
                <?php } } else { ?>
                    <p>product not found</p>
            <?php } ?>
        </div>
    </div>
</div>
 </body>
</html>