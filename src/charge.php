<?php
require_once 'model/db_functions.php';
require_once 'model/db_connect.php';
require_once('./config.php');
require_once('./email.php');
//require('./PHPMailer/PHPMailerAutoload.php');
// Server saves session data for AT LEAST 1 hour
ini_set('session.gc_mxlifetime', 3600);
// client remembers session id for exactly 1 hour
session_set_cookie_params(3600, '/', null, null, true);
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/style.css">
        <meta charset="utf-8" />
        <title>Berryman Brothers Butcheries</title>
        <style>
            header {
                margin-top: -0.5em;  /* This is required on this page only otherwise the header goes off
                the to of the page for some reason */
            }
			
			.content {
				position: relative;
				margin: 5em auto;
				color: #4CAF50;
				text-align: center;
			}
			
			table {
				margin: 0 auto;
			}
			
			table, th, td {
				border: 1px solid #4CAF50;
				width: 90%;
				border-collapse: collapse;
				padding: 0.5em;
				text-align: left;
			}
			.centered {
				text-align: center;
			}
			
        </style>
    </head>

    <body>
        <?php require_once('header.php'); ?>

        <div id="topOfPage">top of page</div>

        <div class="description">
            <?php
                $token = filter_input(INPUT_POST, 'stripeToken', FILTER_SANITIZE_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, 'stripeEmail', FILTER_VALIDATE_EMAIL);
                $amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_INT);
				$pst = filter_input(INPUT_POST, 'pst', FILTER_VALIDATE_INT);
				$gst = filter_input(INPUT_POST, 'gst', FILTER_VALIDATE_INT);
				$subTotal = filter_input(INPUT_POST, 'subTotal', FILTER_VALIDATE_INT);
				$name = filter_input(INPUT_POST, 'stripeBillingName', FILTER_SANITIZE_STRING);
				
                //$mail = new PHPMailer;
                /* Send Confirmation Email here.
                See https://github.com/PHPMailer/PHPMailer/blob/master/examples/gmail.phps
                as example using Gmail as Mail Server with PHPMailer
                */
                try{
                    $customer = \Stripe\Customer::create(array(
                    'email' => $email,
                    'source' => $token
                    ));
                    $charge = \Stripe\Charge::create(array(
                    'customer' => $customer->id,
                    'amount' => $amount,
                    'currency' => 'cad'
                    ));
                $amount = number_format(($amount / 100), 2);
				$pst = number_format(($pst / 100), 2);
				$gst = number_format(($gst / 100), 2);
				$subTotal = number_format(($subTotal / 100), 2);
				$productsOrdered = getUserCart(session_id());
				
				$receipt = storeOrder(session_id());
                sendConfEmail($email, $amount, $pst, $gst, $subTotal, $productsOrdered, $receipt, $name);
				?>
				<h1>Receipt</h1>
				<?php
				print_r("<p>Successfully Charged $" . $amount . "</p>");
				?>
				
				<table>
					<tr>
						<th>Product Name</th>
						<th>Weight</th>
						<th>Price</th>
						<th>Qty</th>
						<th>Total</th>
					</tr>
				<?php
				//Display the cart to the splash page receipt.
				foreach($productsOrdered as $product) {
					$pricePerItem = floatval(ltrim($product['prod_price'], '$')) * $product['prod_qty'];
					print_r("<tr>");
					print_r("<td>" . $product['prod_name'] . "</td>");
					print_r("<td>" . $product['prod_weight'] . "</td>");
					print_r("<td>" . $product['prod_price'] . "</td>");
					print_r("<td>" .  $product['prod_qty'] . "</td>");
					print_r("<td>$" . number_format($pricePerItem, 2) . "</td>");
					print_r("</tr>");
				}
				print_r("<tr><td colspan='5'> </td></tr>");
				print_r("<tr><td colspan='5' class='centered'>Sub-Total: $" . $subTotal . "</td></tr>");
				print_r("<tr><td colspan='5' class='centered'>GST: $" . $gst . "</td></tr>");
				print_r("<tr><td colspan='5' class='centered'>PST: $" . $pst . "</td></tr>");
				print_r("<tr><td colspan='5' class='centered'>Total: $" . $amount . "</td></tr>");
				
				print_r("</table>");
				print_r("<p>Receipt Number: " . $receipt . "</p>");
                print_r("<h2>Thank You for supporting local farmers here in Victoria :)</h2>");
            }catch(Exception $e){
                http_response_code(500);
                print_r("500 Internal Server Error");
            }
            ?>
        </div>

        <?php require_once('footer.php'); ?>
    </body>
</html>