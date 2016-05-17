#Thinkery ReaXML Parser for PHP

This is a simple set of classes to parse a ReaXML formatted XML file into usable PHP objects.

## Installation
composer require thinkerytim/thinkery-reaxml-parser

##Usage
    require_once('vendor/autoload.php');
    use ThinkReaXMLParser\Parser;
    $parser = new Parser($full_path_to_xml_file);
    $data = $parser->parse();
    foreach ($data as $listing) {
        echo $listing->getUniqueId();
    }
## Contributing
1. Fork it
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request

##License
This software is released under the Apache v2.0 License:
http://www.apache.org/licenses/LICENSE-2.0

##Copyright
Copyright (c) 2016 by The Thinkery LLC. All rights reserved.
www.thethinkery.net