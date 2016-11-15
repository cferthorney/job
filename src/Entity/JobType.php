<?php

namespace Drupal\job\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Class JobType.
 *
 * @ConfigEntityType(
 *   id = "job_type",
 *   label = @Translation("Job type"),
 *   label_singular = @Translation("job type"),
 *   label_plural = @Translation("job types"),
 *   label_count = @PluralTranslation(
 *     singular = "@count job type",
 *     plural = "@count job types"
 *   ),
 *   config_prefix = "type",
 *   config_export = {
 *     "id",
 *     "label",
 *   },
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *   },
 *   handlers = {
 *     "list_builder" = "Drupal\job\Controller\JobTypeListBuilder",
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\DefaultHtmlRouteProvider",
 *     },
 *     "form" = {
 *       "add" = "Drupal\job\Form\JobTypeForm",
 *       "edit" = "Drupal\job\Form\JobTypeForm",
 *       "delete" = "Drupal\Core\Entity\EntityDeleteForm",
 *     },
 *   },
 *   links = {
 *     "collection" = "/admin/structure/job-types",
 *     "add-form" = "/admin/structure/job-types/add",
 *     "edit-form" = "/admin/structure/job-types/manage/{job_type}",
 *     "delete-form" = "/admin/structure/job-types/manage/{job_type}/delete",
 *   },
 *   admin_permission = "administer job types",
 *   bundle_of = "job",
 * )
 *
 * @package Drupal\job\Entity
 *
 * @extends \Drupal\Core\Config\Entity\ConfigEntityBase
 */
class JobType extends ConfigEntityBase {

  /**
   * ID.
   *
   * @var string $id
   *    The ID.
   */
  protected $id;

  /**
   * Label.
   *
   * @var string
   *   The label.
   */
  protected $label;
}
