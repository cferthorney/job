<?php

namespace Drupal\job\Controller;

use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

/**
 * Class JobListBuilder.
 *
 * @package Drupal\job\Controller
 *
 * @extends \Drupal\Core\Entity\EntityListBuilder
 */
class JobListBuilder extends EntityListBuilder {

  /**
   * Build the header.
   *
   * @return array
   *    header array.
   */
  public function buildHeader() {
    $header = [];
    $header['title'] = $this->t('Title');
    $header['date'] = $this->t('Date');
    $header['published'] = $this->t('Published');
    return $header + parent::buildHeader();
  }

  /**
   * Build row.
   *
   * @var \Drupal\Core\Entity\EntityInterface $job
   *    The job.
   *
   * @return array
   *    $row array and parent.
   */
  public function buildRow(EntityInterface $job) {
    /** @var \Drupal\job\Entity\JobInterface $job */
    $row = [];
    $row['title'] = $job->toLink($job->getTitle(), 'canonical');
    $row['date'] = $job->getDate()->format('d/m/y');
    $row['published'] = $job->getPublished() ? $this->t('Yes') : $this->t('No');
    return $row + parent::buildRow($job);
  }

}
