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
    date_default_timezone_set('Europe/Minsk');
    $date = date('m/d/Y h:i:s a', time());
    
    return [
        '#theme' => 'my_task94',
        "#data" => $date,
        '#attached' => [
            'library' => ['pl_topic1task94/my-lib'],
        ],
      ];
  }
}
