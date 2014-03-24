<?php

namespace UmlGenerator\Renderer\PlantUML\State;

/**
 * Description of InitialState
 *
 * @author rruiter
 */
class InitialState extends Element
{
    public function _render()
    {
        return '[*]';
    }
}
