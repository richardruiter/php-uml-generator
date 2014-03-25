<?php

namespace UmlGenerator\Renderer\PlantUML\State;

use UmlGenerator\Element as BaseElement;

/**
 * Description of Element
 *
 * @author rruiter
 */
class Element extends BaseElement
{
    public function getLabel()
    {
        return $this->label;
    }

    protected function _render(){}
    public function getId(){}
}
