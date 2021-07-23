<?php
namespace Drupal\pl_topic1task122\Event;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * Event firing on page and html preprocesses.
 */
class SimplePageLoad extends Event {

  /**
   * Called during hook_preprocess_page().
   */
  const PREPROCESS_HTML = 'pl_topic1task122.frontpage.preprocess_html';

  /**
   * Variables from preprocess.
   */
  protected $variables;

  /**
   * DummyFrontpageEvent constructor.
   */
  public function __construct($variables) {
    $this->variables = $variables;
  }

  /**
   * Returns variables array from preprocess.
   */
  public function getVariables() {
    return $this->variables;
  }

}