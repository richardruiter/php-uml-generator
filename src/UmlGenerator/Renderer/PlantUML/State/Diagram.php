<?php

namespace UmlGenerator\Renderer\PlantUML\State;

use UmlGenerator\Renderer\PlantUML\Diagram as PlantUMLDiagram;

/**
 * Description of Diagram
 *
 * @author rruiter
 */
class Diagram extends PlantUMLDiagram
{
    protected function _generate()
    {
        $renderer = $this->getRenderer();
        
        $uml = '';
        
        foreach($renderer->getDiagram()->getRelations() as $relation)
        {
            $from = $relation->getFrom();
            
            $label = $from->getLabel();
            $uml .= sprintf(
                '%s %s%s %s', 
                $from->render(), 
                $renderer->getArrowFromDirection($relation->getDirection()),
                $relation->getTo()->render(),
                (!empty($label)) ? ':' . $label : null
            );
            $uml .= PHP_EOL;
            
            // note
            if (!is_null($from->getNote()))
            {
                $uml .= 'note ' . $from->getNote_dir() . ' of ' . $from->getTitle() . PHP_EOL;
                $uml .= $from->getNote() . PHP_EOL;
                $uml .= 'end note';
                $uml .= PHP_EOL;
                $from->setNote(NULL);
            }
            
        }
        
        return $uml;
    }

}
