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
        $element = $this->getRenderer()->getElement('Activity', 'InitialState');
        $this->addElement($element);
        return $this;
    }
    
    /**
     * Create an activity element
     * 
     * @param string $title
     * @return \UmlGenerator\Diagram\Activity
     */
    public function activity($title)
    {
        $element = $this->getRenderer()->getElement('Activity', 'Activity');
        $element->setTitle($title);
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
        $element = $this->getRenderer()->getElement('Activity', 'FinalState');
        $this->addElement($element);
        return $this;
    }

}
