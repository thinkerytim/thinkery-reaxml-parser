<?php

namespace ThinkReaXMLParser\Objects\Listings;

use SimpleXMLElement;

class CommercialListing extends Listing
{
    public function __construct(SimpleXMLElement $xml, $type = 'commercial')
    {
        parent::__construct($xml, $type);

        if (!in_array($this->getStatus(), $this->inactive)) {
            $this->setCategory((string)$xml->commercialCategory->attributes()->name);
        }
    }
}
