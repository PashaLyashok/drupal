<?php
/**
 * @file
 * Contains \Drupal\pl_topic4task30\Controller\Task30.
 */
namespace Drupal\pl_topic4task30\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

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
   * Checks access for a specific request.
   */
  public function access(AccountInterface $account) {
    self::checkTime();
    self::checkRole();
    return AccessResult::allowedIf(self::checkRole() != false && self::checkTime() == true);
  }

  /**
   * Returns a simple page with five nodes.
   */
  public function content() {
    return [
      '#theme' => 'my_task30',
      '#data' => 'Hello, Manager!',
    ];
  } 
}
