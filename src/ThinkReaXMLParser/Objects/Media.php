<?php

namespace ThinkReaXMLParser\Objects;

use ThinkReaXMLParser\Objects\ImageObject;
use ThinkReaXMLParser\Objects\FloorplanObject;

class Media
{
    protected $images = [];
    protected $floorplans = [];

    public function __construct(\SimpleXMLElement $objects)
    {
        foreach ($objects->children() as $object) {
            $this->processMedia($object);
        }
    }

    public function processMedia($object)
    {
        /* @var \SimpleXMLElement $object */
        if ($object->getName() == 'img') {
            $this->setImage(new ImageObject($object));
        } else if ($object->getName() == 'floorplan') {
            $this->setFloorplan(new FloorplanObject($object));
        }
    }

    /**
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param \ThinkReaXMLParser\Objects\ImageObject $image
     * @internal param array $object
     */
    public function setImage(ImageObject $image)
    {
        $this->images[] = $image;
    }

    /**
     * @return array
     */
    public function getFloorplans()
    {
        return $this->floorplans;
    }

    /**
     * @param \ThinkReaXMLParser\Objects\FloorplanObject $floorplan
     * @internal param array $object
     */
    public function setFloorplan(FloorplanObject $floorplan)
    {
        $this->floorplans[] = $floorplan;
    }
}