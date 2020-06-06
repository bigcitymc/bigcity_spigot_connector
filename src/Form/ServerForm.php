<?php

namespace Drupal\bigcity_spigot_connector\Form;

use Drupal\bigcity_spigot_connector\Entity\Server;
use Drupal\bigcity_spigot_connector\Token;
use Drupal\Core\Entity\EntityStorageException;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ServerForm extends FormBase {

  public function getFormId() {
    return 'bc.spigot_connector.server_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = [];

    $form['server_ip'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Server-IP'),
      '#required' => TRUE,
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    /** @var \Drupal\bigcity_spigot_connector\Entity\Server[] $servers */
    $servers = Server::loadMultiple();
    $ipExists = FALSE;
    $ip = $form_state->getValue('server_ip');

    foreach($servers as $server) {
      if ($ipExists) {
        continue;
      }

      if ($server->getServerIp() == $ip) {
        $ipExists = TRUE;
        continue;
      }
    }

    parent::validateForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $formValues = $form_state->getValues();

    $token = Token::generate();

    /** @var Server $server */
    $server = Server::create();
    $server->setServerIp($formValues['server_ip']);
    $server->setOnlineStatus('offline');
    $server->setAuthToken($token);
    try {
      $server->save();
    } catch (EntityStorageException $e) {
      \Drupal::messenger()->addError($e->getMessage());
    }
  }

}
