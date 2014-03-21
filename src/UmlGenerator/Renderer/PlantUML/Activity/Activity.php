<?php

namespace UmlGenerator\Renderer\PlantUML\Activity;

use UmlGenerator\Element;

/**
 * Description of Activity
 *
 * @author rruiter
 */
class Activity extends Element
{
    private $label;

    public function __construct($label = null)
    {
        $this->label = $label;
    }

    public function _render()
    {
        return sprintf('"%s"', $this->label);
    }
}
