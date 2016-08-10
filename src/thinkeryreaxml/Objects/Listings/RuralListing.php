<?php

namespace ThinkReaXMLParser\Objects\Listings;

use SimpleXMLElement;

class RuralListing extends Listing
{
    public function __construct(SimpleXMLElement $xml)
    {
        parent::__construct($xml);

        if ($this->getStatus() != 'sold' and $this->getStatus() != 'withdrawn') {
            $this->setCategory((string)$xml->ruralCategory->attributes()->name);
        }
    }
}