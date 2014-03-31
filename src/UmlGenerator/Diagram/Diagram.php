<?php

namespace UmlGenerator\Diagram;

use UmlGenerator\Renderer\Renderer;
use UmlGenerator\Element;
use UmlGenerator\Relation;
use UmlGenerator\Skin;

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
     * Previous element
     * 
     * @var UmlGenerator\Element 
     */
    protected $previous_element = null;
    
    /**
     * Current element
     * 
     * @var Element 
     */
    protected $current_element = null;
    
    /**
     *
     * @var UmlGenerator\Relation  
     */
    protected $current_relation = null;


    /**
     * 
     */
    protected $history = array();
    
    /**
     * Set diagram skin
     * 
     * @var Skin[]
     */
    protected $skins = array();

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
        $this->elements[$element->getId()] = $element;
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
        $relation->setDirection($this->getDirection());
        $this->relations[$relation->getId()] = $relation;
        $this->setCurrentRelation($relation);
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
        return $this->getRenderer()->getImageData();
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
        $renderer->setDiagram($this);
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
        if (!is_null($this->getPreviousElement()))
        {
            $this->getPreviousElement()->setLabel($txt);
        }
        return $this;
    }
    
    /**
     * 
     */
    public function getDiagramType()
    {
        return str_replace('UmlGenerator\\Diagram\\', '', get_class($this));
    }


    /**
     * Add a note with direction
     * 
     * @param string $note
     * @param string $direction
     * @return \UmlGenerator\Diagram\Diagram
     */
    public function note($note, $direction = self::DIRECTION_RIGHT)
    {
        if (!is_null($this->getCurrentElement()))
        {
            $this->getCurrentElement()->setNote($note, $direction);
        }
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
    
    public function getCurrentElement()
    {
        return $this->current_element;
    }

    public function setCurrentElement(Element $current_element)
    {
        $this->current_element = $current_element;
        $this->history[] = $current_element;
    }
    
    public function getPreviousElement()
    {
        return $this->previous_element;
    }

    public function setPreviousElement(Element $previous_element)
    {
        $this->previous_element = $previous_element;
    }
    
    public function getCurrentRelation()
    {
        return $this->current_relation;
    }

    public function setCurrentRelation(Relation $current_relation)
    {
        $this->current_relation = $current_relation;
        return $this;
    }

    
    public function setDiagramSkin(Skin $skin)
    {
        $this->addSkin($skin);
        return $this;
    }
    
    public function getSkins()
    {
        return $this->skins;
    }

    public function addSkin(Skin $skin, $prefix = null, $postfix = null)
    {
        $o = new \stdClass();
        $o->skin = $skin;
        $o->prefix = $prefix;
        $o->postfix = $postfix;
        $this->skins[$prefix.$postfix] = $o;
    }
}
