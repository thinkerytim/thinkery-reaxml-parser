<?php

namespace ThinkReaXMLParser\Objects\Listings;

class RentalListing extends Listing
{
    public function __construct(\SimpleXMLElement $xml)
    {
        parent::__construct($xml);
        $this->setIsRental(true);

        if (!in_array($this->getStatus(), $this->inactive)) {
            $this->setPrice((string)$xml->rent);
            if (count($xml->category)) {
                $this->setCategory((string)$xml->category->attributes()->name);
            }
            if (count($xml->rent)) {
                $this->setPaymentFreq((string)$xml->rent->attributes()->period);
                $this->setDisplayPrice((string)$xml->rent->attributes()->display);
            }
            if ($xml->bond) {
                $this->setBond((string) $xml->bond);
            }
            $this->setAvailable((string)$xml->dateAvailable);
        }
    }

    /**
     * @param string $bond
     **/
    public function setBond($bond)
    {
        $this->bond = $bond;
    }

    /**
     * @return string
     **/
    public function getBond()
    {
        return $this->bond;
    }
}
