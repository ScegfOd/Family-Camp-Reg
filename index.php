<?php
include '../vars.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">

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
	/*table, td, th {
		border: 1px solid black;
	}*/
	
	table {
		border-collapse: collapse;
		width: 350px;
	}
	
	th {
		height: 50px;
	}
	
	.spacer {
		padding: 2px 10px 2px 10px;
	}
	.vspacer {
		padding: 5px 2px 5px 2px;
	}
	.sp-green {
		background-color: rgb(140, 180, 140);
	}
	a {
		color: rgb(0, 0, 255);
	}
	
	</style>
</head>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<body>
<!--=======register==========================================--->



<!--<section class="section-bg" class="bg-campmap" id="contactus">-->   
	<section class="sp-green" id="reg">  
		
		<div class ="col-lg-12 text-center">
			<p><a class="btn btn-primary btn-lg" 
			href="http://bafcfamilycamp.online/documents/2016 Release and Waver Form.pdf" 
			role="button" target="_blank">Release and Waver Form (must be filled out as a part of registration)</a></p>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="col-lg-4">
					<p style="text-align:left">Camp address:</p>
					<h2 style="text-align:left"><b>Camp Royaneh<br>
					4600 Scanlon Rd<br>
					Cazadero, CA 95421<br>
					</b></h2>
				</div>
				<div class="col-lg-4">
					<p style="text-align:left"><b><?php echo $name_of_price ?></b><br>
					(sign up and pay in full by <?php echo $date_of_price_expiration ?>)<br>
					-Adults (age 17 and up): $<?php echo $adult_fee ?>/day <br>
					-Adolescents (12-16): $<?php echo $adolescent_fee ?>/day<br>
					-Children (age 3-11): $<?php echo $child_fee ?>/day<br>
					-2 and under: Free<br>
					-Family registration fee: $<?php echo $fam_reg_fee ?><br>
					</p>
				</div>
				<div class="col-lg-4">
					<p style="text-align:left"><b>Before filling out this form it is important that you read and review the following documents:</b><br>
					<a href="http://bafcfamilycamp.online/documents/fam camp 16 letter.pdf" target=_blank>-Camp Letter & Information</a><br>
					<a href="http://bafcfamilycamp.online/documents/2016 Release and Waver Form.pdf" target=_blank>-Medical Waver Form</a><br>
					<a href="http://bafcfamilycamp.online/documents/BAFC_Family_Camp_Code_of_Conduct.pdf" target=_blank>-Code of Conduct</a><br>
					</p>
				</div>
			</div>
			<div class="row">
				<p style="text-align:center"><b>Families need only pay for a maximum of 3 school age children.</b> Use the paper registration form if you qualify for this special pricing.</p>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<h1 class="section-heading">
						<b>Registration Form</b>
					</h1>
					<h2 class="section-heading">BAY AREA FAMILY CAMP</h2>
					<h4 class="section-heading">
						<?php 
						echo "$camp_date";
						?>
					</h4>
				</div>
			</div>
		</div>
		
		<div class="container">
			<form action="reg.php" class="form-horizontal" method="post" name="regform" role="form">
				
				<div class="form-group">
					
					<label class="col-lg-2 control-label" for="inputName">Family Name *</label>
					<div class="col-lg-10">
						<input class="form-control" id="inputName" name="inputName" placeholder="Your Last Name" type="text"  required="required"/>
					</div>
					
					<label class="col-lg-2 control-label" for="inputEmail1">Email *</label>
					<div class="col-lg-10">
						<input class="form-control" id="inputEmail" name="inputEmail" placeholder="Your Email" type="text" required="required"/>
					</div>
					
					<label class="col-lg-2 control-label" for="inputPhone">Phone *</label>
					<div class="col-lg-10">
						<input class="form-control" id="inputPhone" name="inputPhone" placeholder="Your Phone" type="text" required="required"/>
					</div>
					
					<label class="col-lg-2 control-label" for="inputAltPhone">Alternate Phone</label>
					<div class="col-lg-10">
						<input class="form-control" id="inputAltPhone" name="inputAltPhone" placeholder="Your Other Phone" type="text"/>
					</div>
					
				</div>
				
