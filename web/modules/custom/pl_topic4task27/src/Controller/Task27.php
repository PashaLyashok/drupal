<?php
namespace Drupal\pl_topic4task27\Controller;

use Drupal\Core\Controller\ControllerBase;

class Task27 extends ControllerBase{

  /**
   * Returns a simple page with five nodes.
   */
  public function content() {

    $nodes = \Drupal::database()->select('node_field_data', 'n')
      ->fields('n')
      ->range(0, 5) // <--
      ->execute();

    foreach ($nodes as $node) {
      $items[] = ['title' => $node->title, 'created' => $node->created];
    }
    
    return [
      '#theme' => 'my_nodes_page',
      //'#nodes' => $this->t('Test Value'),
      '#nodes' => $items,
    ];
  }
}
