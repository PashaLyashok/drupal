<?php
/**
 * @file
 * Contains \Drupal\pl_topic4task30\Controller\Task30.
 */
namespace Drupal\pl_topic4task30\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;
use Drupal\user\Entity\User;

class Task30 extends ControllerBase{

  /**
   * Checks access for a specific request.
   */
  public function access(AccountInterface $account) {
    $uid = $account->id();
    $user = User::load($uid);
    $request_time = \Drupal::time()
      ->getCurrentTime();
    $even_time = $request_time % 2;
    $has_manager_role = $user->hasRole('manager');
    $is_authenticated = $user->isAuthenticated();
    $cond_1 = $has_manager_role !== FALSE && $even_time === TRUE;
    $cond_2 = $is_authenticated !== FALSE && $even_time !== TRUE;
  
    return AccessResult::allowedIf($cond_1 !== FALSE || $cond_2 !== FALSE);
    
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
