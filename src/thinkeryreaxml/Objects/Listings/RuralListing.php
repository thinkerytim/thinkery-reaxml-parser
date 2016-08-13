<?php

namespace ThinkReaXMLParser\Objects\Listings;

use SimpleXMLElement;

class RuralListing extends Listing
{
    public function __construct(SimpleXMLElement $xml)
    {
        parent::__construct($xml);

        if (!in_array($status, $this->inactive)) {
            $this->setCategory((string)$xml->ruralCategory->attributes()->name);
        }
    }
}
