<?php

namespace ThinkReaXMLParser\Objects\Listings;

use SimpleXMLElement;

class BusinessListing extends Listing
{
    public function __construct(SimpleXMLElement $xml)
    {
        parent::__construct($xml);
        $this->setCategory((string) $xml->businessCategory->name);
        $this->setAvailable((string) $xml->currentLeaseEndDate);
    }
}