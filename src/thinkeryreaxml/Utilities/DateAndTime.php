<?php
/**
 * thinkery-reaxml-parser
 * @copyright (C) 2018 the Thinkery LLC. All rights reserved.
 * info@thethinkery.net
 * www.thethinkery.net
 */

namespace ThinkReaXMLParser\Utilities;


class DateAndTime
{
    public static function cleanDateTime($datetimestring)
    {
        $dash_count = substr_count($datetimestring, '-');

        if ($dash_count == 3) {
            $parts = explode('-', $datetimestring);

            $datetimestring = $parts[0] . '-' . $parts[1] . '-' . $parts[2] . ' ' . $parts[3];
        }

        return $datetimestring;
    }
}