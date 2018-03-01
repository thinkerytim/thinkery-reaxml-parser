<?php

namespace ThinkReaXMLParser;

use DOMDocument;
use ThinkReaXMLParser\Exceptions\FailedToParseFileException;
use ThinkReaXMLParser\Exceptions\InvalidFileException;
use ThinkReaXMLParser\Objects\Listings\CommercialListing;
use ThinkReaXMLParser\Objects\Listings\HolidayRentalListing;
use ThinkReaXMLParser\Objects\Listings\LandListing;
use ThinkReaXMLParser\Objects\Listings\Listing;
use ThinkReaXMLParser\Objects\Listings\RentalListing;
use ThinkReaXMLParser\Objects\Listings\ResidentialListing;
use ThinkReaXMLParser\Objects\Listings\RuralListing;
use XMLReader;

class Parser
{
    protected $file;

    /**
     * Parser constructor.
     * @param $file
     * @throws \Exception
     */
    public function __construct($file)
    {
        if (!is_file($file)) {
            throw new InvalidFileException("Invalid file: ".$file);
        }

        $this->file = $file;
    }

    /**
     * @return array
     * @throws FailedToParseFileException
     */
    public function parse()
    {
        /*
         * ReaXML Feed schema and information from http://reaxml.realestate.com.au/propertyList.dtd
         * and http://reaxml.realestate.com.au/docs/reaxml1-xml-format.html
         */
        $property_classes = ["business", "commercial", "commercialLand", "land", "rental", "holidayRental", "residential", "rural"];
        $results = [];

        $xmlreader = new XMLReader();
        try {
            $xmlreader->open($this->file);
        } catch (\Exception $e) {
            throw new FailedToParseFileException("Failed to parse file at ".$this->file);
        }

        while ($xmlreader->read()) {
            if ($xmlreader->nodeType == XMLReader::ELEMENT and in_array($xmlreader->localName, $property_classes)) {
                $node = $xmlreader->expand();
                $dom = new DomDocument();
                $n = $dom->importNode($node, true);
                $dom->appendChild($n);
                $xml = simplexml_import_dom($n);

                switch ($type = $xmlreader->localName) {
                    // business
                    case 'business':
                        $parser = BusinessListing::class;
                        break;
                    // commercial
                    case 'commercial':
                        $parser = CommercialListing::class;
                        break;
                    // commercial land
                    case 'commercialLand':
                        $parser = CommercialLandListing::class;
                        break;
                    // residential land
                    case 'land':
                        $parser = LandListing::class;
                        break;
                    // rental
                    case 'rental':
                        $parser = RentalListing::class;
                        break;
                    // holiday rental
                    case 'holidayRental':
                        $parser = HolidayRentalListing::class;
                        break;
                    // residential
                    case 'residential':
                        $parser = ResidentialListing::class;
                        break;
                    // rural
                    case 'rural':
                        $parser = RuralListing::class;
                        break;
                }

                /* @var Listing $parser */
                $results[] = new $parser($xml, $type);

                unset($node);
                unset($dom);
                unset($xml);
            }
        }

        return $results;
    }
}
