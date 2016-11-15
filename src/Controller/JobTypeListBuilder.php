<?php

namespace Drupal\job\Controller;

use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Entity\EntityInterface;

class JobTypeListBuilder extends EntityListBuilder {
  public function buildHeader() {
    $header = [];
    $header['label'] = $this->t('Label');
    return $header + parent::buildHeader();
  }

  public function buildRow(EntityInterface $event) {
    $row = [];
    $row['label'] = $event->label();
    return $row + parent::buildRow($event);
  }

}
