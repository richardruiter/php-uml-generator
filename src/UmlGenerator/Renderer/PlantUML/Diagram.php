<?php

namespace UmlGenerator\Renderer\PlantUML;

use UmlGenerator\Renderer\Renderer;
use UmlGenerator\Skin;

/**
 * Description of Diagram
 *
 * @author rruiter
 */
abstract class Diagram
{
    public $renderer;
    
    public function __construct(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }
    
    /**
     * 
     * @return Renderer
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * 
     * @param type $renderer
     */
    public function setRenderer(Renderer $renderer)
    {
        $this->renderer = $renderer;
    }

    final public function generate()
    {
        $diagram = $this->getRenderer()->getDiagram();
        
        $uml = "@startuml" . PHP_EOL;
        
        foreach($diagram->getSkins() as $o)
        {
            $uml .= $this->renderSkin($o->skin, $o->prefix, $o->postfix);
        }
        $uml .= $this->_generate();
        $uml .= "@enduml" . PHP_EOL;
        
        //print '<pre>';
        //print $uml;
        
        return $uml;
    }
    
    private function renderSkin(Skin $skin, $prefix = '', $postfix = '')
    {
        $output = 'skinparam '.$prefix.' {' . PHP_EOL;
        $output .= $this->skinLine('BackgroundColor', $skin->getBackgroundcolor(), $postfix);
        $output .= $this->skinLine('ArrowColor', $skin->getLinecolor(), $postfix);
        $output .= $this->skinLine('BorderColor', $skin->getLinecolor(), $postfix);
        $output .= $this->skinLine('FontColor', $skin->getFontcolor(), $postfix);
        $output .= $this->skinLine('FontSize', $skin->getFontsize(), $postfix);
        $output .= $this->skinLine('FontStyle', $skin->getFontstyle(), $postfix);
        $output .= $this->skinLine('FontName', $skin->getFontname(), $postfix);
        $output .= $this->skinLine('shadowing', $skin->getShadow() ? 'true' : 'false', $postfix);
        $output .= '}' . PHP_EOL;
        return $output;
    }
    
    private function skinLine($prop, $value, $postfix = null)
    {
        $line = sprintf('%s%s %s',
            $prop,
            (!is_null($postfix)) ? '<< ' . $postfix . ' >>' : '',
            $value
        );
        $line .= PHP_EOL;
        
        return $line;
    }

    abstract protected function _generate();
}
