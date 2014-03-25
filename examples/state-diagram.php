<?php

require_once '../bootstrap.php';

$renderer = new UmlGenerator\Renderer\PlantUML();
$diagram = new UmlGenerator\Diagram\State($renderer);

// diagram skin
$diagramskin = new UmlGenerator\Skin();
$diagramskin->setBackgroundcolor('silver');

// state skin
$stateskin = new UmlGenerator\Skin();
$stateskin->setBackgroundcolor('#313841');
$stateskin->setLinecolor('white');
$stateskin->setFontcolor('white');

// state skin PortingConfirmed
$stateskin1 = new UmlGenerator\Skin();
$stateskin1->setBackgroundcolor('red');
$stateskin1->setLinecolor('white');
$stateskin1->setFontcolor('white');

$diagram
    ->setDiagramSkin($diagramskin)
    ->setStateSkin($stateskin)
    ->setStateSkin($stateskin1, 'PlandateConfirmed')
    ->start()
        ->transition('New', 'Available')
        ->transition('New', 'NotAvailable')->end()
        ->transition('Available', 'FirstLetterSent')
        ->transition('FirstLetterSent', 'Migration DateSet')
        ->transition('FirstLetterSent', 'PlandateConfirmed')
        ->transition('MigrationDateSet', 'MigrateRequested')
        ->transition('MigrateRequested', 'PlandateConfirmed')
        ->transition('PlandateConfirmed', 'PortingRequested')
        ->transition('PortingRequested', 'PortingConfirmed')
        ->transition('PortingConfirmed', 'VoipCreated')
        ->transition('PlandateConfirmed', 'VoipCreated')
        ->transition('VoipCreated', 'ServicesPlanned')
        ->transition('PlandateConfirmed', 'ServicesPlanned')
        ->transition('ServicesPlanned', 'SecondLetterSent')
        ->transition('SecondLetterSent', 'WaitingForConfimation')
        ->transition('WaitingForConfimation', 'StartMigration')
    ->end();

$diagram->renderImage();
exit;