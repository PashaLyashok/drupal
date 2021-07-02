<?php
/**
 * @file
 * Contains \Drupal\pl_topic5task31\Form\CollectPhone.
 */

namespace Drupal\pl_topic5task31\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class FormTask31 extends FormBase {

  public function getFormId() {
    return 'form_task31';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Your email address'),
    ];

    $form['username'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Your username'),
    ];

    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Send your data'),
      '#button_type' => 'primary'
    ];

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

    \Drupal::logger('pl_topic5task31')->notice('Thank you @username, your email address is @email', [
        '@username' => $form_state->getValue('username'),
        '@email' => $form_state->getValue('email'), 
    ]);
  }

}