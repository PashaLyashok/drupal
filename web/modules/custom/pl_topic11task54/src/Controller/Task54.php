<?php
/**
 * @file
 * Contains \Drupal\pl_topic11task54\Controller\Task54.
 */
namespace Drupal\pl_topic11task54\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Simple class to output page with js function.
 */
class Task54 extends ControllerBase {

  /**
   * Returns a page with JavaScript function alert('myMessage'),
   */
  public function content() {    
  
  return [
      '#markup' => 'Hello User',
      '#attached' => [
          'library' => ['pl_topic11task54/js_task54'],
      ],
  ];
  }
}
