<?php

namespace ThinkReaXMLParser\Objects;

use Carbon\Carbon;

class InspectionTime
{
    /* @var Carbon $from */
    protected $from;
    /* @var Carbon $to */
    protected $to;

    public function __construct($inspection_time)
    {
        // do our best with this one. Format should be "21-Dec-2010 11:00am to 1:00pm"
        $parts = explode(' to ', $inspection_time);
        $this->setFrom(new Carbon($parts[0]));
        if ($this->from) {
            $to_date = $this->from->toDateString().' '.$parts[1];
            $this->setTo(new Carbon($to_date));
        }
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @param mixed $from
     */
    public function setFrom($from)
    {
        $this->from = $from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @param mixed $to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }
}