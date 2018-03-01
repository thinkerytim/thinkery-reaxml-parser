<?php

namespace ThinkReaXMLParser\Objects\Listings;

use SimpleXMLElement;

class LandListing extends Listing
{
    public function __construct(SimpleXMLElement $xml, $type = 'land')
    {
        parent::__construct($xml, $type);

        if (!in_array($this->getStatus(), $this->inactive)) {
            $this->setCategory((string)$xml->landCategory->attributes()->name);
        }
    }
}
