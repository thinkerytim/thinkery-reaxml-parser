<?php
require_once('vendor/autoload.php');

use ThinkReaXMLParser\Parser;

$xml_file = "/media/tim/3d3a70c6-f02e-4451-8a28-c0b32c3c8495/Sites/JOOMLA35/importer/data/test.xml";

$parser = new Parser($xml_file);

$data = $parser->parse();

var_dump($data);

