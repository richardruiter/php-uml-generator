<?php

namespace UmlGenerator\Renderer\PlantUML\Activity;

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
