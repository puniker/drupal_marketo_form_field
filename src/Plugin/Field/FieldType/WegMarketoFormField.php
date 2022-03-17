<?php

namespace Drupal\weg_marketo_form_field\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\Field\Plugin\Field\FieldType\StringItem;
use Drupal\Core\StringTranslation\TranslatableMarkup;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'weg_marketo_form_field' field type.
 *
 * @FieldType(
 *   id = "weg_marketo_form_field",
 *   label = @Translation("Weg Marketo Form Field"),
 *   description = @Translation("This field the Marketo form field ID."),
 *   category = @Translation("Weg Marketo"),
 *   default_widget = "string_textfield",
 *   default_formatter = "weg_marketo_form"
 * )
 */
class WegMarketoFormField extends StringItem {

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties = parent::propertyDefinitions($field_definition);

    $properties['success_message'] = DataDefinition::create('string')
      ->setLabel(new TranslatableMarkup('Success Message'))
      ->setSetting('case_sensitive', $field_definition->getSetting('case_sensitive'))
      ->setRequired(TRUE);

    return $properties;
  }

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return [
      'columns' => [
        'value' => [
          'type' => $field_definition->getSetting('is_ascii') === TRUE ? 'varchar_ascii' : 'varchar',
          'length' => (int) $field_definition->getSetting('max_length'),
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
        'success_message' => [
          'type' => 'varchar',
          'length' => $field_definition->getSetting('max_length'),
          'binary' => $field_definition->getSetting('case_sensitive'),
        ],
      ],
    ];
  }

}
