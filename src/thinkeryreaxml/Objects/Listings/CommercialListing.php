<?php

namespace ThinkReaXMLParser\Objects\Listings;

use SimpleXMLElement;

class CommercialListing extends Listing
{
    public function __construct(SimpleXMLElement $xml)
    {
        parent::__construct($xml);
        if ($this->getStatus() != 'sold' and $this->getStatus() != 'withdrawn') {
            $this->setCategory((string)$xml->commercialCategory->attributes()->name);
        }
    }
}