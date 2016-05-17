<?php

namespace ThinkReaXMLParser\Objects;

class ResidentialListing extends Listing
{

    public function import(\SimpleXMLElement $xml)
    {
        // set the property type
        $this->setType('residential');
        
    }
}