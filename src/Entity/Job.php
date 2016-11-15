<?php

namespace Drupal\job\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Datetime\DrupalDateTime;

/**
 * Job custom entity type.
 *
 * @ContentEntityType(
 *   id = "job",
 *   label = @Translation("Job"),
 *   label_singular = @Translation("job"),
 *   label_plural = @Translation("jobs"),
 *   label_count = @PluralTranslation(
 *    singular = "@count job",
 *    plural = "@count jobs"
 *   ),
 *   base_table = "job",
 *   entity_keys = {
 *      "id" = "id",
 *      "uuid" = "uuid",
 *      "label" = "title",
 *      "bundle" = "type",
 *   },
 *   bundle_entity_type = "job_type",
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider",
 *     },
 *   "list_builder" = "Drupal\job\Controller\JobListBuilder",
 *   "form" = {
 *      "add" = "Drupal\job\Form\JobForm",
 *      "edit" = "Drupal\job\Form\JobForm",
 *      "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *     },
 *    "views_data" = "Drupal\views\EntityViewsData",
 *    "access" = "Drupal\job\Access\JobAccessControlHandler",
 *   },
 *   links = {
 *      "canonical" = "/job/{job}",
 *      "collection" = "/admin/content/jobs",
 *      "add-form" = "/admin/content/jobs/add/{job_type}",
 *      "add-page" = "/admin/content/jobs/add",
 *      "edit-form" = "/admin/content/jobs/manage/{job}",
 *      "delete-form" = "/admin/content/jobs/manage/{job}/delete",
 *   },
 *   admin_permission = "administer jobs",
 *   field_ui_base_route = "entity.job_type.edit_form",
 * )
 *
 * @package Content
 *
 * @extends Drupal\Core\Entity\ContentEntityBase
 *
 * @implements JobInterface
 */
class Job extends ContentEntityBase implements JobInterface {

  /**
   * Base field definitions.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   *    Entity Type.
   *
   * @return array|\Drupal\Core\Field\FieldDefinitionInterface[]
   *    Return type.
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setRequired(TRUE)
      ->setDisplayOptions('form', [
        'weight' => 0,
      ])
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayConfigurable('form', TRUE);

    $fields['date'] = BaseFieldDefinition::create('datetime')
      ->setLabel(t('Date'))
      ->setRequired(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'inline',
        'settings' => [
          'format_type' => 'html_date',
        ],
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'weight' => 10,
      ])
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayConfigurable('form', TRUE);

    $fields['description'] = BaseFieldDefinition::create('text_long')
      ->setLabel(t('Description'))
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'weight' => 10,
      ])
      ->setDisplayOptions('form', [
        'weight' => 20,
      ])
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayConfigurable('form', TRUE);

    $fields['published'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Published'))
      ->setDefaultValue(FALSE)
      ->setDisplayOptions('form', [
        'settings' => [
          'display_label' => TRUE,
        ],
        'weight' => 30,
      ])
      ->setDisplayConfigurable('view', TRUE)
      ->setDisplayConfigurable('form', TRUE);

    return $fields;
  }

  /**
   * Get Title.
   *
   * @return string|null
   *   Event title.
   */
  public function getTitle() {
    return $this->get('title')->value;
  }

  /**
   * Set the title.
   *
   * @param string $title
   *   String to set.
   *
   * @return $this
   *   Return updated object
   */
  public function setTitle($title) {
    return $this->set('title', $title);
  }

  /**
   * Get the date.
   *
   * @return mixed
   *   The date in correct format.
   */
  public function getDate() {
    return $this->get('date')->date;
  }

  /**
   * Set the Date.
   *
   * @param DrupalDateTime $date
   *    The date to set.
   *
   * @return $this
   *   Date in correct format.
   */
  public function setDate(DrupalDateTime $date) {
    return $this->set('date', $date->format(DATETIME_DATETIME_STORAGE_FORMAT));
  }

  /**
   * Get description.
   *
   * @return \Drupal\Component\Render\MarkupInterface
   *   Return the processed string.
   */
  public function getDescription() {
    return $this->get('description')->processed;
  }

  /**
   * Set a description.
   *
   * @param string $description
   *    The description.
   * @param string $format
   *    The format, defaults to restricted_html.
   *
   * @return $this
   *    The updated value.
   */
  public function setDescription($description, $format = "restricted_html") {
    return $this->set('description', [
      'value' => $description,
      'format' => $format,
    ]);
  }

  /**
   * Return publish status.
   *
   * @return $this
   *   TRUE/FALSE.
   */
  public function getPublished() {
    return (bool) $this->get('published');
  }

  /**
   * Publish the event.
   *
   * @return $this
   *   Publish.
   */
  public function publish() {
    return $this->set('published', TRUE);
  }

  /**
   * Unpublish.
   *
   * @return $this
   *   Unpublish.
   */
  public function unpublish() {
    return $this->set('published', FALSE);
  }
}
