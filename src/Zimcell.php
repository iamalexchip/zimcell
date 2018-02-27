<?php

namespace Zerochip;

/**
 * ZimCell
 *
 * Main Class for the ZimCell package
 */
class Zimcell
{
    /**
     * Gets codes for a provider or service
     *
     * @param string $provider Provider or service name
     *
     * @return array Codes available for that provider or service
     */
    public function codes($provider = null)
    {
        $provider = strtolower($provider);

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

        if (is_null($provider)) {
            return $codes;
        }

        if (!isset($codes[$provider])) {
            return null;
        }

        return $codes[$provider];
    }

    /**
     * Refines a given phone number
     *
     * Spaces, country code(+263, 263), and the leading zero is removed
     *
     * @param string $num Cellnumber
     *
     * @return string The refined phone number
     */
    public function refine($num)
    {
        // remove spacing within number
        $refinedNum = str_replace(' ', '', $num);

        // remove the first zero
        if (substr($refinedNum, 0, 1) == '0') {
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

     /**
     * Converts a cellnumber to international format
     *
     * example: 077123456 to +26377123456
     *
     * @param string $num Cellnumber
     *
     * @return string The cellnumber on international format
     */
    public function intlFormat($num)
    {
        return '+263'.self::refine($num);
    }

    /**
     * Verifys if the cellnumber is valid for Zimbabwe
     *
     * @param string $num Cellnumber
     *
     * @return boolean
     */
    public function valid($num)
    {
        $refinedNum = self::refine($num);
        $firstDigit7 = substr($refinedNum, 0, 1) == '7';

        if (is_numeric($refinedNum) && strlen($refinedNum) == 9 && $firstDigit7) {
            return true;
        }

        return false;
    }

    /**
    * Verifys if a number is valid for a provider or service
    *
    * @param string $provider Provider or service name
    * @param string $num Cellnumber
    *
    * @return boolean | null
    */
    public function is($provider, $num)
    {
        $f2d = substr(self::refine($num), 0, 2);
        $codes = self::codes($provider);

        if(is_null($codes))
        {
            return null;
        }

        if (!in_array($f2d, $codes)) {
            return false;
        }
        
        if (self::valid($num))
        {
            return true;
        }

        return false;
    }

    /**
    * Get the service provider for a cellnumber
    *
    * @param string $num Cellnumber
    *
    * @return string | null
    */
    public function getProvider($num)
    {
        $f2d = substr(self::refine($num), 0, 2);

        foreach (self::codes() as $key => $value) {
            if (in_array($f2d, $value)) {
                if (self::valid($num))
                {
                    return $key;
                }
            }
        }
    }

}
