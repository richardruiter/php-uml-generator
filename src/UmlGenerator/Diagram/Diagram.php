<?php

namespace UmlGenerator\Diagram;

use UmlGenerator\Renderer\Renderer;
use UmlGenerator\Element;
use UmlGenerator\Relation;

/**
 * Base class for diagrams. It holds all relations between elements.
 *
 * @author rruiter
 */
abstract class Diagram
{
    /** directions **/
    const DIRECTION_DOWN    = 'down';
    const DIRECTION_RIGHT   = 'right';
    const DIRECTION_LEFT    = 'left';
    const DIRECTION_UP      = 'up';
    
    /**
     * Current direction
     * 
     * @var string
     */
    protected $direction; 
   
    /**
     * 
     * @var Renderer 
     */
    protected $renderer;
    
    /**
     * Collection of relations between elements
     * @var array
     */
    protected $relations = array();
    
    /**
     * Current element
     * 
     * @var Element 
     */
    protected $current_element = null;
    
    /**
     *
     * @var string
     */
    protected $nextlabel = null;

    /**
     * Constructor
     * 
     * @param \UmlGenerator\Renderer\Renderer $renderer
     */
    public function __construct(Renderer $renderer = null)
    {
        $this->setRenderer($renderer);
        $this->setDirection(self::DIRECTION_DOWN);
    }

    /**
     * Add an element
     * 
     * @param \UmlGenerator\Element $element
     * @return \UmlGenerator\Diagram\Diagram
     */
    public function addElement(Element $element)
    {
        if (!is_null($this->current_element))
        {
            $relation = new Relation($this->current_element, $element, $this->getDirection());
            $this->addRelation($relation);
        }
        $this->elements[] = $element;
        $this->current_element = $element;
        return $this;
    }
    
    /**
     * Add a relationship
     * 
     * @param \UmlGenerator\Relation $relation
     * @return \UmlGenerator\Diagram\Diagram
     */
    public function addRelation(Relation $relation)
    {
        if (!is_null($this->nextlabel))
        {
            $relation->setLabel($this->nextlabel);
            $this->nextlabel = null;
        }
        $this->relations[] = $relation;
        return $this;
    }
            
    /**
     * Render an image
     */
    public function renderImage()
    {
        header('Content-Type: image/png');
        print $this->getImageData();
        exit;
    }
    
    /**
     * Creates plantuml image data
     * 
     * @return string imagedata
     */
    public function getImageData()
    {
        return $this->getRenderer()->getImageData($this);
    }
    
    /**
     * Get the renderer
     * 
     * @return Renderer
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * Set the renderer
     * @param Renderer $renderer
     */
    public function setRenderer($renderer)
    {
        $this->renderer = $renderer;
    }
    
    /**
     * Add a label
     * 
     * @param type $txt
     * @return \UmlGenerator\Diagram\Diagram
     */
    public function label($txt)
    {
        $this->nextlabel = $txt;
        return $this;
    }
    
    /**
     * Add a not with direction
     * 
     * @param string $note
     * @param string $direction
     * @return \UmlGenerator\Diagram\Diagram
     */
    public function note($note, $direction = self::DIRECTION_RIGHT)
    {
        $this->current_element->setNote($note, $direction);
        return $this;
    }
    
    /**
     * Set direction to down
     * 
     * @return \UmlGenerator\Diagram\Diagram
     */
    public function down()
    {
        $this->setDirection(self::DIRECTION_DOWN);
        return $this;
    }
    
    /**
     * Set direction to right
     * 
     * @return \UmlGenerator\Diagram\Diagram
     */
    public function right()
    {
        $this->setDirection(self::DIRECTION_RIGHT);
        return $this;
    }
    
    /**
     * Set direction to left
     * 
     * @return \UmlGenerator\Diagram\Diagram
     */
    public function left()
    {
        $this->setDirection(self::DIRECTION_LEFT);
        return $this;
    }
    
    /**
     * Set direction to up
     * 
     * @return \UmlGenerator\Diagram\Diagram
     */
    public function up()
    {
        $this->setDirection(self::DIRECTION_UP);
        return $this;
    }
    
    /**
     * Get the current direction
     * 
     * @return string
     */
    public function getDirection()
    {
        return $this->direction;
    }

    /**
     * Set the current direction
     * 
     * @param string $direction
     */
    public function setDirection($direction)
    {
        $this->direction = $direction;
    }
    
    /**
     * Get the relations
     * @return array
     */
    public function getRelations()
    {
        return $this->relations;
    }
}
