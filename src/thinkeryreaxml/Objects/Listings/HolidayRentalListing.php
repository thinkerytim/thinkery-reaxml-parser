<?php

namespace ThinkReaXMLParser\Objects\Listings;

use SimpleXMLElement;

class HolidayRentalListing extends Listing
{
    public function __construct(SimpleXMLElement $xml)
    {
        parent::__construct($xml);
        $this->setIsRental(true);
        if ($this->getStatus() != 'sold' and $this->getStatus() != 'withdrawn') {
            $this->setCategory((string)$xml->holidayCategory->attributes()->name);
        }
    }
}