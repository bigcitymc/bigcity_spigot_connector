<?php

namespace Drupal\bigcity_spigot_connector\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the Advertiser entity.
 *
 * @ingroup advertiser
 *
 * @ContentEntityType(
 *   id = "server",
 *   label = @Translation("Server"),
 *   base_table = "server",
 *   entity_keys = {
 *     "id" = "id",
 *     "uuid" = "uuid",
 *     "server_ip" = "server_ip",
 *     "auth_token" = "auth_token",
 *     "online_status" = "online_status",
 *   },
 * )
 */
class Server extends ContentEntityBase implements ContentEntityInterface {

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

    $fields['auth_token'] = BaseFieldDefinition::create('string')
      ->setLabel('Token')
      ->setDescription('Used to authenticate the server against Drupal.')
      ->setRequired(TRUE);

    return $fields;
  }

  public function getServerIp() {
    return $this->get('server_ip')->value;
  }

  public function setServerIp($serverIp) {
    $this->set('server_ip', $serverIp);
    return $this;
  }

  public function getOnlineStatus() {
    return $this->get('online_status')->value;
  }

  public function setOnlineStatus($onlineStatus) {
    $this->set('online_status', $onlineStatus);
    return $this;
  }

  public function getAuthToken() {
    return $this->get('auth_token')->value;
  }

  public function setAuthToken($onlineStatus) {
    $this->set('auth_token', $onlineStatus);
    return $this;
  }

  public function toArray() {
    return [
      'id' => $this->get('id')->value,
      'server_ip' => $this->getServerIp(),
      'online_status' => $this->getOnlineStatus(),
      'auth_token' => $this->getAuthToken(),
    ];
  }

}
