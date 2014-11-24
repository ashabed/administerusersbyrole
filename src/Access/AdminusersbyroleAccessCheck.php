<?php
/**
 * @file
 * Contains \Drupal\administerusersbyrole\Access\CustomAccessCheck.
 */

namespace Drupal\administerusersbyrole;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Access\AccessCheckInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Checks access for displaying configuration translation page.
 */
class AdministerusersbyroleAccessCheck implements AccessCheckInterface {

  /**
   * Checks access.
   *
   * @param \Drupal\Core\Session\AccountInterface $account
   *   The currently logged in account.
   *
   * @return \Drupal\Core\Access\AccessResultInterface
   *   The access result.
   */
  public function access(AccountInterface $account) {
    // Check permissions and combine that with any custom access checking needed. Pass forward
    // parameters from the route and/or request as needed.
    return $account->hasPermission('do example things') && $this->someOtherCustomCondition();
  }
}
?>
