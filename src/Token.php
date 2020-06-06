<?php

namespace Drupal\bigcity_spigot_connector;

class Token {

  public static function generate($length = 32) {
    try {
      return random_bytes($length);
    } catch (\Exception $e) {
      return self::generateFallbackRandomString($length);
    }
  }

  private static function generateFallbackRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
  }

}
