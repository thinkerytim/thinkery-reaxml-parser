<?php

namespace ThinkReaXMLParser\Objects\Listings;

use SimpleXMLElement;

class BusinessListing extends Listing
{
    public function __construct(SimpleXMLElement $xml, $type = 'business')
    {
        parent::__construct($xml, $type);

        if (!in_array($this->getStatus(), $this->inactive)) {
            $this->setCategory((string)$xml->businessCategory->name);
            $this->setAvailable((string)$xml->currentLeaseEndDate);
            $this->setSaleType((string)$xml->commercialListingType->attributes()->value);
            $this->setIncome((int)$xml->takings);
        }
    }
}
