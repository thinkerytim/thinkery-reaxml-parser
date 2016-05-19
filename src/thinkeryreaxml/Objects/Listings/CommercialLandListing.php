<?php

namespace ThinkReaXMLParser\Objects\Listings;

use SimpleXMLElement;

class CommercialLandListing extends Listing
{
    public function __construct(SimpleXMLElement $xml)
    {
        parent::__construct($xml);
        $this->setCategory((string) $xml->landCategory->attributes()->name);
    }
}