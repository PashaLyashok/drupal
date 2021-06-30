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
   * Checks access for a specific request.
   */
  public function access(AccountInterface $account) {
    $current_user = \Drupal::currentUser();
    $roles = $current_user->getRoles();
    $request_time = \Drupal::time()
      ->getCurrentTime();
    $manager_role = in_array('manager', $roles);
    $even_time = $request_time % 2;

    return AccessResult::allowedIf($manager_role != false && $even_time == true);
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
