<?php

namespace ThinkReaXMLParser\Objects\Listings;

class RentalListing extends Listing
{
    public function __construct(\SimpleXMLElement $xml)
    {
        parent::__construct($xml);

        $this->setPrice((string) $xml->rent);
        $this->setPaymentFreq((string) $xml->rent->attributes()->period);
        $this->setCallForPrice((string) $xml->rent->attributes()->display);
    }
}