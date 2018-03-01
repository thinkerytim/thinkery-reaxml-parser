<?php

namespace ThinkReaXMLParser\Objects\Listings;

use SimpleXMLElement;

class HolidayRentalListing extends Listing
{
    public function __construct(SimpleXMLElement $xml, $type = 'holidayRental')
    {
        parent::__construct($xml, $type);
        $this->setIsRental(true);
        if (!in_array($this->getStatus(), $this->inactive)) {
            $this->setCategory((string)$xml->holidayCategory->attributes()->name);
        }
    }
}
