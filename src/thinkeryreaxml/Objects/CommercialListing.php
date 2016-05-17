<?php

namespace ThinkReaXMLParser\Objects;

use SimpleXMLElement;

class CommercialListing extends Listing
{
    public function __construct(SimpleXMLElement $xml)
    {
        parent::__construct($xml);
        $this->setCategory((string) $xml->commercialCategory->attributes()->name);
    }
}