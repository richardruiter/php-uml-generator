<?php

namespace UmlGenerator\Renderer\PlantUML;

use UmlGenerator\Element;

/**
 * Description of FinalState
 *
 * @author rruiter
 */
class FinalState extends Element
{
    public function _render()
    {
        return '(*)';
    }
}
