<!DOCTYPE html>
<?php

	require('numValidator.php');

	$num = new numValidator();

	if ( isset($_POST['phonum']) && isset($_POST['paymentSys']) ){
	
		$phonum = $_POST['phonum'];
		$paymentSys = $_POST['paymentSys'];
	
	} else {

		$phonum = '00';
		$paymentSys = 'econet';
	
	}

	$slt = 'selected';

	$valid = $num->isvalid($paymentSys, $phonum);

?>
<html>
<head>
	<title></title>
</head>
<body bgcolor="#aaaaaa">

<!--forgive me for the totally ugly code this is a prototype will create proper one-->

	<div align="center"> 

	<h1> Phone number validator </h1>
	
	<form method="POST" action="test.php">

		Phone number :
		<input type="text" name="phonum"
		<?php if (isset($phonum)){ echo 'value="'.$phonum.'"'; } ?>
		>

		<br><br>

		Payment Sys :
		<select name="paymentSys">

			<option value="econet" <?php echo ($paymentSys == 'econet' ? $slt:''); ?>
			>Econet </option>

			<option value="ecocash" <?php echo ($paymentSys == 'ecocash' ? $slt:''); ?>
			> Ecocash </option>

			<option value="telecel" <?php echo ($paymentSys == 'telecel' ? $slt:''); ?>
			> Telecel </option>

			<option value="telecash" <?php echo ($paymentSys == 'telecash' ? $slt:''); ?>
			> Telecash </option>

			<option value="netone" <?php echo ($paymentSys == 'netone' ? $slt:''); ?>
			> Netone </option>

			<option value="onewallet" <?php echo ($paymentSys == 'onewallet' ? $slt:''); ?>
			> Onewallet </option>
			
		</select>

		<br><br>
		<button type="submit"> Post </button>

		<?php echo '<br><h1>'.$paymentSys.'</h1>'; ?>

		<h1>		
		Formated number: <?php echo $num->formatedNum; ?>
		</h1>

		for messages 1 means valid the others are self explanatory

		<h1>
		message : <?php echo ($valid == '' ? 'not valid': $valid); ?>
		</h1>

	</form>

	</div>



</body>
</html>