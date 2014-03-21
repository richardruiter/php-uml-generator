<?php

namespace UmlGenerator;

/**
 * Description of Element
 *
 * @author rruiter
 */
abstract class Element
{
    private $note = null;
    private $note_dir = 'right';
    
    public function getNote()
    {
        return $this->note;
    }

    public function setNote($note, $direction = 'right')
    {
        $this->note = $note;
        $this->note_dir = $direction;
        return $this;
    }

    public function render()
    {
        $output = $this->_render();
        if (!is_null($this->note))
        {
            $output .= PHP_EOL;
            $output .= 'note ' . $this->note_dir . PHP_EOL;
            $output .= $this->note . PHP_EOL;
            $output .= 'end note';
            $this->note = null;
        }
        return $output;
    }
    
    abstract protected function _render();
}
