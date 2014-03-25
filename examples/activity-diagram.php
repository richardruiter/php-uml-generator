<?php

require_once '../bootstrap.php';

$renderer = new UmlGenerator\Renderer\PlantUML();
$diagram = new UmlGenerator\Diagram\Activity($renderer);

$skin = new UmlGenerator\Skin();
$skin->setBackgroundcolor('red');
$skin->setFontsize(30);
$skin->setShadow(false);

$diagram
    ->setActivitySkin($skin)
    ->start()
        ->activity('Activiteit 1')
        ->activity('Activiteit 2')
            ->right()
        ->activity('Activiteit 3')
            ->label('Mijn label')
            ->note('notitie')
            ->down()
        ->activity('Activiteit 4')
            ->label('Mijn label 4')
        ->activity('Activiteit 5')
            ->note('ja', 'left')
        ->activity('Activiteit 6')
            ->left()
        ->activity('Activiteit 7')
            ->down()
    ->end();

$diagram->renderImage();
exit;