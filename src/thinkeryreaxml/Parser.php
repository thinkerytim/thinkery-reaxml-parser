<?php

namespace ThinkReaXMLParser;

use DomDocument;
use ThinkReaXMLParser\Exceptions\FailedToParseFileException;
use ThinkReaXMLParser\Exceptions\InvalidFileException;
use ThinkReaXMLParser\Objects\Listings\BusinessListing;
use ThinkReaXMLParser\Objects\Listings\CommercialLandListing;
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

    protected $listings = [
         'business' => BusinessListing::class,
         'commercialLand' => CommercialLandListing::class,
         'commercial' => CommercialListing::class,
         'holidayRental' => HolidayRentalListing::class,
         'land' => LandListing::class,
         'rental' => RentalListing::class,
         'residential' => ResidentialListing::class,
         'rural' => RuralListing::class,
    ];

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
        $results = [];

        $xml_reader = new XMLReader();

        try {
            $xml_reader->open($this->file);
        } catch (\Exception $e) {
            throw new FailedToParseFileException("Failed to parse file at ".$this->file);
        }

        while ($xml_reader->read()) {
            $type = $xml_reader->localName;
            $listing = !empty($this->listings[$type]) ? $this->listings[$type] : null;

            if ($xml_reader->nodeType == XMLReader::ELEMENT && $listing) {

                /* @var Listing $parser */
                $results[] = new $listing($this->convertToSimpleXMLElement($xml_reader));

            }
        }

        return $results;
    }

    /**
     * @param XMLReader $xml_reader
     * @return \SimpleXMLElement
     */
    protected function convertToSimpleXMLElement(XMLReader $xml_reader)
    {
        $node = $xml_reader->expand();
        $dom = new DomDocument();
        $dom->appendChild($dom->importNode($node, true));

        return simplexml_import_dom($dom);
    }
}
