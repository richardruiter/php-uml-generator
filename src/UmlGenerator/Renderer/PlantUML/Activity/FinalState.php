<?php

namespace UmlGenerator\Renderer\PlantUML\Activity;

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
