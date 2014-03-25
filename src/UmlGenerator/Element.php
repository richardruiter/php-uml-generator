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
    protected $label = null;
    
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
    
    public function getNote_dir()
    {
        return $this->note_dir;
    }

    public function setNote_dir($note_dir)
    {
        $this->note_dir = $note_dir;
    }

    
    public function render()
    {
        $output = $this->_render();
        return $output;
    }
    
    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }
    
    abstract protected function _render();
    abstract public function getId();
}
