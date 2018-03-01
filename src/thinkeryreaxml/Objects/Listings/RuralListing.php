<?php

namespace ThinkReaXMLParser\Objects\Listings;

use SimpleXMLElement;

class RuralListing extends Listing
{
    public function __construct(SimpleXMLElement $xml, $type = 'rural')
    {
        parent::__construct($xml, $type);

        if (!in_array($this->getStatus(), $this->inactive)) {
            $this->setCategory((string)$xml->ruralCategory->attributes()->name);
        }
    }
}
