<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
    <link href="http://localhost/shopping/assets/css/bootstrap.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script>
    function updateCartItem(obj,rowid){
        $.get("<?php echo base_url('cart/updateItemQty/');?>",{rowid:rowid, qty:obj.value},
        function(resp){
            if(resp=='ok')
            {
                location.reload();
            }else{
                alert('cart update failed...');
            }
        });
    }
    </script>
</head>
<body>
   
<div class="container" >    
             <div class="navbar navbar-dark bg-dark">
                <a href="a" class="navbar-brand ">SHOPPING CART</a>
            </div>
    <div class="row cart">
        <table class="table">
          <thead>
              <tr>
                   <th width="10%"></th>
                   <th width="30%">product</th>
                   <th width="15%">price</th>
                   <th width="13%">Quantity</th>
                    <th width="20%">Subtotal</th>
                    <th width="12%"></th>
                </tr>
            </thaed>
            <tbody>
                <?php if ($this->cart->total_items()>0){
                 foreach($cartItems as $item) { ?>
                <tr>
                   <td>
                        <?php $imageURL = !empty($item["image"])?base_url('uploads/product_images/'.$item["image"]):base_url('assets/images/pro-demo-img.jpeg'); ?>
					   <img src="<?php echo $imageURL; ?>" width="50"/>
                    </td>
                    <td><?php echo $item["name"]; ?> </td>
                    <td><?php echo $item["price"]; ?> </td>
                    <td> <input type="number" class="form-control text-centre" value="<?php echo $item["qty"];?>"onchange= "updateCartItem(this,'<?php echo $item["rowid"]; ?>')" > </td>
                    <td> <?php echo '$' .$item["subtotal"] .'USD';?> </td>
                    <td>
                        <a href="<?php echo base_url('cart/removeitem/'.$item["rowid"]); ?>" class="btn btn-danger" 
                        onclick="return confirm('are you sure?')">Delete</a>
                    </td>
                </tr>
                    <?php } } else { ?>
                    <tr> <td colspan="6"> <p>your cart is empty</p> </td>
                    <?php } ?>
            <tbody>
            <tfoot>
                <tr>
                    <td> <a href="<?php echo base_url('products/');?>" class="btn btn-warning"> continue shopping</a></td>
                    <td colspan="3"></td>
                    <?php if ($this->cart->total_items()>0) { ?>
                    <td class="text-left" >grand total: <b> <?php echo '$' .$this->cart->total(). 'usd'; ?> </b> </td>
                    <td> <a href="<?php echo base_url('checkout/');?>"
                    class="btn btn-success btn-block">checkout </a> </td>
                    <?php } ?>
                </tr>
        </tfoot>
        </table>
    </div>
</div>
</body>
</html>