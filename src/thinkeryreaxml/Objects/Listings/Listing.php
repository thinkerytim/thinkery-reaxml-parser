<?php

namespace ThinkReaXMLParser\Objects\Listings;

use Carbon\Carbon;
use SimpleXMLElement;
use ThinkReaXMLParser\Objects\Address;
use ThinkReaXMLParser\Objects\Detail;
use ThinkReaXMLParser\Objects\ImageObject;
use ThinkReaXMLParser\Objects\InspectionTime;
use ThinkReaXMLParser\Objects\ListingAgent;
use ThinkReaXMLParser\Objects\Media;
use ThinkReaXMLParser\Utilities\DateAndTime;

abstract class Listing
{
    protected $agentId;
    protected $agents;
    protected $unique_id;
    protected $type;
    protected $sale_type;
    protected $category;
    protected $payment_freq;
    protected $listing_office;
    protected $title;
    protected $municipality;
    protected $short_description;
    protected $description;
    protected $terms;
    protected $price;
    protected $price_view;
    protected $display_price;
    protected $total_units;
    protected $tax;
    protected $income;
    protected $sqft;
    protected $lotsize;
    protected $lot_acres;
    protected $yearbuilt;
    protected $is_rental = false;
    protected $energy_rating;
    protected $propview = [];
    protected $school_district;
    protected $lot_type;
    protected $style;
    protected $video;
    protected $status;
    protected $featured;
    protected $available;
    protected $created;
    protected $modified;
    protected $features = [];
    /* @var ListingAgent $agent */
    protected $agent;
    /* @var Address $address */
    protected $address;
    /* @var Media $media */
    protected $media;
    protected $inspection_times = [];
    protected $feature_groups = [
        'features',
        'otherFeatures',
        'allowances',
        'ecoFriendly',
        'idealFor',
        'ruralFeatures',
        'soldDetails',
        'landDetails',
        'buildingDetails',
        'vendorDetails',
    ];
    // set the inactive statuses here
    protected $inactive = [
        'leased', 'withdrawn', 'sold', 'rented'
    ];

