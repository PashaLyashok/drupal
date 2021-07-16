<?php
/**
 * @file
 * Contains \Drupal\pl_topic11task55\Controller\AjaxLinkController
 */
namespace Drupal\pl_topic11task55\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\AlertCommand;

use Drupal\Core\Controller\ControllerBase;

class AjaxLinkController extends ControllerBase{

  public function customAjaxLinkAlert() {
    $response = new AjaxResponse();
    $response->addCommand(new AlertCommand('Hello Pasha!'));

    return $response;
  }
}
