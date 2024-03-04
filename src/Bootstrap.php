<?php

/*
 * package   OpenEMR
 * link      http://www.open-emr.org
 * author    Sherwin Gaddis <sherwingaddis@gmail.com>
 * Copyright (c) 2023.
 * license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace Juggernaut\Module\HealthScribe;

use OpenEMR\Core\Kernel;
use OpenEMR\Events\Encounter\EncounterMenuEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class Bootstrap
{
    /**
     * @var EventDispatcherInterface The object responsible for sending and subscribing to events through the OpenEMR system
     */
    private $eventDispatcher;
    private ?Kernel $kernel;

    public function __construct(EventDispatcher $dispatcher, ?Kernel $kernel = null)
    {
        if (empty($kernel)) {
            $kernel = new Kernel();
        }

        $this->eventDispatcher = $dispatcher;
        $this->kernel = $kernel;
        $this->buildFormsDirectory();
    }

    public function subscribeToEvents(): void
    {
        $this->registerMenuItems();
    }

    public function registerMenuItems(): void
    {
        /**
         * @var EventDispatcherInterface $eventDispatcher
         * @var array $module
         * @global                       $eventDispatcher @see ModulesApplication::loadCustomModule
         * @global                       $module @see ModulesApplication::loadCustomModule
         */
        $this->eventDispatcher->addListener(EncounterMenuEvent::MENU_RENDER, [$this, 'addHealthScribeEncItem']);
    }

    public function addHealthScribeEncItem(EncounterMenuEvent $event): EncounterMenuEvent
    {
        $menu = $event->getMenuData();
        $menu['HealthScribe'] = [
                'children' => [
                    [
                        'state' => 1,
                        'directory' => 'healthscribe',
                        'id' => 14,
                        'unpackaged' => 1,
                        'date' => '2023-03-01 00:00:00',
                        'priority' => 0,
                        'aco_spec' => 'encounters|coding',
                        'LBF' => '',
                        'displayText' => 'Launch App',
                        ]
                ],
        ];
        $event->setMenuData($menu);
        return $event;
    }

    private function buildFormsDirectory(): void
    {
        $dir = dirname(__DIR__, 5) . DIRECTORY_SEPARATOR . 'interface/forms/healthscribe';
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
            chown($dir, 'www-data');
            $file = dirname(__FILE__) . "/../public/scribe/new.php";
            copy($file, $dir . DIRECTORY_SEPARATOR . 'new.php');
        }
    }
}
