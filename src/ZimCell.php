<?php

namespace Zerochip;

/**
 * ZimCell
 *
 * Main Class for the ZimCell package
 */
class ZimCell
{
    /**
     * Gets codes for a provider or service
     *
     * @param string $provider Provider or service name
     *
     * @throws Exception
     *
     * @return array Codes available for that provider or service
     */
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

        if (!isset($codes[$provider])) {
            throw new Exception("Unknown provider or service");
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
     * Verifys if the cellnumber is valid for Zimbabwe
     *
     * @param string $num Cellnumber
     *
     * @return string The refined phone number
     */
    public function valid($num)
    {
        $refinedNum = self::refine($num);
        $firstDigit7 = substr($refinedNum, 0) == '7';

        if (!is_numeric($refinedNum) && strlen($refinedNum) != 9 && !$firstDigit7) {
            return false;
        }

        return true;
    }

    /**
    * Verifys if a number is valid for a provider or service
    *
    * @param string $provider Provider or service name
    * @param string $num Cellnumber
    *
    * @return boolean
    */
    public function is($provider, $num)
    {
        $f2d = substr(self::refine($num), 0, 2);
        $codes = self::codesFor($provider);

        if (!in_array($f2d, $codes)) {
            return false;
        }

        return true;
    }

    /**
     * Verifys if a cellnumber is a valid for econet
     *
     * @param string $num Cellnumber
     *
     * @return boolean
     */
    public function isEconet($num)
    {
        return self::is('econet', $num);
    }

    /**
     * Verifys if a cellnumber is a valid for ecocash
     *
     * @param string $num Cellnumber
     *
     * @return boolean
     */
    public function isEcocash($num)
    {
        return self::is('ecocash', $num);
    }

    /**
     * Verifys if a cellnumber is a valid for telecel
     *
     * @param string $num Cellnumber
     *
     * @return boolean
     */
    public function isTelecel($num)
    {
        return self::is('telecel', $num);
    }

    /**
     * Verifys if a cellnumber is a valid for telecash
     *
     * @param string $num Cellnumber
     *
     * @return boolean
     */
    public function isTelecash($num)
    {
        return self::is('telecel', $num);
    }

    /**
     * Verifys if a cellnumber is a valid for netone
     *
     * @param string $num Cellnumber
     *
     * @return boolean
     */
    public function isNetone($num)
    {
        return self::is('netone', $num);
    }

    /**
     * Verifys if a cellnumber is a valid for onemoney
     *
     * @param string $num Cellnumber
     *
     * @return boolean
     */
    public function isOneMoney($num)
    {
        return self::is('onemoney', $num);
    }
}
