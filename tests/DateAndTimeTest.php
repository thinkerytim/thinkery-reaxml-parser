<?php
/**
 * thinkery-reaxml-parser
 * @copyright (C) 2018 the Thinkery LLC. All rights reserved.
 * info@thethinkery.net
 * www.thethinkery.net
 */

use ThinkReaXMLParser\Utilities\DateAndTime;

class DateAndTimeTest extends PHPUnit_Framework_TestCase
{

    public function testCleanDateTime()
    {
        $datetime1 = '2009-01-01-12:30:00';
        $this->assertSame('2009-01-01 12:30:00', DateAndTime::cleanDateTime($datetime1));

        $datetime2 = '2009-01-01 12:30:00';
        $this->assertSame('2009-01-01 12:30:00', DateAndTime::cleanDateTime($datetime2));
    }
}
