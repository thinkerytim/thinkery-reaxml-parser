<?php

namespace ThinkReaXMLParser\Objects\Listings;

class CommercialLandListing extends CommercialListing
{
    public function __construct(SimpleXMLElement $xml)
    {
        parent::__construct($xml);
    }
}