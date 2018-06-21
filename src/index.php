<?php
// Server saves session data for AT LEAST 1 hour
ini_set('session.gc_mxlifetime', 3600);
// client remembers session id for exactly 1 hour
session_set_cookie_params(3600, '/', null, null, true);
session_start();

require_once 'model/db_functions.php';
require_once 'model/db_connect.php';

//Determine what state we are entering the page in
//First visit? Category search?

//first check if adding item to a cart
//ensure all values there

if(isset($_POST)){
	if(isset($_POST['prodID'])){
		if(isset($_POST['qty'])){
			//everything is set so add to cart
			$productsToAdd = [
								['productID' => $_POST['prodID'],
								'qty' => $_POST['qty'],
								]
							];
			addProductToDB(session_id(), $productsToAdd);
		}
	}
}

if($_GET['meats'] == 'allProducts'){
	$products = getProducts('');
}elseif($_GET['meats'] == 'freshCuts'){
	$products = getProducts('freshCuts');
}elseif($_GET['meats'] == 'sausages'){
	$products = getProducts('sausages');
}else{
	$searchItem = filter_var($_GET['search'], FILTER_SANITIZE_SPECIAL_CHARS);
	if (strtoupper($searchItem) == strtoupper('pork')) {
		$products = getProducts('');
	}
	else {
		$products = getItem($searchItem);
	}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
        <meta charset="utf-8" />
        <title>Berryman Brothers Butcheries</title>
    </head>

    <body>
        <?php require_once 'header.php' ?>
        
        <div id="topOfPage"></div>
		
        <div class="description">
            <table id="mainTable" summary="Products">
			
				<caption><?php 
					if($_GET['meats'] == 'allProducts'){
						print_r("<h2>All Products</h2>");
					}elseif($_GET['meats'] == 'freshCuts'){
						print_r("<h2>Fresh Cuts</h2>");
					}elseif($_GET['meats'] == 'sausages'){
						print_r("<h2>Sausages</h2>");
					}else{
						if (empty($searchItem)) {
							print_r("<h2>All Products</h2>");
						}
						else {
							print_r("<h2>Showing Results for: '" . $searchItem . "' </h2>");
						}
					}
				?></caption>
                <tr>
                    <th>Product Name</th>
                    <th>Weight</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th></th>
                </tr>

                <?php 
                if (empty($products)) {
                    print_r("<div class='emptyResult'><h1>No Results Found</h1><p>Please Check Your Spelling or be More Specific</p></div>");
                }
                foreach ($products as $product) { ?>
                        <tr>
                            <td><?= $product['prod_name']; ?></td>
                            <td><?= $product['prod_weight']; ?></td>
                            <td><?= $product['prod_price']; ?></td>
                            <td><?= $product['prod_description']; ?></td>
                            <td><?= '<img src="'. $product['prod_image'].'"/>'; ?></td>
                            <td><?= $product['cat_name']; ?></td>
                            <td class=spinner>
                                <form action="index.php" method="POST">
                                    <input type="number" min="1" max="50" name="qty" value="1"/>
                                    <input type="hidden" name="prodID" value="<?= $product['prod_id']; ?>"/>
                                    <input type="submit" name="submitbutton" value="Add to cart"/>
                                </form>
                            </td>
                        </tr>
                <?php } ?>

            </table>
        </div>

        <?php require_once 'footer.php' ?>

    </body>
</html>