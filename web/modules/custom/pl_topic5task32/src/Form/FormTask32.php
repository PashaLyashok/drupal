<?php
/**
 * @file
 * Contains \Drupal\pl_topic5task32\Form\CollectPhone.
 */

namespace Drupal\pl_topic5task32\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\taxonomy\Entity\Term;

class FormTask32 extends FormBase {

  public function getCountriesNames() {

    $query = \Drupal::entityQuery('taxonomy_term');
    $query->condition('vid', 'country');
    $result = $query->execute();

    $countries = Term::loadMultiple($result);
    $countries_list = [];
    
    foreach ($countries as $country) {
      $countries_list[$country->id()] = $country->name->value;
    }


    return $countries_list;
  }

  public function getCitiesListByCountryId($country_id) {

    $query = \Drupal::entityQuery('taxonomy_term');
    $query->condition('vid', 'city');
    $query->condition('field_country', $country_id);
    $result = $query->execute();

    $cities = Term::loadMultiple($result);
    $cities_list = [];//'' => '-- choose your country --',

    foreach ($cities as $city) {
      $cities_list[$city->id()] = $city->name->value;
    }
      
    return $cities_list;
  }

  public function getFormId() {
    return 'form_task32';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    
    $form['country'] = [
      '#type' => 'select',
      '#title' => $this->t('Country'),
      '#options' =>  $this->getCountriesNames(),
      '#ajax' => [
        'callback' => '::myAjaxCallback',
        'disable-refocus' => FALSE,
        'event' => 'change',
        'wrapper' => 'edit-city',
        'progress' => [
          'type' => 'throbber',
          'message' => $this->t('Verifying country...'),
        ],
      ]
    ];

    $country_id = $form_state->getValue('country');

    $form['city'] = [
      '#type' => 'select',
      '#empty_option' => $this->t('-- choose your country --'),
      '#title' => $this->t('City'),
      '#options' => $this->getCitiesListByCountryId($country_id),
      '#prefix' => '<div id="edit-city">',
      '#suffix' => '</div>',
    ];

    $form['actions']['#type'] = 'actions';

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Send your data'),
      '#button_type' => 'primary',
    ];

    $form['#attached']['library'][] = 'pl_topic5task32/my-lib';

    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
    
    $city = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->load($form_state->getValue('city'));
    if (!is_object($city)) {
      $form_state->setErrorByName('city', $this->t('Choose available city from list!!!'));
    } 
  }

  public function myAjaxCallback(array &$form, FormStateInterface $form_state) {
    
    return $form['city']; 
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {

    $city = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->load($form_state->getValue('city'));
    $city_title = $city->name->value;

    $country = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->load($form_state->getValue('country'));
    $country_title = $country->name->value;

    \Drupal::logger('pl_topic5task32')->notice('Город @city, Страна @country', [
        '@city' => $city_title,
        '@country' => $country_title, 
    ]);
  }
}
