<?php

namespace ThinkReaXMLParser\Objects;


class ListingAgent
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

    public function __construct(\SimpleXMLElement $agent, $agent_id)
    {
        $this->order = $agent->attributes()->id ?: 1;
        $this->setName((string) $agent->name);
        $this->setTelephone((string) $agent->telephone);
        $this->setTelephoneType((string) $agent->telephone->attributes()->type);
        $this->setEmail((string) $agent->email);
        $this->setTwitterURL((string) $agent->twitterURL);
        $this->setFacebookURL((string) $agent->facebookURL);
        $this->setLinkedInURL((string) $agent->linkedInURL);
        // only do this for first agent
        if ($this->order == 1) {
            $this->setAgentID((string) $agent_id);
        }
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