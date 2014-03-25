<?php

namespace UmlGenerator;

use UmlGenerator\Element;

/**
 * Description of Relation
 *
 * @author rruiter
 */
class Relation
{
    private $from;
    private $to;
    private $direction;
    
    public function __construct(Element $from, Element $to, $direction = null)
    {
        $this->setFrom($from);
        $this->setTo($to);
        $this->setDirection($direction);
    }

    public function getFrom()
    {
        return $this->from;
    }

    public function getTo()
    {
        return $this->to;
    }

    public function getDirection()
    {
        return $this->direction;
    }

    public function setFrom($from)
    {
        $this->from = $from;
        return $this;
    }

    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    public function setDirection($arrow)
    {
        $this->direction = $arrow;
        return $this;
    }

    public function getId()
    {
        return $this->getFrom()->getId() . '-' . $this->getTo()->getId();
    }
}
