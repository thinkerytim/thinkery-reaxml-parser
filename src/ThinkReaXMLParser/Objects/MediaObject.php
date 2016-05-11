<?php

namespace ThinkReaXMLParser\Objects;

interface MediaObject
{
    public function __construct(\SimpleXMLElement $object);

    public function setUrl($url);

    public function setData($data);

    public function setFileName($filename);

    public function setOrdering($ordering);

    public function setModified($modified);
}