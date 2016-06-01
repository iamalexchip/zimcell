<?php
 
class numValidator
{

  	public $formatedNum;

 	public function isValid($paymentSys,$phonum)
 	{

 		// format the number entered by the user 
	    $this->formatedNum =$this->formatNum($phonum);

	    // equate $fnum to formated number
	    // to make method code less visually stressing
	    $fnum = $this->formatedNum;

	    # if the length of the string fnum is Ok
	    if ($this->numOk($fnum)){

	    	# $paymentSys is the payment system
	    	switch ($paymentSys) {

	    		case 'ecocash':

	    			return $this->ecocashValid($fnum);

	    		break;

	    		// teleca
	    		case 'telecash':

	    			return $this->telecashValid($fnum);

	    		break;

	    		case 'onewallet':

	    			return $this->onewalletValid($fnum);

	    		break;
	    		
	    		default:

	    			return 'unknown sys';

	    		break;
	    	}

	    } else {

	    	# when the value is not numeric of 9 digits long
	    	return 'num error';

	    }

	}


	/*
	this function formats the phone number string by:
	- removing spaces
	- removing the first number if it is a 0 (zero)
	- removing 263 and +263 if they are the first characters
	# it returns the 
	*/
	public function formatNum($phonum)
	{

		// remove spacing within number
  		$phonum = str_replace(' ', '', $phonum);

  		//remove the first zero
      	if (substr($phonum, 0, 1) == '0'){

      		$phonum = str_replace('0', '', $phonum);  			
      		
      	}

    	#remove 263 or +263 zipcode
      	$zp3 = substr($phonum, 0, 3);
      	$zp4 = substr($phonum, 0, 4);

      	// +263	
      	if ($zp3 == '263'){
      		$phonum = substr($phonum, 3);
      	}
      	// 263
      	if ($zp4 == '+263'){
      			$phonum = substr($phonum, 4);
      	}

      	return $phonum;

	}


	# check if $phonum is numeric and 9 digits long
	public function numOk($phonum){

		if ( strlen($phonum) == 9 && is_numeric($phonum) ) {

			return true;

		}

	}


	# check if valid econet number
	public function ecocashValid($phonum)
	{

		# ftd -> first two digits 
		$ftd = substr($phonum, 0, 2);

		if ($ftd == '77' || $ftd == '78'){

			return true;

		}

	}


	# check if valid telecel number
	public function telecashValid($phonum)
	{
		
		# ftd -> first two digits 
		$ftd = substr($phonum, 0, 2);

		if ($ftd == '73'){

			return true;

		}

	}


	# check if valid netone number
	public function onewalletValid($phonum)
	{

		# ftd -> first two digits 
		$ftd = substr($phonum, 0, 2);

		if ($ftd == '71'){

			return true;

		}

	}
 

}
 
?>