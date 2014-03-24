<?php

namespace UmlGenerator\Diagram;

use UmlGenerator\Relation;

/**
 * Generate a state diagram
 *
 * @author rruiter
 */
class State extends Diagram
{
    /**
     * Initial state
     * 
     * @return \UmlGenerator\Diagram\State
     */
    public function start()
    {
        $element = $this->getRenderer()->getElement('State', 'InitialState');
        $this->addElement($element);
        return $this;
    }
    
    /**
     * Create an activity element
     * 
     * @param string $title
     * @return \UmlGenerator\Diagram\State
     */
    public function state($title)
    {
        $element = $this->getRenderer()->getElement('State', 'State');
        $element->setTitle($title);
        $this->addElement($element);
        return $this;
    }
    
    /**
     * Transition
     */
    public function transition($from, $to)
    {
        // from
        $element_from = $this->getRenderer()->getElement('State', 'State');
        $element_from->setTitle($from);
        
        // to
        $element_to = $this->getRenderer()->getElement('State', 'State');
        $element_to->setTitle($to);
        
        // add relation
        $relation = new Relation($element_from, $element_to, $this->getDirection());
        $this->addRelation($relation);
        
        $this->current_element = $element_from;
        
        return $this;
    }

    /**
     * Final state
     * 
     * @return \UmlGenerator\Diagram\State
     */
    public function end()
    {
        $element = $this->getRenderer()->getElement('State', 'FinalState');
        $this->addElement($element);
        return $this;
    }

}
