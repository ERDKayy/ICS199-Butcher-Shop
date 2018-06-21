<?php 
	function sendConfEmail($email, $amount, $pst, $gst, $subTotal, $productsOrdered, $receipt, $name) {
		/**
		 * This example shows settings to use when sending via Google's Gmail servers.
		 */
		//SMTP needs accurate times, and the PHP time zone MUST be set
		//This should be done in your php.ini, but this is how to do it if you don't have access to that
		date_default_timezone_set('America/Vancouver');
		require_once 'vendor/autoload.php';
		//Create a new PHPMailer instance
		$mail = new PHPMailer;
		//Tell PHPMailer to use SMTP
		$mail->isSMTP();
		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;
		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';
		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6
		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;
		$mail->IsHTML(true);
		
		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';
		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;
		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "grp04.ics199@gmail.com";
		//Password to use for SMTP authentication
		$mail->Password = "Password199";
		//Set who the message is to be sent from
		$mail->setFrom('grp04.ics199@gmail.com');
		//Set an alternative reply-to address
		//$mail->addReplyTo('replyto@example.com', 'First Last');
		//Set who the message is to be sent to
		$mail->addAddress($email);
		//Set the subject line
		$mail->Subject = 'Berryman Brothers Purchase Confirmation Email';
		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
		//Replace the plain text body with one created manually
		$mail->Body = 
				
				'<h1>Receipt</h1>' .
				
				'<p>Hey ' . $name . ',</p><br>' .
				'<p>You Were Successfully Charged $' . $amount . ' for your Order!</p>' .
			

				'<table>
					<tr>
						<th>Product Name</th>
						<th>Weight</th>
						<th>Price</th>
						<th>Qty</th>
						<th>Total</th>
					</tr>' ;
				
				//Display the cart to the splash page receipt.
				foreach($productsOrdered as $product) {
					$pricePerItem = floatval(ltrim($product['prod_price'], '$')) * $product['prod_qty'];
					$mail->Body .=	"<tr>" .
					"<td>" . $product['prod_name'] . "</td>" .
					"<td>" . $product['prod_weight'] . "</td>" .
					"<td>" . $product['prod_price'] . "</td>" .
					"<td>" .  $product['prod_qty'] . "</td>" .
					"<td>$" . number_format($pricePerItem, 2) . "</td>" .
					"</tr>";
				}
				$mail->Body .= "<tr><td colspan='5'> </td></tr>" .
				"<tr><td colspan='5'> </td></tr>" .
				"<tr><td colspan='5'> </td></tr>" .
				"<tr><td colspan='5'> </td></tr>" .
				"<tr><td colspan='5' class='centered'>Sub-Total: $" . $subTotal . "</td></tr>" .
				"<tr><td colspan='5' class='centered'>GST: $" . $gst . "</td></tr>" .
				"<tr><td colspan='5' class='centered'>PST: $" . $pst . "</td></tr>" .
				"<tr><td colspan='5' class='centered'>Total: $" . $amount . "</td></tr>" .
				
				"</table>" .
				"<p>Receipt Number: " . $receipt . "</p>" .
            
			'<h2>Thank You for supporting local farmers here in Victoria :)</h2>';

	
		//Attach an image file
		//$mail->addAttachment('images/phpmailer_mini.png');
		//send the message, check for errors
		if (!$mail->send()) {
            echo "Oops, something went wrong with your email :(  Your purchase was still processed.  Feel free to contact us by phone or email.";
        } else {
			echo "A confirmation email was sent to " . $email . "!  We will contact you when your order is ready.";
		}
	}
	?>