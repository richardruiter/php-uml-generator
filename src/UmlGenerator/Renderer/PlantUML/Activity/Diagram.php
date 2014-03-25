<?php

namespace UmlGenerator\Renderer\PlantUML\Activity;

use UmlGenerator\Renderer\PlantUML\Diagram as PlantUMLDiagram;

/**
 * Description of Diagram
 *
 * @author rruiter
 */
class Diagram extends PlantUMLDiagram
{
    public function _generate()
    {
        $renderer = $this->getRenderer();
        
        $uml = '';
        foreach($renderer->getDiagram()->getRelations() as $relation)
        {
            $from = $relation->getFrom();
            $label = $from->getLabel();
            
            $uml .= sprintf(
                '%s %s%s %s', 
                $relation->getFrom()->render(), 
                $renderer->getArrowFromDirection($relation->getDirection()),
                (!empty($label)) ? '[' . $label . ']' : null,
                $relation->getTo()->render()
            );
            $uml .= PHP_EOL;
        }
        
        return $uml;
    }

}
