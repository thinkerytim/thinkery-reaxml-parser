<?php

namespace ThinkReaXMLParser\Objects;

use Carbon\Carbon;
use ThinkReaXMLParser\Utilities\DateAndTime;

class MediaMember implements MediaObject
{
    protected $url;
    protected $data;
    protected $filename;
    protected $filetype;
    protected $ordering;
    protected $modified;

    public function __construct(\SimpleXMLElement $object)
    {
        $this->setURL((string) $object->attributes()->url);
        $this->setData((string) $object);
        $this->setFileName((string) $object->attributes()->file);
        $this->setOrdering((string) $object->attributes()->id);
        $this->setModified((string) $object->attributes()->modTime);
        $this->setFiletype((string) $object->attributes()->format);
    }

    public function setURL($url)
    {
        $this->url = $url;
        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function setFileName($filename)
    {
        $this->filename = $filename;
        return $this;
    }

    public function setOrdering($ordering)
    {
        $this->ordering = (int) $ordering;
        return $this;
    }

    public function setModified($modified)
    {
        if (!$modified) {
            return $this;
        }
        $this->modified = DateAndTime::parseToCarbon($modified);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return mixed
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * @return mixed
     */
    public function getOrdering()
    {
        return $this->ordering;
    }

    /**
     * @return mixed
     */
    public function getModified()
    {
        return $this->modified;
    }

    /**
     * @return mixed
     */
    public function getFiletype()
    {
        return $this->filetype;
    }

    /**
     * @param mixed $filetype
     */
    public function setFiletype($filetype)
    {
        $this->filetype = $filetype;
    }
}
