<?php 
/**
 * @file
 * Contains Drupal\pl_topic1task113\Plugin\Filter\CapitalizeFilter.
 */

namespace Drupal\pl_topic1task113\Plugin\Filter;

use Drupal\filter\Plugin\FilterBase;
use Drupal\filter\FilterProcessResult;
use Drupal\Core\Form\FormStateInterface;

/**
 * @Filter(
 *  id = "capitalize_word",
 *  title = @Translation("Words are Capitalized"),
 *  description = @Translation("Make some words capitalized"),
 *  type = Drupal\filter\Plugin\FilterInterface::TYPE_MARKUP_LANGUAGE,
 *  settings = {
 *    "word_for_capitalize" = "example",
 *  }
 * )
 */
class CapitalizeFilter extends FilterBase {
  
  /**
   * Filter setting form.
   */
  public function settingsForm(array $form, FormStateInterface $form_state) {
    $form['word_for_capitalize'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Search'),
      '#default_value' => $this->settings['word_for_capitalize'],
      '#maxlength' => 1024,
      '#size' => 250,
    ];

    return $form;
  }
  /**
   * Filter logic execution.
   */
  public function process($text, $langcode) {
    $result = new FilterProcessResult($text);
    $text = str_replace($this->settings['word_for_capitalize'], ucfirst($this->settings['word_for_capitalize']), $text);
    $result->setProcessedText($text);

    return $result;
  }
}
