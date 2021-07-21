<?php
/**
 * @file
 * Contains \Drupal\pl_topic13task78\Controller\Task78.
 */
namespace Drupal\pl_topic13task78\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\user\Entity\User;
use Drupal\Core\Cache\CacheBackendInterface;

class Task78 extends ControllerBase {

  /**
   * Returns page with user name taked from cache.
   */
  public function content() {

    $user_id = \Drupal::currentUser()->id();
    $user = User::load($user_id);
    $user_name_arr = $user->name->getValue();
    $user_name_str = $user_name_arr[0]['value'];
    $tags = [
      'user:'. $user_id,
    ];
    if (\Drupal::cache()->get('my_cache_for_user_name_' . $user_id) === FALSE) {
      \Drupal::cache()->set('my_cache_for_user_name_' . $user_id, $user_name_str, CacheBackendInterface::CACHE_PERMANENT, $tags);
    } 
    $cache_user_name = \Drupal::cache()->get('my_cache_for_user_name_' . $user_id)->data;
    
    return [
      '#markup' => 'User name: ' . $cache_user_name,
    ];
  }
}
