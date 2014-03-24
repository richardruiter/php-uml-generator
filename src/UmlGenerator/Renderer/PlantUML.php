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
    /**
     * 
     * @param string $type
     * @param string $id
     * @return \UmlGenerator\Element
     */
    public function getElement($type, $id)
    {        
        $cls = 'UmlGenerator\\Renderer\\PlantUML\\'.$type.'\\'.$id;
        return new $cls;
    }
    
    public function generate()
    {       
        return $this->getConcreteDiagram()->generate();
    }
    
    /**
     * Creates plantuml image data
     * 
     * @return string imagedata
     */
    public function getImageData()
    {
        $uml = $this->generate();
        
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
    public function getArrowFromDirection($direction)
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

    public function getConcreteDiagram()
    {
        $type = $this->getDiagram()->getDiagramType();
        $cls = 'UmlGenerator\\Renderer\\PlantUML\\'.$type.'\\Diagram';
        return new $cls($this);
    }

}