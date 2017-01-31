<?php

namespace ThinkReaXMLParser\Objects;

use JsonSerializable;

class ListingAgent implements JsonSerializable
{
    protected $order = 1;
    protected $agentID;
    protected $name;
    protected $telephone;
    protected $telephone_type;
    protected $email;
    protected $twitterURL;
    protected $facebookURL;
    protected $linkedInURL;

    public function __construct(\SimpleXMLElement $agent)
    {
        $this->order = $agent->attributes()->id ?: 1;
        $this->setName((string) $agent->name);
        $this->setTelephone((string) $agent->telephone);
        $this->setTelephoneType((string) $agent->telephone->attributes()->type);
        $this->setEmail((string) $agent->email);
        $this->setTwitterURL((string) $agent->twitterURL);
        $this->setFacebookURL((string) $agent->facebookURL);
        $this->setLinkedInURL((string) $agent->linkedInURL);
        $this->setAgentID((string) $agent->agentid);
    }

    public function jsonSerialize()
    {
        return [
            'order' => $this->getOrder(),
            'agentId' => $this->getAgentId(),
            'name' => $this->getName(),
            'telephone' => $this->getTelephone(),
            'telephoneType' => $this->getTelephoneType(),
            'email' => $this->getEmail(),
            'twitterURL' => $this->getTwitterURL(),
            'facebookURL' => $this->getFacebookURL(),
            'linkedInURL' => $this->getLinkedInURL()
        ];
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @return mixed
     */
    public function getAgentID()
    {
        return $this->agentID;
    }

    /**
     * @param mixed $agentID
     */
    public function setAgentID($agentID)
    {
        $this->agentID = $agentID;
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
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getTelephoneType()
    {
        return $this->telephone_type;
    }

    /**
     * @param mixed $telephone_type
     */
    public function setTelephoneType($telephone_type)
    {
        $this->telephone_type = $telephone_type;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTwitterURL()
    {
        return $this->twitterURL;
    }

    /**
     * @param mixed $twitterURL
     */
    public function setTwitterURL($twitterURL)
    {
        $this->twitterURL = $twitterURL;
    }

    /**
     * @return mixed
     */
    public function getFacebookURL()
    {
        return $this->facebookURL;
    }

    /**
     * @param mixed $facebookURL
     */
    public function setFacebookURL($facebookURL)
    {
        $this->facebookURL = $facebookURL;
    }

    /**
     * @return mixed
     */
    public function getLinkedInURL()
    {
        return $this->linkedInURL;
    }

    /**
     * @param mixed $linkedInURL
     */
    public function setLinkedInURL($linkedInURL)
    {
        $this->linkedInURL = $linkedInURL;
    }
}
