<?php

namespace Drupal\bigcity_spigot_connector\Controller;

use Drupal\bigcity_spigot_connector\Entity\Server;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Render\Element\Table;

class ServerController extends ControllerBase {

  public function list() {
    $serverArray = [];

    /** @var Server[] $servers */
    $servers = Server::loadMultiple();
    foreach($servers as $server) {
      $serverArray[] = $server->toArray();
    }
  }

}
