<?php
/**
 * @file 
 * Contains\Drupal\pl_topic11task55\Controller\AjaxAlertBlock.
 */

namespace Drupal\pl_topic11task55\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'AjaxAlertBlock' Block.
 *
 * @Block(
 *   id = "ajax_alert",
 *   admin_label = @Translation("Ajax alert"),
 *   category = @Translation("Ajax Block"),
 * )
 */
class AjaxAlertBlock extends BlockBase {

  /**
   * Returns a block with link to js function alert('myMessage').
   */
  public function build() {
    
    $renderable = [
      '#markup' => '<a class="use-ajax" href="/topic11task55-ajax-link">Click for Alert</a>',
    ];
  
    return $renderable;
  }
}
