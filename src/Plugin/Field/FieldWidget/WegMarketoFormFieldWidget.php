<?php

namespace Drupal\weg_marketo_form_field\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\Plugin\Field\FieldWidget\StringTextfieldWidget;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'weg_marketo_form_field_widget' widget.
 *
 * @FieldWidget(
 *   id = "weg_marketo_form_field_widget",
 *   label = @Translation("WEG Marketo Form Field"),
 *   field_types = {
 *     "weg_marketo_form_field"
 *   }
 * )
 */
class WegMarketoFormFieldWidget extends StringTextfieldWidget {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $element = parent::formElement($items, $delta, $element, $form, $form_state);
    $element['success_message'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Success Message'),
      '#default_value' => isset($items[$delta]->success_message) ? $items[$delta]->success_message : NULL,
      '#maxlength' => $this->getFieldSetting('max_length'),
    ];

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public static function afterBuild(array $element, FormStateInterface $form_state) {
    $element[0]['#type'] = 'fieldset';
    return parent::afterBuild($element, $form_state);
  }

}
