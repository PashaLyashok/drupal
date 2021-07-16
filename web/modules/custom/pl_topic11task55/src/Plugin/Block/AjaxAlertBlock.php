<?php
/**
 * @file 
 * Contains\Drupal\pl_topic11task55\Controller\AjaxAlertBlock.
 */

namespace Drupal\pl_topic11task55\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;
use Drupal\Core\Link;
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
    $query = ['foo' => 'bar'];
    $options = array(
      'fragment' => 'anchor-div',
      'attributes' => ['class' => ['use-ajax'], 'rel' => 'nofollow'],
    );
    $url = Url::fromRoute('pl_topic11task55.routing', $query, $options);
    $internal_link = Link::fromTextAndUrl($this->t('Click for Alert'), $url);
    $internal_link = $internal_link->toString();

    return [
      '#markup' => $internal_link,
    ];
  }
}
