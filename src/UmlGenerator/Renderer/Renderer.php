<?php

namespace UmlGenerator\Renderer;

use UmlGenerator\Diagram\Diagram;

/**
 * Description of Renderer
 *
 * @author rruiter
 */
abstract class Renderer
{
    abstract public function generate(Diagram $diagram);
    abstract public function getImageData(Diagram $diagram);
    abstract public function getElement($id);
}
