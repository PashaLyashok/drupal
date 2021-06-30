<?php
/**
 * @file
 * Contains \Drupal\pl_topic4task30\Controller\Task30.
 */
namespace Drupal\pl_topic4task30\Controller;

use Drupal\Core\Controller\ControllerBase;

class Task30 extends ControllerBase{

  /**
   * Cheking role of current user.
   */
  static function checkRole() {
    $current_user = \Drupal::currentUser();
    $roles = $current_user->getRoles();
    
    return in_array('manager', $roles);
  }

  /**
   * Cheking time for our conditions.
   */
  static function checkTime() {
    $request_time = \Drupal::time()
      ->getCurrentTime();
    
    return ($request_time % 2);
  }

  /**
   * Returns a simple page with five nodes.
   */
  public function content() {
    self::checkTime();
    self::checkRole();

    if ((self::checkRole() != false) && (self::checkTime() == true) ) {
      return [
        '#theme' => 'my_task30',
        '#data' => 'Hello, Manager!',
      ];
    } else {
      return [
        '#type' => 'markup',
        "#markup" => 'Sorry,403.',
      ];
    }
  }
}
