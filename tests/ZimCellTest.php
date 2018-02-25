<?php

use PHPUnit\Framework\TestCase;

class ZimCellTest extends TestCase
{
	public function testRemoveLeadingZero()
    {
    	$num = Zerochip\ZimCell::refine('077123456');

        $this->assertEquals('77123456', $num);
    }

    public function testRemoveSpaces()
    {
    	$num = Zerochip\ZimCell::refine('077 123 4 5 6');

        $this->assertEquals('77123456', $num);
    }

    public function testRemoveCountryCode1()
    {
    	$num = Zerochip\ZimCell::refine('26377123456');

        $this->assertEquals('77123456', $num);
    }

    public function testRemoveCountryCode2()
    {
    	$num = Zerochip\ZimCell::refine('+26377123456');

        $this->assertEquals('77123456', $num);
    }

    public function testValid()
    {
    	$result = Zerochip\ZimCell::valid('+26377123456');

        $this->assertEquals($result, true);
    }

    public function testIsNetone()
    {
    	$result = Zerochip\ZimCell::isNetone('71123456');

        $this->assertEquals($result, true);
    }

    public function testIsTelecel()
    {
    	$result = Zerochip\ZimCell::isTelecel('73123456');

        $this->assertEquals($result, true);
    }

    public function testIsEconet()
    {
    	$result = Zerochip\ZimCell::isEconet('77123456');

        $this->assertEquals($result, true);
    }


}
