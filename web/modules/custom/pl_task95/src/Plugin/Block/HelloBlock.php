<?php

namespace Drupal\pl_task95\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello block"),
 *   category = @Translation("Hello World"),
 * )
 */
class HelloBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    
    $renderable = [
        '#theme' => 'hello_block',
        '#test_var' => 'Hello, World!',
      ];
  
    return $renderable;
  }
}
