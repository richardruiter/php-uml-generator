<?php

namespace UmlGenerator\Diagram;

use UmlGenerator\Relation;
use UmlGenerator\Skin;

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
        $this->setCurrentElement($element);
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
        $this->addElement($element_from);
        
        // to
        $element_to = $this->getRenderer()->getElement('State', 'State');
        $element_to->setTitle($to);
        $this->addElement($element_to);
        
        // add relations
        if (sizeof($this->relations) == 0 && $this->getCurrentElement())
        {
            // initial relation
            $relation = new Relation($this->getCurrentElement(), $element_from);
            $this->addRelation($relation);
        }
        $relation = new Relation($element_from, $element_to);
        $this->addRelation($relation);
        
        // set current element to 
        $this->setPreviousElement($element_from);
        
        // set current element to 
        $this->setCurrentElement($element_to);
        
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
        if ($this->getCurrentElement())
        {
            $relation = new Relation($this->getCurrentElement(), $element);
            $this->addRelation($relation);
        }
        
        // this state ends here... make previous current
        //$this->setCurrentElement($this->history[sizeof($this->history)-2]);
        
        return $this;
    }

    public function setStateSkin(Skin $skin, $stateid = null)
    {
        if (!is_null($stateid))
        {
            $element = $this->getRenderer()->getElement('State', 'State');
            $element->setTitle($stateid);
            $stateid = $element->getId();
        }
        $this->addSkin($skin, 'state', $stateid);
        return $this;
    }
}