    public function __construct(SimpleXMLElement $xml)
    {
        $this->setModified((string) $xml->attributes()->modTime);
        $this->setStatus((string) $xml->attributes()->status);
        $this->setUniqueId((string)$xml->uniqueID);

        if (!in_array($this->getStatus(), $this->inactive)) {
            $this->setTitle((string)$xml->headline);
            $this->setDescription((string)$xml->description);
            if ($xml->municipality) {
                $this->setMunicipality((string)$xml->municipality);
            }
            if ($xml->address) {
                $this->setAddress($xml->address);
            }
            if ($xml->agentID) {
                $this->setAgentId((string) $xml->agentID);
            }
            if ($xml->listingAgent) {
                $this->setAgents($xml->listingAgent->xpath('//listingAgent'));
            }
            $this->setMedia($xml);
            $this->setVideo((string)$xml->videoLink);
            $this->setPriceView((string)$xml->priceView);
            if ($xml->price) {
                $this->setPrice((int)$xml->price);
                if (isset($xml->price->attributes()->display)) {
                    $this->setDisplayPrice((string)$xml->price->attributes()->display);
                } else {
                    $this->setDisplayPrice(true);
                }
            }
            if ($xml->views) {
                $this->setPropview($xml->views);
            }
            $this->setFeatures($xml);
            $this->setLatitude((string) $xml->Geocode->Latitude);
            $this->setLongitude((string) $xml->Geocode->Longitude);
        }
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUniqueId()
    {
        return $this->unique_id;
    }

    /**
     * @param mixed $unique_id
     */
    public function setUniqueId($unique_id)
    {
        $this->unique_id = $unique_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return Listing
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSaleType()
    {
        return $this->sale_type;
    }

    /**
     * @param mixed $sale_type
     * @return $this
     */
    public function setSaleType($sale_type)
    {
        $this->sale_type = $sale_type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsRental()
    {
        return $this->is_rental;
    }

    /**
     * @param mixed $is_rental
     */
    public function setIsRental($is_rental)
    {
        $this->is_rental = $is_rental;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentFreq()
    {
        return $this->payment_freq;
    }

    /**
     * @param mixed $payment_freq
     */
    public function setPaymentFreq($payment_freq)
    {
        $this->payment_freq = $payment_freq;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getListingOffice()
    {
        return $this->listing_office;
    }

    /**
     * @param mixed $listing_office
     * @return Listing
     */
    public function setListingOffice($listing_office)
    {
        $this->listing_office = $listing_office;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Listing
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMunicipality()
    {
        return $this->municipality;
    }

    /**
     * @param mixed $municipality
     * @return Listing
     */
    public function setMunicipality($municipality)
    {
        $this->municipality = $municipality;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShortDescription()
    {
        return $this->short_description;
    }

    /**
     * @param mixed $short_description
     * @return Listing
     */
    public function setShortDescription($short_description)
    {
        $this->short_description = $short_description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     * @return Listing
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * @param mixed $terms
     * @return Listing
     */
    public function setTerms($terms)
    {
        $this->terms = $terms;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return Listing
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPriceView()
    {
        return $this->price_view;
    }

    /**
     * @param mixed $price_view
     */
    public function setPriceView($price_view)
    {
        $this->price_view = $price_view;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDisplayPrice()
    {
        return $this->display_price;
    }

    /**
     * @param mixed $display_price
     * @return Listing
     */
    public function setDisplayPrice($display_price)
    {
        $display = filter_var($display_price, FILTER_VALIDATE_BOOLEAN, ['default' => true]);
        $this->display_price = $display;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTotalUnits()
    {
        return $this->total_units;
    }

    /**
     * @param mixed $total_units
     * @return Listing
     */
    public function setTotalUnits($total_units)
    {
        $this->total_units = $total_units;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param mixed $tax
     * @return Listing
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIncome()
    {
        return $this->income;
    }

    /**
     * @param mixed $income
     * @return Listing
     */
    public function setIncome($income)
    {
        $this->income = $income;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSqft()
    {
        return $this->sqft;
    }

    /**
     * @param mixed $sqft
     * @return Listing
     */
    public function setSqft($sqft)
    {
        $this->sqft = $sqft;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLotsize()
    {
        return $this->lotsize;
    }

    /**
     * @param mixed $lotsize
     * @return Listing
     */
    public function setLotsize($lotsize)
    {
        $this->lotsize = $lotsize;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLotAcres()
    {
        return $this->lot_acres;
    }

    /**
     * @param mixed $lot_acres
     * @return Listing
     */
    public function setLotAcres($lot_acres)
    {
        $this->lot_acres = $lot_acres;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getYearbuilt()
    {
        return $this->yearbuilt;
    }

    /**
     * @param mixed $yearbuilt
     * @return Listing
     */
    public function setYearbuilt($yearbuilt)
    {
        $this->yearbuilt = $yearbuilt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPropview()
    {
        return $this->propview;
    }

    /**
     * @param SimpleXMLElement $propview
     * @return Listing
     */
    public function setPropview($propview)
    {
        $views = $propview->children();
        /* @var SimpleXMLElement $view */
        foreach ($views as $view) {
            $this->propview[$view->getName()] = (string) $view;
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLotType()
    {
        return $this->lot_type;
    }

    /**
     * @param mixed $lot_type
     * @return Listing
     */
    public function setLotType($lot_type)
    {
        $this->lot_type = $lot_type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param mixed $style
     * @return Listing
     */
    public function setStyle($style)
    {
        $this->style = $style;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getVideo()
    {
        return $this->video;
    }

    /**
     * @param mixed $video
     * @return Listing
     */
    public function setVideo($video)
    {
        $this->video = $video;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFeatured()
    {
        return $this->featured;
    }

    /**
     * @param mixed $featured
     * @return Listing
     */
    public function setFeatured($featured)
    {
        $this->featured = $featured;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getAvailable()
    {
        return $this->available;
    }

    /**
     * @param mixed $available
     * @return Listing
     */
    public function setAvailable($available)
    {
        $this->available = DateAndTime::parseToCarbon($available);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     * @return Listing
     */
    public function setCreated($created)
    {
        $this->created = $created;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @param mixed $modified
     * @return Listing
     */
    public function setModified($modified)
    {
        // If no modified date is set we'll set the time to now
        if (empty($modified)) {
            $this->modified = Carbon::now();
            return $this;
        }

        $this->modified = DateAndTime::parseToCarbon($modified);

        return $this;
    }

    /**
     * @return \ThinkReaXMLParser\Objects\ListingAgent
     */
    public function getAgent()
    {
        return $this->agent;
    }

    /**
     * @param SimpleXMLElement $agent
     * @param string $agent_id
     * @return Listing
     */
    public function setAgent($agent, $agent_id)
    {
        $this->agent[] = new ListingAgent($agent, $agent_id);
        return $this;
    }

    /**
     * @param array $agent
     * @return Listing
     */
    public function setAgents($agents)
    {
        foreach ($agents as $agent) {
            $this->agents[] = new ListingAgent($agent, $this->getAgentId());
        }
        return $this;
    }

    /**
     * @return array
     */
    public function getAgents()
    {
        return $this->agents;
    }

    /**
     * @param string $agentId
     * @return Listing
     */
    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;

        return $this;
    }

    /**
     * @return string
     */
    public function getAgentId()
    {
        return $this->agentId;
    }

    /**
     * @return \ThinkReaXMLParser\Objects\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param SimpleXMLElement $address
     * @return Listing
     */
    public function setAddress($address)
    {
        $this->address = new Address($address, $this->getMunicipality());
        return $this;
    }

    /**
     * @return \ThinkReaXMLParser\Objects\Media
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param SimpleXMLElement $objects
     * @return Listing
     */
    public function setMedia($objects)
    {
        $this->media = new Media($objects);
        return $this;
    }

    /**
     * @return array
     */
    public function getFeatures()
    {
        return $this->features;
    }

    /**
     * @return array
     */
    public function getFeatureDetails()
    {
        $features = [];

        foreach(array_filter($this->features, function ($feature) {
            return $feature->getType() == 'features';
        }) as $feature) {
            $features[$feature->getName()] = $feature->getValue();
        }

        return $features;
    }

    /**
     * @param SimpleXMLElement $xml
     */
    public function setFeatures($xml)
    {
        foreach ($this->feature_groups as $feature_group) {
            if ($xml->{$feature_group}) {
                $children = $xml->{$feature_group}->children();
                foreach ($children as $feature) {
                    $temp_context = [];
                    $attributes = $feature->attributes();
                    foreach ($attributes as $attribute => $value) {
                        $temp_context[$attribute] = $value;
                    }
                    /* @var SimpleXMLElement $feature */
                    $this->features[] = new Detail($feature_group, $feature->getName(), (string) $feature, $temp_context);
                }
            }
        }
    }

    /**
     * @return array
     */
    public function getInspectionTimes()
    {
        return $this->inspection_times;
    }

    /**
     * @param SimpleXMLElement $inspection_times
     */
    public function setInspectionTimes($inspection_times)
    {
        foreach ($inspection_times as $inspection_time) {
            $this->inspection_times[] = new InspectionTime((string) $inspection_time);
        }
    }

}
