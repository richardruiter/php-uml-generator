<?php

namespace UmlGenerator\Renderer\PlantUML;

use UmlGenerator\Renderer\Renderer;

/**
 * Description of Diagram
 *
 * @author rruiter
 */
abstract class Diagram
{
    public $renderer;
    
    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }
    
    /**
     * 
     * @return Renderer
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * 
     * @param type $renderer
     */
    public function setRenderer(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    abstract public function generate();
}
