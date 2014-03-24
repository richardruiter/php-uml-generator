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

    protected function _render()
    {
        
    }
    
    /*
    public function renderNote()
    {
        $output = null;
        if (!is_null($this->getNote()))
        {
            $output .= PHP_EOL;
            $output .= 'note ' . $this->getNote_dir() . ' of ' . $this->getTitle() . PHP_EOL;
            $output .= $this->getNote() . PHP_EOL;
            $output .= 'end note';
            $this->note = null;
        }
        return $output;
    }
     *
     */
}
