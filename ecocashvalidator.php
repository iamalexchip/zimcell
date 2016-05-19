<?php
 
class EcoCashValidator
{
  public $prov;
 
  public function isvalid($phonum)
  {
  	///<< Alter ration of phone number>>///
  	// remove spacing within number
  		$phonum = str_replace(' ', '', $phonum);

  	//remove the zero
      		if (substr($phonum, 0, 1) == '0'){

      			$phonum = str_replace('0', '', $phonum);  			
      		}

    //remove 263 or +263 zipcode
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

     //>>

  	//check if string is a number and of proper length 
      if (is_numeric($phonum) && strlen($phonum) == 9){
  
      	//check if econet phone number
      		if (substr($phonum, 0, 2) == 77 || substr($phonum, 0, 2) == 78){
      			
      			return 'N:'.$phonum.'<br>yep';
 
      		}else{

      			return 'N:'.$phonum.'<br>not a valid econet number';
      		}

      }else{
      //	
      	return 'N:'.$phonum.'<br>not a valid econet number';
      }
  }

}
 
?>