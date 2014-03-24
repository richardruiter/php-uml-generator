<?php

require_once '../bootstrap.php';

$renderer = new UmlGenerator\Renderer\PlantUML();
$diagram = new UmlGenerator\Diagram\State($renderer);

$diagram
    ->start()
        ->state('State 1')
        ->transition('State 1', 'State 6')->label('bla')
        ->transition('State 1', 'State 7')
        ->state('State 2')
        ->state('State 3')
        ->state('State 4')->note('error')
        ->state('State 5')
        ->state('State 6')
        ->state('State 7')
    ->end();

$diagram->renderImage();
exit;