<?php
/**
 * @file
 * Contains \Drupal\pl_topic11task56\Controller\AjaxLinkController
 */
namespace Drupal\pl_topic11task56\Controller;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Controller\ControllerBase;

class AjaxLinkController extends ControllerBase{

  public function customAjaxLinkAlert() {
    $response = new AjaxResponse();
    $response->addCommand(new OpenModalDialogCommand('Modad Title', 'Modal content' , ['width' => '400', 'height' => '400']));

    return $response;
  }
}
