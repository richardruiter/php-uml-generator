<?php

namespace UmlGenerator;

/**
 * Description of Skin
 *
 * @author rruiter
 */
class Skin
{
    private $backgroundcolor = 'white';
    private $linecolor = 'black';
    
    private $fontcolor = 'black';
    private $fontsize = '13';
    private $fontstyle = 'plain';
    private $fontname = 'Arial';
    
    private $shadow = true;
    
    public function getBackgroundcolor()
    {
        return $this->backgroundcolor;
    }

    public function setBackgroundcolor($backgroundcolor)
    {
        $this->backgroundcolor = $backgroundcolor;
    }
    
    public function getLinecolor()
    {
        return $this->linecolor;
    }

    public function setLinecolor($linecolor)
    {
        $this->linecolor = $linecolor;
    }
        
    public function getFontcolor()
    {
        return $this->fontcolor;
    }

    public function getFontsize()
    {
        return $this->fontsize;
    }

    public function getFontstyle()
    {
        return $this->fontstyle;
    }

    public function getFontname()
    {
        return $this->fontname;
    }

    public function setFontcolor($fontcolor)
    {
        $this->fontcolor = $fontcolor;
    }

    public function setFontsize($fontsize)
    {
        $this->fontsize = $fontsize;
    }

    public function setFontstyle($fontstyle)
    {
        $this->fontstyle = $fontstyle;
    }

    public function setFontname($fontname)
    {
        $this->fontname = $fontname;
    } 
    
    public function getShadow()
    {
        return $this->shadow;
    }

    public function setShadow($shadow)
    {
        $this->shadow = $shadow;
    }
}
