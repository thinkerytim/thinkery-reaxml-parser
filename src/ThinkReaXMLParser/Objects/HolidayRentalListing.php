<?php

namespace ThinkReaXMLParser\Objects;

use SimpleXMLElement;

class HolidayRentalListing extends Listing
{
    public function __construct(SimpleXMLElement $xml)
    {
        parent::__construct($xml);
        $this->setCategory((string) $xml->holidayCategory->attributes()->name);
    }
}