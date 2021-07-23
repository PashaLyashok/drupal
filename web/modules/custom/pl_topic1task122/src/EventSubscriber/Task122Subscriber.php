<?php

namespace Drupal\pl_topic1task122\EventSubscriber;

use Drupal\pl_topic1task122\Event\SimplePageLoad;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Dummy event subscriber.
 */
class Task122Subscriber implements EventSubscriberInterface {
  public static function getSubscribedEvents() {
    return [
      SimplePageLoad::PREPROCESS_HTML => ['preprocessHtml', 100],
    ];
  }

  public function preprocessHtml(SimplePageLoad $event) {
    \Drupal::logger('Simple Page')->notice('Simple Page Loaded');
  }
}
