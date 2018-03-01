<?php

namespace ThinkReaXMLParser\Objects\Listings;

class CommercialLandListing extends CommercialListing
{
    public function __construct(SimpleXMLElement $xml, $type = 'commercialLand')
    {
        parent::__construct($xml, $type);
    }
}