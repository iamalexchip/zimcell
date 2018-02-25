<?php

namespace Zerochip;

class ZimCell
{

	public function codesFor($provider)
	{
		$netoneCodes = ['71'];
		$telecelCodes = ['73'];
		$econetCodes = ['77', '78'];

		$codes = [
			'econet' 	=> $econetCodes,
			'ecocash'	=> $econetCodes,
			'telecel'	=> $telecelCodes,
			'telecash'	=> $telecelCodes,
			'netone'	=> $netoneCodes,
			'onemoney'	=> $netoneCodes
		];

		if(!isset($codes[$provider]))
		{
			// unknown provider
			return;
		}
		
		return $codes[$provider];
	}
	
	public function refine($num)
	{
		// remove spacing within number
  		$refinedNum = str_replace(' ', '', $num);

  		// remove the first zero
      	if (substr($refinedNum, 0, 1) == '0'){
      		$refinedNum = str_replace('0', '', $refinedNum);
      	}

      	$f3d = substr($refinedNum, 0, 3);
      	$f4d = substr($refinedNum, 0, 4);

      	// first 3 digits
      	if ($f3d == '263') {
      		$refinedNum = substr($refinedNum, 3);
      	}

      	// first 4 digits
      	if ($f4d == '+263') {
      		$refinedNum = substr($refinedNum, 4);
      	}

      	return $refinedNum;
	}

	public function valid($num)
	{
		$refinedNum = self::refine($num);
		$firstDigit7 = substr($refinedNum, 0) == '7';

		if (!is_numeric($refinedNum) && strlen($refinedNum) != 9 && !$firstDigit7)
		{
			return false;
		}

		return true;
	}

	public function is($provider, $num)
	{
		$f2d = substr(self::refine($num), 0, 2);
		$codes = self::codesFor($provider);

		if(!in_array($f2d, $codes))
		{
			return false;
		}

		return true;
	}

	public function isEconet($num)
	{
		return self::is('econet', $num);
	}

	public function isEcocash($num)
	{
		return self::is('ecocash', $num);
	}

	public function isTelecel($num)
	{
		return self::is('telecel', $num);
	}

	public function isTelecash($num)
	{
		return self::is('telecel', $num);
	}

	public function isNetone($num)
	{
		return self::is('netone', $num);
	}

	public function isOneMoney($num)
	{
		return self::is('onemoney', $num);
	}
}
