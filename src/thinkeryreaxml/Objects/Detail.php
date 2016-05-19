<?php

namespace ThinkReaXMLParser\Objects;

class Detail
{
    protected $type;
    protected $name;
    protected $value;
    protected $context;

    /**
     * Detail constructor.
     * @param $type
     * @param $name
     * @param $value
     * @param $context
     */
    public function __construct($type, $name, $value, $context)
    {
        $this->setType($type);
        $this->setName($name);
        $this->setValue($value);
        $this->setContext($context);
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
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param mixed $context
     */
    public function setContext($context)
    {
        $this->context = $context;
    }
}