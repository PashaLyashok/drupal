<?php
/**
 * @file
 * Contains \Drupal\pl_topic1task94\Controller\Task94.
 */
namespace Drupal\pl_topic1task94\Controller;

use Drupal\Core\Controller\ControllerBase;

class Task94 extends ControllerBase{

  /**
   * Returns a simple page with five nodes.
   */
  public function content() {    
    $date = date('m/d/Y H:i:s', \Drupal::time()
      ->getCurrentTime());
    
    return [
        '#theme' => 'my_task94',
        "#data" => $date,
        '#attached' => [
            'library' => ['pl_topic1task94/my-lib'],
        ],
      ];
  }
}
