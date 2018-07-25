<?php
/**
 * thinkery-reaxml-parser
 * @copyright (C) 2018 the Thinkery LLC. All rights reserved.
 * info@thethinkery.net
 * www.thethinkery.net
 */

namespace ThinkReaXMLParser\Utilities;


use Carbon\Carbon;

class DateAndTime
{
    const FIXES = [
        '2009-01-01-12:30:20' => [
            'match' => '/^\d{4}-\d{2}-\d{2}-\d{2}:\d{2}:\d{2}$/',
            'replace' => '/(\d{4}-\d{2}-\d{2})(-)(\d{2}:\d{2}:\d{2})/',
            'replacement' => '$1 $3',
        ],

        '2009-01-01 12:30' => [
            'match' => '/^\d{4}-\d{2}-\d{2}[-| ]\d{2}:\d{2}$/',
            'replace' => '/(\d{4}-\d{2}-\d{2})(-| )(\d{2}:\d{2})/',
            'replacement' => '$1 $3:00',
        ],
    ];

    /**
     * @param $date_time_string
     * @return null|string
     */
    public static function cleanDateTime($date_time_string)
    {

        foreach (self::FIXES as $fix) {
            if (preg_match($fix['match'], $date_time_string))
                $date_time_string = preg_replace($fix['replace'], $fix['replacement'], $date_time_string);
        }

        return $date_time_string;

    }

    /**
     * @param $date_time_string
     * @return Carbon
     */
    public static function parseToCarbon($date_time_string)
    {

        return Carbon::parse(self::cleanDateTime($date_time_string));

    }
}