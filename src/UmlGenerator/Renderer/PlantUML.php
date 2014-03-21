<?php

namespace UmlGenerator\Renderer;

use UmlGenerator\Diagram\Diagram;

/**
 * Description of PlantUML
 *
 * @author rruiter
 */
class PlantUML extends Renderer
{
    public function getElement($id)
    {
        $args = func_get_args();
        
        switch($id)
        {
            case 'initialstate': 
                $element = new PlantUML\InitialState();
            break;
            case 'finalstate': 
                $element = new PlantUML\FinalState();
            break;
            case 'activity': 
                $element = new PlantUML\Activity($args[1]);
            break;
        }
        
        return $element;
    }
    
    public function generate(Diagram $diagram)
    {
        $uml = "@startuml" . PHP_EOL;
        foreach($diagram->getRelations() as $relation)
        {
            $uml .= sprintf(
                '%s %s%s %s', 
                $relation->getFrom()->render(), 
                $this->getArrowFromDirection($relation->getDirection()),
                $relation->getLabel(),
                $relation->getTo()->render()
            );
            $uml .= PHP_EOL;
        }
        $uml .= "@enduml" . PHP_EOL;
        
        return $uml;
    }
    
    /**
     * Creates plantuml image data
     * 
     * @return string imagedata
     */
    public function getImageData(Diagram $diagram)
    {
        $uml = $this->generate($diagram);
        
        // write the uml in an temp file
        $temp_file = tempnam(sys_get_temp_dir(), 'umlfile');
        file_put_contents($temp_file, $uml);
        
        // create image file
        $temp_img = tempnam(sys_get_temp_dir(), 'umlimage');
        $jar = UMLGENERATOR_BASE_PATH . '/bin/plantuml.jar';
        shell_exec('cat '.$temp_file.' | java -jar '.$jar.' -pipe > '.$temp_img);
        
        // get image
        $imgdata = file_get_contents($temp_img);
        
        // remove tmp files
        unlink($temp_file);
        unlink($temp_img);
        
        return $imgdata;
    }
    
    /**
     * Get an arrow based on the direction
     * 
     * @param string $direction
     * @return string
     */
    private function getArrowFromDirection($direction)
    {
        $arrow = '-->';
        switch($direction)
        {
            case Diagram::DIRECTION_RIGHT:
                $arrow = '->';
            break;
            case Diagram::DIRECTION_LEFT:
                $arrow = '-left->';
            break;
            case Diagram::DIRECTION_UP:
                $arrow = '-up->';
            break;
        }
        
        return $arrow;
    }
}