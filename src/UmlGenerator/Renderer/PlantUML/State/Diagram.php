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
            $to = $relation->getTo();
            
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
            if (!is_null($to->getNote()))
            {
                $uml .= 'note ' . $to->getNote_dir() . ' of ' . $to->getTitle() . PHP_EOL;
                //$uml .= 'note ' . $to->getNote_dir() . ' on link' . PHP_EOL;
                $uml .= $to->getNote() . PHP_EOL;
                $uml .= 'end note';
                $uml .= PHP_EOL;
                $to->setNote(NULL);
            }
            
        }
        //exit;
        
        return $uml;
    }

}
