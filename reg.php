<?php
include '../vars.php';


/* Set e-mail recipient */
$myemail = "bafcfamilycamponlinereg@gmail.com";

/* Check all form inputs using check_input function this makes it required input */
$name = check_input($_POST['inputName'], "Your Last Name");
$email = check_input($_POST['inputEmail'], "Your E-mail Address");
$phone = check_input($_POST['inputPhone'], "Your Phone");

/*don't forget the Bcc: and/or Cc:*/
$headers .= "Cc: $email" . "\r\n";

$altPhone = $_POST['inputAltPhone'];
if("" == $altPhone){
	$altPhone = "None given";
}

/*$timedate = check_input($_POST['inputTimedate'], "Time and Date");*/
/*$subject = check_input($_POST['inputSubject'], "Message Subject");*/
/*$message = check_input($_POST['inputMessage'], "Your Message");*/
/*$consultation = $_POST['inputConsultation'];/*this is NOT required input*/
$codeOfConduct = $_POST['codeOfConduct'];
$waiver = $_POST['waiver'];

/* Error messages for invalid email as well as legal requirements */
if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)){
	show_error("Invalid e-mail address");
}
if (!$codeOfConduct){
	show_error("You must agree to the Code of Conduct (and check the checkbox)");
}
if (!$waiver){
	show_error("You must fill out the Release and Medical Waver Form (and check the checkbox)");
}


/* Let's prepare the top of the message for the e-mail */

$subject = "Family Camp Registration for the $name family";

$message = "

Family Name: $name
Email: $email
Phone: $phone
Alternate Phone: $altPhone

Camper list:
\tfamily name,\tfirst name;\tgender;\tage group;\tgrade level in fall;\n\tfee\n\tdays attending;

";


/* campers */
$cabinFee = 0;
$firstNames = array("","","","","","","","","");
$prices = array("baby"=>0, "child"=>$child_fee, "adolescent"=>$adolescent_fee, "adult"=>$adult_fee);

for ($i = 1, $j = 0; ($firstNames[$j] = $_POST["firstName-$i"]) != ""; $i++, $j++) {
	if (($lastNames[$j] = $_POST["lastName-$i"]) == ""){
		$lastNames[$j] = $name;
	}
	$sexes[$j] = $_POST["sex-$i"];
	$grades[$j] = $_POST["grade-$i"];
	
	$nights[$j] = "";
	if (($numNights=(count($allDays = $_POST["nightsCheckbox$i"]))) >0){
		foreach($allDays as $a){
			$nights[$j] = "{$nights[$j]}{$a} ";
		}
	}
	else{
		show_error("All registered attendees must sign up for at least one night");
		break;
	}
	
	
	if (($ages[$j] = $_POST["age-$i"]) != "baby"){
		$charges[$j] = $prices[$ages[$j]] * $numNights;
		
		$cabinType[$j] = $_POST["lodging$i"];
		
		if ("Cabin" == $cabinType[$j]){
			//$cabinType = "Cabin (w/ electricity and nearby port-a-potty -- \${$cabin_pp_pn_fee}/night/person)";
			$charges[$j] += $cabin_pp_pn_fee * $numNights;
		} elseif ("Bunk House" == $cabinType[$j]){
			//$cabinType = "Bunk House (w/ electricity and real bathroom -- \${$bunkhouse_pp_pn_fee}/night/person)";
			$charges[$j] += $bunkhouse_pp_pn_fee * $numNights;
		}
	}
	else{
		$charges[$j] = 0;
	}
	$paypal["Camper number $i fee: \$"] = $charges[$j];
}

/* Let's finish the message for the e-mail */
for ($i = 0; $firstNames[$i] != ""; $i++){
	$message = "{$message}\n\t{$lastNames[$i]},\t{$firstNames[$i]};\t{$sexes[$i]};\t{$ages[$i]};\t{$grades[$i]};\n\t\${$charges[$i]}\n\t{$nights[$i]} spent in a(n) {$cabinType[$j]}\n";
}
$message = "{$message}\n\nFamily Registration Fee: \${$fam_reg_fee}";
$totalFees = $fam_reg_fee;
foreach ($charges as $a){
	$totalFees += $a;
}
$message = "{$message}\n\nTotal Fees: \${$totalFees}";
$paypal["Family registration fee: \$"] = $fam_reg_fee;
$paypal["Total fees: \$"] = $totalFees;

/* Send th0e message using mail() function */
mail($myemail, $subject, $message, $headers);

/* Functions we used */
function check_input($data, $problem='')
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
if ($problem && strlen($data) == 0)
{
show_error($problem);
}
return $data;
}

function show_error($myError)
{
?>
<html>
<head>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
</head>
<body>

<div class="jumbotron text-center">
<p>Please correct the following error:</p>
<p><strong><?php echo $myError; ?></strong></p>
<p>Hit the back button and try again</p>
</div><!-- jumbotron-->

    <!-- jQuery -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>
</body>
</html>
<?php
exit();
}
?>


<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta content="family, camp" name="keywords" />
	
	<!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="../css/bootstrap.css" type="text/css">
	
	<!-- Custom CSS -->
	<link rel="stylesheet" href="../css/creative.css" type="text/css">
	
	<style>
	.sp-green {
		background-color: rgb(140, 180, 140);
	}
	</style>
	<title>thanks for registering</title>
</head>

<body class="sp-green">
	<section>
		<div class="container">
			<h2>
			Registration message sent.<br>
			You can pay in person (by check) or online with this button:<br>
			</h2>
			
			<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="business" value="bafcoffice@gmail.com">
				<input type="hidden" name="currency_code" value="USD">
				<input type="hidden" name="amount" value="<?=$totalFees ?>">
				<input type="hidden" name="tax_rate" value="3">
				<input type="hidden" name="item_name" value="<?=$name ?>">
				<input type="hidden" name="notify_url" value="bafcfamilycamponlinereg@gmail.com">
				<input type="hidden" name="bn" value="ScegfOd_BuyNow_WPS_US">
				<input type="image" src="https://www.paypalobjects.com/webstatic/en_US/btn/btn_paynow_107x26.png" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
			</form>
			
			<p>
				<b>Itemized list of fees:</b><br>
			<?php 
			foreach($paypal as $x => $x_value) {
				echo "{$x}{$x_value}<br>";
			}
			?>
			</p>


		</div>
	</section>
</body>

</html>
