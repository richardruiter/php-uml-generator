<?php

namespace UmlGenerator\Renderer\PlantUML\Activity;

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
