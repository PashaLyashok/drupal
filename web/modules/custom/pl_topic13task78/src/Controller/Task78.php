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
   * Returns a simple page with five nodes.
   */
  public function content() {
    $user = \Drupal::currentUser()->id();
    $user = User::load($user);
    $user_name = $user->name->getValue();
    $user_name[0]['value'];

    if (!empty($user_name[0]['value'])) {
      \Drupal::cache()
        ->set('my_cache_for_user_name', $user_name[0]['value'], time() + 300);
      $current_user_name = \Drupal::cache()->get('my_cache_for_user_name')->data;
    } else {
      $current_user_name = 'Unregistered User';
    }
    return [
      '#markup' => 'User name: ' . $current_user_name,
    ];

  } 
}
