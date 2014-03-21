<?php

namespace UmlGenerator\Renderer;

use UmlGenerator\Diagram\Diagram;

/**
 * Description of Renderer
 *
 * @author rruiter
 */
abstract class Renderer
{
    /**
     * The diagram
     * 
     * @var Diagram 
     */
    private $diagram;

    /**
     * Get the diagram
     * 
     * @return Diagram
     */
    public function getDiagram()
    {
        return $this->diagram;
    }

    /**
     * Set the diagram
     * 
     * @param \UmlGenerator\Diagram\Diagram $diagram
     */
    public function setDiagram(Diagram $diagram)
    {
        $this->diagram = $diagram;
    }

    abstract public function generate();
    abstract public function getImageData();
    abstract public function getElement($type, $id);
}
