<?php

namespace ThinkReaXMLParser\Objects;

use SimpleXMLElement;

class RuralListing extends Listing
{
    public function __construct(SimpleXMLElement $xml)
    {
        parent::__construct($xml);
        $this->setCategory((string) $xml->ruralCategory->attributes()->name);
    }
}