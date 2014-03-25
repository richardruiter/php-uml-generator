<?php

namespace UmlGenerator\Renderer\PlantUML\Activity;

/**
 * Description of Activity
 *
 * @author rruiter
 */
class Activity extends Element
{
    private $title;

    public function __construct($title = null)
    {
        $this->setTitle($title);
    }

    public function _render()
    {
        return sprintf('"%s" << %s >>', $this->getTitle(), $this->getId());
    }
    
    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getId()
    {
        return 'activity'.str_replace(' ', '', $this->getTitle());
    }
}