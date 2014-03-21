<?php

namespace UmlGenerator\Renderer\PlantUML\Activity;

use UmlGenerator\Element;

/**
 * Description of InitialState
 *
 * @author rruiter
 */
class InitialState extends Element
{
    public function _render()
    {
        return '(*)';
    }
}
