<?php

namespace ThinkReaXMLParser\Objects\Listings;

class RentalListing extends Listing
{
    public function __construct(\SimpleXMLElement $xml)
    {
        parent::__construct($xml);
        $this->setIsRental(true);

        if (!in_array($status, $this->inactive)) {
            $this->setPrice((string)$xml->rent);
            $this->setCategory((string)$xml->category->attributes()->name);
            $this->setPaymentFreq((string)$xml->rent->attributes()->period);
            $this->setDisplayPrice((string)$xml->rent->attributes()->display);
            $this->setAvailable((string)$xml->dateAvailable);
        }
    }
}
