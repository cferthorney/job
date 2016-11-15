<?php

namespace Drupal\job\Entity;

use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Interface EventInterface.
 *
 * @package Drupal\job\Entity
 *
 * @extends \Drupal\Core\Entity\ContentEntityInterface
 */
interface JobInterface extends ContentEntityInterface {

  /**
   * Get title.
   *
   * @return $this
   *     The object.
   */
  public function getTitle();

  /**
   * Set the title.
   *
   * @param string $title
   *    The title.
   *
   * @return $this
   *     The object.
   */
  public function setTitle($title);

  /**
   * Get the date.
   *
   * @return \Drupal\Core\Datetime\DrupalDateTime
   *     The DrupalDateTime object.
   */
  public function getDates();

  /**
   * Set the date.
   *
   * @param \Drupal\Core\Datetime\DrupalDateTime $date
   *   PHP DateTime object.
   *
   * @return $this
   *     The object.
   */
  public function setDates(DrupalDateTime $date);

  /**
   * Get the description.
   *
   * @return \Drupal\Component\Render\MarkupInterface
   *   Markup.
   */
  public function getDescription();

  /**
   * Set the description.
   *
   * @param string $description
   *    The description.
   * @param string $format
   *    Format.
   *
   * @return $this
   *     The object.
   */
  public function setDescription($description, $format);

  /**
   * Get the published status.
   *
   * @return $this
   *     The object.
   */
  public function getPublished();

  /**
   * Publish it.
   *
   * @return $this
   *     The object.
   */
  public function publish();

  /**
   * Unpublish it.
   *
   * @return $this
   *     The object.
   */
  public function unpublish();

}
