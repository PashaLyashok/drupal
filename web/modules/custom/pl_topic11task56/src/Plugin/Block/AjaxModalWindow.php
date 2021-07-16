<?php
/**
 * @file 
 * Contains\Drupal\pl_topic11task56\Controller\AjaxModalWindow.
 */

namespace Drupal\pl_topic11task56\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Url;
use Drupal\Core\Link;
use Drupal\Component\Render\FormattableMarkup;
use Drupal\Component\Serialization\Json;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'AjaxModalWindow' Block.
 *
 * @Block(
 *   id = "ajax_modal_window",
 *   admin_label = @Translation("Ajax modal"),
 *   category = @Translation("Modal Block"),
 * )
 */
class AjaxModalWindow extends BlockBase {

  /**
   * Returns a block with link to js function alert('myMessage').
   */
  public function build() {
    $query = [];
    $options = array(
      'attributes' => ['class' => ['use-ajax'], 'data-dialog-type' => 'modal'],
    );
    $url = Url::fromRoute('pl_topic11task56.routing', $query, $options);
    $internal_link = Link::fromTextAndUrl($this->t('Browse modal window'), $url);
    $internal_link = $internal_link->toString();
    return [
      '#markup' => $internal_link,
      '#attached' => ['library' => ['core/drupal.dialog.ajax']],
    ];
  }
}
