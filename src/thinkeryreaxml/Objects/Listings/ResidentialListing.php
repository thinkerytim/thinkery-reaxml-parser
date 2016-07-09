<?php

namespace ThinkReaXMLParser\Objects\Listings;

use SimpleXMLElement;

class ResidentialListing extends Listing
{
    public function __construct(SimpleXMLElement $xml)
    {
        parent::__construct($xml);
        $this->setType('residential');

        if ($this->getStatus() != 'sold' and $this->getStatus() != 'withdrawn') {
            $this->setCategory((string)$xml->category->attributes()->name);
        }
    }
}