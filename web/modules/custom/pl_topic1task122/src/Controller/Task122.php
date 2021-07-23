<?php
/**
 * @file
 * Contains \Drupal\pl_topic1task122\Controller\Task122.
 */
namespace Drupal\pl_topic1task122\Controller;

use Drupal\Core\Controller\ControllerBase;

class Task122 extends ControllerBase{

  /**
   * Returns an example pages.
   */
  public function content() {

    return [
      '#markup' => $this->t('qwe'),
    ];
  }
}
