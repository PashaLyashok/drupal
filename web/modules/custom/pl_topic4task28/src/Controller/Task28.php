<?php
/**
 * @file
 * Contains \Drupal\pl_topic4task28\Controller\Task28.
 */
namespace Drupal\pl_topic4task28\Controller;

use Drupal\Core\Controller\ControllerBase;

class Task28 extends ControllerBase{

  /**
   * Returns a simple page with five nodes.
   */
  public function content($count) {

    $block = \Drupal\block\Entity\Block::load('helloblock');
    $block_content = \Drupal::entityTypeManager()
      ->getViewBuilder('block')
      ->view($block);

    return [
        '#type' => 'container',
        '#theme' => 'my_task28',
        '#count' => $count,
        "#data" => $block_content,
        '#weight' => 0,
      ];
  }
}
