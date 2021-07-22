<?php 
/**
 * @file
 * Contains Drupal\pl_topic1task113\Plugin\Filter\CapitalizeFilter.
 */

namespace Drupal\pl_topic1task113\Plugin\Filter;

use Drupal\filter\Plugin\FilterBase;
use Drupal\filter\FilterProcessResult;

/**
 * @Filter(
 *  id = "capitalize_word",
 *  title = @Translation("Words are Capitalized"),
 *  description = @Translation("Make some words capitalized"),
 *  type = Drupal\filter\Plugin\FilterInterface::TYPE_MARKUP_LANGUAGE,
 * )
 */
class CapitalizeFilter extends FilterBase {

  /**
   * Filter logic execution.
   */
  public function process($text, $langcode)
  {
    $result = new FilterProcessResult($text);
    $words_list = ['long', 'fact', 'a'];
    for ($i = 0; $i < count($words_list); $i++) {
      $text = str_replace($words_list[$i], ucfirst($words_list[$i]), $text);
      $result->setProcessedText($text);
    }
  
    return $result;
  }
}