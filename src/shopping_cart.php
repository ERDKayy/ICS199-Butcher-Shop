<?php
// Server saves session data for AT LEAST 1 hour
ini_set('session.gc_mxlifetime', 3600);
// client remembers session id for exactly 1 hour
session_set_cookie_params(3600, '/', null, null, true);
session_start();
require_once 'model/db_functions.php';
require_once 'model/db_connect.php';
require_once('./config.php');

if(isset($_POST)){
	if(isset($_POST['prodID'])){
		if(isset($_POST['qty'])){
			//everything is set so add to cart
			$productsToRemove = [
								['productID' => $_POST['prodID'],
								'qty' => $_POST['qty'],
								]
							];
			removeProductFromDB(session_id(), $productsToRemove);
		}
	} else if(isset($_GET['decision'])){
		if($_GET['decision'] == "yes"){
			clearCart(session_id());
		}
	}
}

$products = getUserCart(session_id());
?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
        <meta charset="utf-8" />
        <title>Berryman Brothers Butcheries</title>

        <style>
            #popup {
                display: none;
                margin: 2em auto;
                width: 20em;
                text-align: center;
                position: relative;
                background-color: bisque;
                margin: auto;
                padding: 0;
                border: 1px solid #888;
                width: 60%;
            }
            #calculatedCostTable{
                margin:0 auto;
                text-align: right;
            }
            
            #calculatedCostTable td{
                padding: 0.25em;
            }

            #total {
                font-weight: bold;
            }
            
            #clearCartButton{
                margin: 1em;
                padding: 0.5em;
                background-color: red;
                color: white;
                border-radius: 10px;
                cursor: pointer;
            }

        </style>
    </head>

    <body>
        <?php require_once 'header.php' ?>
        <div id="topOfPage"></div>

        <div class="description">
            <table id="mainTable" summary="Products">
                <tr>
                    <th>Product Name</th>
                    <th>Weight</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th></th>
                </tr>

            <?php 
                foreach ($products as $product) { ?>
                    <?php $pricePerItem = floatval(ltrim($product['prod_price'], '$')) * $product['prod_qty']; ?>
                        <tr>
                            <td><?= $product['prod_name']; ?></td>
                            <td><?= $product['prod_weight']; ?></td>
                            <td><?= $product['prod_price']; ?></td>
                            <td><?= '<img src="'. $product['prod_image'].'"/>'; ?></td>
                            <td><?= $product['prod_qty']; ?></td>
                            <td><?= '$' . number_format($pricePerItem, 2);?></td>
                            <td>		
                                <form action="shopping_cart.php" method="POST">
                                    <input type="number" min="1" max="<?= $product['prod_qty']; ?>" name="qty" value="1"/>
                                    <input type="hidden" name="prodID" value="<?= $product['prod_id']; ?>"/>
                                    <input type="submit" name="submitbutton" value="Remove from cart"/>
                                </form>
                            </td>
                        </tr>
                <?php } ?>
            </table>
            
            <div id="calculatedCost">
                <table id="calculatedCostTable">
                    <tr id=subTotal>
                        <td>Sub-Total</td>
                        <td>
                            <?php 
                                    $cartSubTotal = 0;
                                    foreach($products as $product) { ?>
                                        <?php $pricePerItem2 = floatval(ltrim($product['prod_price'], '$')) * $product['prod_qty'];
                                            $cartSubTotal += $pricePerItem2; ?>
                                    <?php } ?>
                                <?php echo('$' . number_format($cartSubTotal, 2)); ?>
                        </td>
                    </tr>
                    <tr id="gst">
                        <td>GST</td>
                        <td>
                            <?php
                                $GSTRATE = 0.05; //No GST on consumables
                                $GST = $cartSubTotal * $GSTRATE;
                                echo('$' . number_format($GST, 2));
                            ?>
                        </td>
                    </tr>
                    <tr id="pst">
                        <td>PST</td>
                        <td>
                            <?php
                                $PSTRATE = 0.07; //No PST on consumables
                                $PST = $cartSubTotal * $PSTRATE;
                                print_r('$' . number_format($PST, 2));
                            ?>
                        </td>
                    </tr>
                    <tr id="total">
                        <td>TOTAL</td>
                        <td>
                            <?php 
                                $cartTotal = $cartSubTotal + $GST + $PST;
                                print_r('$' . number_format($cartTotal, 2)); 
                            ?> 
                        </td>
                    </tr>
                </table>
                
                <?php
                    if(empty($products)){
                        $isHidden = 'hide';
                    }
                    else{
                        $isHidden = 'show';
                    }?>
                <form id="<?= $isHidden;?>"  action="charge.php" method="post">
                  <script id="<?= $isHidden;?>" src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                          data-key="<?php echo $stripe['publishable_key']; ?>"
                          data-description="Payment Checkout"
                          data-amount="<?= $cartTotal * 100; ?>"
                          data-currency="cad"
                          data-locale="auto"
                          data-billing-address="true"></script>
                    <input id="<?= $isHidden;?>" type="hidden" name="amount" value="<?= $cartTotal * 100; ?>"/>
					<input id="<?= $isHidden;?>" type="hidden" name="pst" value="<?= $PST * 100 ?>"/>
					<input id="<?= $isHidden;?>" type="hidden" name="gst" value="<?= $GST * 100 ?>"/>
					<input id="<?= $isHidden;?>" type="hidden" name="subTotal" value="<?= $cartSubTotal * 100 ?>"/>
                </form>
            </div>
            
            <button id="clearCartButton" type="submit">Clear Cart</button>
            
        </div>
        
        <div id="popup">
            <form action="shopping_cart.php" method="get">
                <p>Are you sure you want to clear your cart?</p>
                <button id="yesBtn" type="submit" name="decision" value="yes">Yes</button>
                <button id="noBtn" type="submit" name="decision" value="no">No</button>
            </form>
        </div>
        
        <script>
            var popup = document.getElementById('popup');
            var openbtn = document.getElementById('clearCartButton');
            var closebtn = document.getElementById('noBtn');
            
            document.addEventListener('click', handleClicks, false);
            
            function handleClicks(e) {
                if (e.target == openbtn) {
                    popup.style.display = "block";
                } else {
                    popup.style.display = "none";
                }
            }
        </script>

        <?php require_once 'footer.php' ?>
    </body>
</html>