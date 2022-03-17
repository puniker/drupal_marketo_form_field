<?php

namespace Drupal\weg_marketo_form_field\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\FormatterBase;

/**
 * Plugin implementation of the 'weg_marketo_form' formatter.
 *
 * @FieldFormatter(
 *   id = "weg_marketo_form",
 *   label = @Translation("Weg Marketo Form"),
 *   field_types = {
 *     "weg_marketo_form_field",
 *   },
 * )
 */
class WegMarketoForm extends FormatterBase {

  //use EncryptionTrait;

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = [];
    $munchkinId = \Drupal::config("weg_core.settings")->get('weg_munchkin');
    $instanceHost = 'soluciones.grupocajarural.com';

    foreach ($items as $delta => $item) {
      $elements[$delta] = [
        '#type' => 'inline_template',
        '#template' => '
          <script src="//{{ instance_host }}/js/forms2/js/forms2.min.js"></script>
          <form id="mktoForm_{{ weg_marketo_form_id }}"></form>',
        '#context' => [
          'weg_marketo_form_id' => $item->value,
          'instance_host' => $instanceHost,
        ],
        '#attached' => [
          'library' => ['weg_marketo_form_field/weg-marketo-form'],
          'drupalSettings' => [
            'weg_marketo_form_field' => [
              'marketoForms' => [
                $item->value =>[
                  'formId' => $item->value,
                  'successMessage' => $item->success_message ?: 'Thank you for submitting.',
                ],
              ],
              'munchkinId' => $munchkinId,
              'instanceHost' => "//$instanceHost",
            ],
          ],
        ],
      ];
    }
    return $elements;
  }

}
