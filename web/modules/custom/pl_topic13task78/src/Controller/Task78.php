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
    if (NULL != (\Drupal::cache()->get('my_cache_for_user_name_'. $user_id))) {
      $tags = [
        'user:' . $user_id,
      ];
      \Drupal::cache()->set('my_cache_for_user_name_'. $user_id, $user_name_str, CacheBackendInterface::CACHE_PERMANENT, $tags);
      $current_user_name = \Drupal::cache()->get('my_cache_for_user_name_' . $user_id)->data;
    } else {
      $current_user_name = \Drupal::cache()->get('my_cache_for_user_name_' . $user_id)->data;
    }
    
    return [
      '#markup' => 'name: ' . $current_user_name,
    ];
  } 
}
