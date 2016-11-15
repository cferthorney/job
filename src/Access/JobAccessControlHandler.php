<?php

namespace Drupal\job\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Class JobAccessControlHandler.
 *
 * @package Drupal\job\Access
 *
 * @extends \Drupal\Core\Entity\EntityAccessControlHandler
 */
class JobAccessControlHandler extends EntityAccessControlHandler {

  /**
   * Check create access.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *    The account.
   * @param array $context
   *    Context array.
   * @param mixed|null $entity_bundle
   *    Any entity bundle.
   *
   * @return \Drupal\Core\Access\AccessResult|static
   *    Return an access result.
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    $access_result = AccessResult::allowedIfHasPermission($account, 'create jobs');
    return $access_result->orIf(parent::checkCreateAccess($account, $context, $entity_bundle));
  }

  /**
   * Check access is allowed.
   *
   * @param \Drupal\Core\Entity\EntityInterface $job
   *    Entity.
   * @param string $operation
   *    Operation.
   * @param \Drupal\Core\Session\AccountInterface $account
   *    Account interface.
   *
   * @return static
   *   Return access result.
   */
  protected function checkAccess(EntityInterface $job, $operation, AccountInterface $account) {
    /** @var \Drupal\job\Entity\JobInterface $job */
    /** @var \Drupal\Core\Access\AccessResult $access_result */
    // The parent class grants access based on the administrative permission.
    $access_result = parent::checkAccess($job, $operation, $account);
    switch ($operation) {
      case "view":
        // Only allow administrators to view unpublished jobs.
        // Also remember that there is role caching.
        // TODO investigate.
        if ($job->getPublished()) {
          $permission = 'view jobs';
        }
        else {
          $permission = 'administer jobs';
        }
        $access_result->addCacheableDependency($job);
        break;

      case "update":
        $permission = 'edit jobs';
        break;

      case "delete":
        $permission = 'delete jobs';
        break;

    }
    return $access_result->orIf(AccessResult::allowedIfHasPermission($account, $permission));
  }

}
