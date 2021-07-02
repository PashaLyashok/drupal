<?php
/**
 * @file
 * Contains \Drupal\pl_topic1task94\Controller\Task94.
 */
namespace Drupal\pl_topic1task94\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Datetime\DrupalDateTime;

class Task94 extends ControllerBase {

  /**
   * Returns a simple page with five nodes.
   */
  public function content() {    
    $date = new DrupalDateTime();
    
    return [
        '#theme' => 'my_task94',
        "#data" => $date->format('d-m-Y'),
        '#attached' => [
            'library' => ['pl_topic1task94/my-lib'],
        ],
    ];
  }
}
