<?php
namespace Drupal\pl_topic4task27\Controller;

use Drupal\Core\Controller\ControllerBase;

class Task27 extends ControllerBase{

  /**
   * Returns a simple page with five nodes.
   */
  public function content() {

    $nodes = \Drupal::database()->select('node_field_data', 'n')
      ->fields('n', ['title', 'created'])
      ->range(0, 5)
      ->execute();
    
    return [
      '#theme' => 'my_nodes_page',
      '#nodes' => $nodes,
    ];
  }
}
