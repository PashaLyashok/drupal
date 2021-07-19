<?php
/**
 * @file
 * Contains \Drupal\pl_topic13task78\Controller\Task78.
 */
namespace Drupal\pl_topic13task78\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\Entity\User;

class Task78 extends ControllerBase {

  /**
   * Returns page with user name taked from cache.
   */
  public function content() {
    $user_id = \Drupal::currentUser()->id();
    \Drupal::cache()->set('my_cache_for_user_name_' . $user_id, $user_id, time()  + 300);
    $uid = \Drupal::cache()->get('my_cache_for_user_name_' . $user_id)->data;
    $user = User::load($uid);
    $user_name = $user->name->getValue();
    
    return [
      '#markup' => 'User name: ' . $user_name[0]['value'],
    ];
  } 
}
