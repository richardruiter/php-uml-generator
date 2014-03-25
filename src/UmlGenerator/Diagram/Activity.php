<?php

namespace UmlGenerator\Diagram;

use UmlGenerator\Relation;
use UmlGenerator\Skin;

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
        $this->setCurrentElement($element);
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
        if ($this->getCurrentElement())
        {
            $relation = new Relation($this->getCurrentElement(), $element);
            $this->addRelation($relation);
        }
        $this->setPreviousElement($this->getCurrentElement());
        $this->setCurrentElement($element);
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
        if ($this->getCurrentElement())
        {
            $relation = new Relation($this->getCurrentElement(), $element);
            $this->addRelation($relation);
        }
        $this->setPreviousElement($this->getCurrentElement());
        $this->setCurrentElement($element);
        return $this;
    }
    

    public function setActivitySkin(Skin $skin, $activityid = null)
    {
        if (!is_null($activityid))
        {
            $element = $this->getRenderer()->getElement('Activity', 'Activity');
            $element->setTitle($activityid);
            $activityid = $element->getId();
        }
        $this->addSkin($skin, 'activity', $activityid);
        return $this;
    }

}
