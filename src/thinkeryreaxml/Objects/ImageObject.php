<?php

namespace ThinkReaXMLParser\Objects;

class ImageObject extends MediaMember
{
    public function setOrdering($ordering)
    {
        // they use m for the main picture, then revert to a-z for others. Why? Who knows.
        if ($ordering == 'm') {
            $order = 1;
        } else {
            $order = $this->getIntFromLetter($ordering);
        }
        $this->ordering = $order;
        return $this;
    }

    private function getIntFromLetter($order)
    {
        $alphabet = ['a','b','c','d','e','f','g','h','i','j','k','l','n','o','p','q','r','s','t','u','v','w','x','y','z'];
        $raw_value = array_search($order, $alphabet);

        return $raw_value + 2; // add 2, since m is always 1 and array indexing starts at zero
    }
}