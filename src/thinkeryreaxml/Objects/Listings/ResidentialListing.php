<?php

namespace ThinkReaXMLParser\Objects\Listings;

use SimpleXMLElement;

class ResidentialListing extends Listing
{
    public function __construct(SimpleXMLElement $xml, $type = 'residential')
    {
        parent::__construct($xml, $type);

        if (!in_array($this->getStatus(), $this->inactive)) {
            $this->setCategory((string)$xml->category->attributes()->name);
        }
    }
}
