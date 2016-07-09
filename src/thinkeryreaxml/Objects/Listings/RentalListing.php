<?php

namespace ThinkReaXMLParser\Objects\Listings;

class RentalListing extends Listing
{
    public function __construct(\SimpleXMLElement $xml)
    {
        parent::__construct($xml);

        if ($this->getStatus() != 'sold' and $this->getStatus() != 'withdrawn') {
            $this->setPrice((string) $xml->rent);
            $this->setIsRental(true);
            $this->setCategory((string) $xml->category->attributes()->name);
            $this->setPaymentFreq((string) $xml->rent->attributes()->period);
            $this->setPriceView((string) $xml->rent->attributes()->display);
            $this->setAvailable((string) $xml->dateAvailable);
        }
    }
}