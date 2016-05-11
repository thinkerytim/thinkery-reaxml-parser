<?php

namespace ThinkReaXMLParser;

use DOMDocument;
use ThinkReaXMLParser\Objects\CommercialListing;
use ThinkReaXMLParser\Objects\HolidayRentalListing;
use ThinkReaXMLParser\Objects\LandListing;
use ThinkReaXMLParser\Objects\Listing;
use ThinkReaXMLParser\Objects\RentalListing;
use ThinkReaXMLParser\Objects\ResidentialListing;
use ThinkReaXMLParser\Objects\RuralListing;
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
            throw new \Exception("Invalid file");
        }

        $this->file = $file;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function parse()
    {
        /*
         * XML Feed schema and information from http://reaxml.realestate.com.au/propertyList.dtd
         * and http://reaxml.realestate.com.au/docs/reaxml1-xml-format.html
         */
        $property_classes = ["commercial", "land", "rental", "holidayRental", "residential", "rural"];
        $results = [];

        $xmlreader = new XMLReader();
        try {
            $xmlreader->open($this->file);
        } catch (\Exception $e) {
            throw new \Exception("Failed to parse XML");
        }
        while ($xmlreader->read()) {
            if ($xmlreader->nodeType == XMLReader::ELEMENT and in_array($xmlreader->localName, $property_classes)) {
                $node = $xmlreader->expand();
                $dom = new DomDocument();
                $n = $dom->importNode($node, true);
                $dom->appendChild($n);
                $xml = simplexml_import_dom($n);

                switch ($xmlreader->localName) {
                    case 'commercial':
                        $parser = CommercialListing::class;
                        break;
                    case 'land':
                        $parser = LandListing::class;
                        break;
                    case 'rental':
                        $parser = RentalListing::class;
                        break;
                    case 'holidayRental':
                        $parser = HolidayRentalListing::class;
                        break;
                    case 'residential':
                        $parser = ResidentialListing::class;
                        break;
                    case 'rural':
                        $parser = RuralListing::class;
                        break;
                }

                /* @var Listing $parser */
                $results[] = new $parser($xml);
            }
            unset($node);
            unset($dom);
            unset($xml);
        }
        return $results;

    }
}