<?php

namespace UmlGenerator\Diagram;

/**
 * Generate a activity diagram
 *
 * @author rruiter
 */
class Activity extends Diagram
{
    /**
     * Initial state
     * 
     * @return \UmlGenerator\Diagram\Activity
     */
    public function start()
    {
        $element = $this->getRenderer()->getElement('initialstate');
        $this->addElement($element);
        return $this;
    }
    
    /**
     * Create an activity element
     * 
     * @param string $label
     * @return \UmlGenerator\Diagram\Activity
     */
    public function activity($label)
    {
        $element = $this->getRenderer()->getElement('activity', $label);
        $this->addElement($element);
        return $this;
    }
    
    /**
     * Final state
     * 
     * @return \UmlGenerator\Diagram\Activity
     */
    public function end()
    {
        $element = $this->getRenderer()->getElement('finalstate');
        $this->addElement($element);
        return $this;
    }

}
