<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body bgcolor="#CCCC22">
<div align="center">
<?php
/*variables in Url//
phonum // the phone number
confm // number confirmation by user
*/

if ($_GET['checkout'] == null){
 header('Location: index.php');
}

if (isset($_GET['checkout'])){
	
	$go = 1;
	$chkid = $_GET['checkout'];
	$err ='no';
	}

	if ($go = 1){
	//<<< CHECK OUT ID IS AVALABLE

		$allgud = 0;
		//<START/if CONFIRMED chech if number submited and is econet num
		
		if ( isset($_POST['phonum']) ){
		
		            $phonum = $_POST['phonum'];

					//<remove first zero and spaces in the number

					str_replace(' ', '', $phonum);

					if (substr($phonum, 0, 1) == '0'){
						$phonum = substr($phonum, 1);
					}
					//>
		
				    $ecode = substr($phonum, 0, 2);

					if (is_numeric($phonum)){

						if (strlen($phonum) == 9){

							if ($ecode == '77'){
						//THIS IS AN ECONET PHONUM THEREFORE	
								$allgud = 1;

							}
						}	
					}

		}//>>

	


		function confirmNum() {

			global $phonum, $chkid;
			echo '<h1> Confirm your phone number </h1>';
			echo '<h3>'.'0'.$phonum.'</h3>';
			echo '<form method="post" action="ecocash.merchant.php?confm=yes&checkout='.$chkid.'">';
			echo '<input type="hidden" name="phonum" value="'.$phonum.'">';		
			echo '<button type="submit">Confirm</button>';
			echo '</form>';

			echo '<form method="post" action="ecocash.merchant.php?edit=yes&checkout='.$chkid.'">';
			echo '<input type="hidden" name="phonum" value="'.$phonum.'">';
			echo '<button type="submit">Change</button>';
			echo '</form>'; 
			echo $_GET['confm'];
	
		}

		function submitNum() {

			global $phonum, $chkid, $err;
			//Check if the erro should be shown
			if ( isset($_GET['err'])){
				echo '<font color="red">'.
				'the number is so not econety'.
				'</font>';
			}

			echo '<h1> Enter Your phone number</h1>';
			echo 'eg. 0771000011<br>';
			echo '<form method="post" action="ecocash.merchant.php?confm=no&checkout='.$chkid.'">';
			echo  '<input type="text" name="phonum" value="'.$phonum.'"> ';
			echo '<br><br>'.'<button type="submit">Submit</button>';
			echo '</form>';

			//< Button to show when user wants to cancel edit
			
			if (isset($_GET['edit'])){
			echo '<form method="post" action="ecocash.merchant.php?confm=no&checkout='.$chkid.'">';
			echo '<input type="hidden" name="phonum" value="'.$phonum.'"></input>';
			echo '<br><br>'.'<button type="submit">Cancel</button>';
			echo '</form>';
			}
			//>
		}

		function confimed(){

			global $phonum, $chkid;
			echo 'yo num has been confirmd<br>';
			echo '<h1>'.$phonum.'</h1>';
		}


			if (isset($_GET['confm'])){
				
				$confm = $_GET['confm'];

				if ($confm == 'no'&& $allgud == 1){

					confirmNum();

				}elseif($allgud == 0){
					
					header('Location: ecocash.merchant.php?err=yes&checkout='.$chkid);
				
				}elseif($confm == 'yes'){
					
					confimed();
				}

			}else{
				submitNum();
			}
	}
 

 //>>>

?>
</div>
</body>
</html>