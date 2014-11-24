<?php
/**
 * @file
 * Contains \Drupal\administerusersbyrole\Access\AccessCheck.
 */

namespace Drupal\administerusersbyrole\Access;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Access\AccessCheckInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Checks access for displaying configuration translation page.
 */
class AccessCheck implements AccessCheckInterface {

  public function applies(Route $route) {
    return FALSE;
//    return '_access_yourmodule_page';
  }


  public function access(Route $route, Request $request, AccountInterface $account) {
    // TODO: ACCESS
    //return static::DENY;
    return AccessResult::allowedIfHasPermission($account, 'Edit users with no custom roles');
  }
}
?>
