<?php

namespace Drupal\pl_topic13task83\Plugin\rest\resource;

use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;

/**
 * Provides a Demo Resource
 *
 * @RestResource(
 *   id = "demo_resource",
 *   label = @Translation("Demo Resource"),
 *   uri_paths = {
 *     "canonical" = "/service/getusers"
 *   }
 * )
 */
class DemoResource extends ResourceBase {
  /**
   * Responds to entity GET requests.
   * @return \Drupal\rest\ResourceResponse
   */
  public function get() {
    $users =  \Drupal::entityTypeManager()->getStorage('user')->loadMultiple();
    return new ResourceResponse($users);
  }
}