<!--Loop area begin-------------------------------------------------------------->
<?php 
$i = 1;
for ($i = 1; $i <= 8; $i++) {
echo '<h4 class="section-heading" style="text-align:center">Person ',$i,'</h4>
				<table>
					<tr>
						<td>
							<label>First Name</label>
							<input id="firstName-',$i,'" name="firstName-',$i,'" placeholder="First Name #',$i,'" type="text"/>
						</td>
						<td class="spacer"></td>
						<td>
							<label>Family Name</label>
							<input id="lastName-',$i,'" name="lastName-',$i,'" placeholder="Family Name (if different)" type="text"/>
						</td>
						<td class="spacer"></td>
						<td>
							<label>Age</label>
							<select id="age-',$i,'" name="age-',$i,'" class="drop_down">
								<option value="baby">Younger than 3</option>
								<option value="child">3 - 11</option>
								<option value="adolescent">12 - 16</option>
								<option value="adult">Older than 16</option>
							</select>
						</td>
						<td class="spacer"></td>
						<td>
							<label>Gender</label>
							<select id="sex-',$i,'" name="sex-',$i,'" class="drop_down">
								<option value="male">Male</option>
								<option value="female">Female</option>
							</select>
						</td>
						<td class="spacer"></td>
						<td>
							<label>Grade</label>
							<select id="grade-',$i,'" name="grade-',$i,'" class="drop_down">
								<option value="preK">PreK</option>
								<option value="1st">1st</option>
								<option value="2nd">2nd</option>
								<option value="3rd">3rd</option>
								<option value="4th">4th</option>
								<option value="5th">5th</option>
								<option value="6th">6th</option>
								<option value="7th">7th</option>
								<option value="8th">8th</option>
								<option value="9th">9th</option>
								<option value="10th">10th</option>
								<option value="11th">11th</option>
								<option value="12th">12th</option>
								<option value="past highschool">Past Highschool</option>
							</select>
						</td>
						<td class="spacer"></td>
						<td>
							<label>Days Attending</label>
							<table>
								<tr>
									<td>
										<input type="checkbox" name="nightsCheckbox',$i,'[]" value="Wed/Thu" />
										<label>Wed/Thu</label>
									</td>
									<td>
										<input type="checkbox" name="nightsCheckbox',$i,'[]" value="Thu/Fri" />
										<label>Thu/Fri</label>
									</td>
									<td>
										<input type="checkbox" name="nightsCheckbox',$i,'[]" value="Fri/Sat" />
										<label>Fri/Sat</label>
									</td>
									<td>
										<input type="checkbox" name="nightsCheckbox',$i,'[]" value="Sat/Sun" />
										<label>Sat/Sun</label>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td colspan = "5">
							<label>Lodging Request</label>
						</td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td colspan="5">
							<input type="radio" name="lodging',$i,'[]" value="Tent" checked />
							<label>Tent</label>
							<input type="radio" name="lodging',$i,'[]" value="RV" />
							<label>RV</label>
							<input type="radio" name="lodging',$i,'[]" value="Tent Cabin" />
							<label>Tent Cabin</label>
							<input type="radio" name="lodging',$i,'[]" value="Cabin" />
							<label>Cabin ($10/night)</label>
							<input type="radio" name="lodging',$i,'[]" value="Bunk House" />
							<label>Bunk House ($15/night)</label>
						</td>
					</tr>
				</table>
				<div class="vspacer"></div>';
}
?>
				<input type="checkbox" name="codeOfConduct" id="codeOfConduct" value="True" required/>
				<label>All members of my family have read and agree with the rules of the camp as laid out in the </label><a href="http://bafcfamilycamp.online/documents/BAFC_Family_Camp_Code_of_Conduct.pdf" target=_blank> Code of Conduct. *</a><br>
				<p>(Remember that all family members 10 and up should sign and turn in a printed copy of the code of conduct)</p>
				<div class="spacer"></div>
				
				<input type="checkbox" name="waiver" id="waiver" value="True" required/>
				<label>I have printed out and filled out the </label><a href="http://bafcfamilycamp.online/documents/2016 Release and Waver Form.pdf" target=_blank> Release and Medical Waver Form. *</a><br>
				
				<div class="vspacer"></div>
				<div class="vspacer"></div>
				<div class="form-group">
					<div class="col-lg-offset-2 col-lg-10">
						<button class="btn btn-info has-spinner" type="submit" data-spinner="right">Submit</button>
					</div>
				</div>
			</form>

			<p>* fields marked with an asterisk are required.</p>
		</div>
	</section>
</body>

</html>
