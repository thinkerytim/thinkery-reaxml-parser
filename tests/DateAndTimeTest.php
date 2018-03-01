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
        $date_time_1 = '2009-01-01-12:30:20';
        $result_clean_1 = DateAndTime::cleanDateTime($date_time_1);
        $result_carbon_1 = DateAndTime::parseToCarbon($date_time_1);
        $this->assertInstanceOf(\Carbon\Carbon::class, $result_carbon_1);
        $this->assertSame('2009-01-01 12:30:20', $result_clean_1);
        $this->assertSame('2009-01-01 12:30:20', $result_carbon_1->format('Y-m-d H:i:s'));

        $date_time_2 = '2009-01-01-12:30';
        $result_clean_2 = DateAndTime::cleanDateTime($date_time_2);
        $result_carbon_2 = DateAndTime::parseToCarbon($date_time_2);
        $this->assertInstanceOf(\Carbon\Carbon::class, $result_carbon_2);
        $this->assertSame('2009-01-01 12:30:00', $result_clean_2);
        $this->assertSame('2009-01-01 12:30:00', $result_carbon_2->format('Y-m-d H:i:s'));

        $date_time_3 = '2009-01-01 12:30:20';
        $result_clean_3 = DateAndTime::cleanDateTime($date_time_3);
        $result_carbon_3 = DateAndTime::parseToCarbon($date_time_3);
        $this->assertInstanceOf(\Carbon\Carbon::class, $result_carbon_3);
        $this->assertSame('2009-01-01 12:30:20', $result_clean_3);
        $this->assertSame('2009-01-01 12:30:20', $result_carbon_3->format('Y-m-d H:i:s'));
    }
    
}
