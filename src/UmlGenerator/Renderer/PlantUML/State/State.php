<?php

namespace UmlGenerator\Renderer\PlantUML\State;

/**
 * Description of Activity
 *
 * @author rruiter
 */
class State extends Element
{
    private $title;

    public function __construct($title = null)
    {
        $this->setTitle($title);
    }

    public function _render()
    {
        return sprintf('%s << %s >>', $this->getTitle(), $this->getId());
    }
    
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = str_replace(' ', '', $title);
    }

    public function getId()
    {
        return 'state_'.$this->getTitle();
    }
}
