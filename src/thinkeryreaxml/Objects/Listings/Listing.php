<?php

namespace ThinkReaXMLParser\Objects\Listings;

use Carbon\Carbon;
use SimpleXMLElement;

abstract class Listing
{
    protected $unique_id;
    protected $type;
    protected $category;
    protected $payment_freq;
    protected $listing_office;
    protected $title;
    protected $short_description;
    protected $description;
    protected $terms;
    protected $price;
    protected $call_for_price;
    protected $total_units;
    protected $tax;
    protected $income;
    protected $sqft;
    protected $lotsize;
    protected $lot_acres;
    protected $yearbuilt;
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
    /* @var Address $agent */
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

    public function __construct(SimpleXMLElement $xml)
    {
        $this->setStatus((string) $xml->attributes()->status);
        $this->setUniqueId((string) $xml->uniqueID);
        $this->setTitle((string) $xml->headline);
        $this->setDescription((string) $xml->description);
        $this->setAvailable((string) $xml->dateAvailable);
        $this->setAddress($xml->address);
        $this->setAgent($xml->listingAgent, (string) $xml->agentID);
        $this->setMedia($xml->objects);
        $this->setVideo((string) $xml->videoLink);
        $this->setCategory((string) $xml->category->attributes()->name);
        $this->setPrice((string) $xml->price);
        $this->setCallForPrice((string) $xml->price->attributes()->display);
        $this->setPropview($xml->views);
        $this->setFeatures($xml);
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
    public function getCallForPrice()
    {
        return $this->call_for_price;
    }

    /**
     * @param mixed $call_for_price
     * @return Listing
     */
    public function setCallForPrice($call_for_price)
    {
        $display = filter_var($call_for_price, FILTER_VALIDATE_BOOLEAN, ['default' => true]);
        $this->call_for_price = $display;
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
        $this->available = Carbon::createFromFormat('Y-m-d', $available);
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
        $this->modified = $modified;
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
        $this->agent = new ListingAgent($agent, $agent_id);
        return $this;
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
        $this->address = new Address($address);
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
     * @param SimpleXMLElement $xml
     */
    public function setFeatures($xml)
    {
        foreach ($this->feature_groups as $feature_group) {
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