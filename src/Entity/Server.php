<?php

namespace Drupal\bigcity_spigot_connector\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

class Server extends ContentEntityBase {

  /**
   * The servers IP address.
   *
   * @var string
   */
  private $serverIp;

  /**
   * The token the server needs to use to authenticate against the API.
   *
   * @var string
   */
  private $token;

  /**
   * The online status of the server.
   *
   * @var string
   */
  private $onlineStatus;

  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['server_ip'] = BaseFieldDefinition::create('string')
      ->setLabel('Server IP')
      ->setDescription('The IP address or domain used by the server.')
      ->setRequired(TRUE);

    $fields['online_status'] = BaseFieldDefinition::create('string')
      ->setLabel('Online Status')
      ->setDescription('Indicates if the server is online or not.')
      ->setRequired(TRUE);

    return $fields;
  }

  public function getServerIp() {
    return $this->get('server_id')->value;
  }

  public function setServerIp($serverIp) {
    $this->set('server_ip', $serverIp);
    return $this;
  }

  public function getOnlineStatus() {
    return $this->get('server_status')->value;
  }

  public function setOnlineStatus($onlineStatus) {
    $this->set('online_status', $onlineStatus);
    return $this;
  }

}
