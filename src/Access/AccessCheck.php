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
    if ($route->getpath() == '/user/{user}/edit')
      return TRUE;
    if ($route->getpath() == '/user/{user}/cancel')
      return TRUE;
    if ($route->getpath() == '/admin/people/create')
      return TRUE;
    return FALSE;
  }

  public function access(AccountInterface $account, Route $route) {
    $other_user = \Drupal::request()->attributes->get('user');
    $path = $route->getPath();
    if ($path == '/user/{user}/edit') {
      $uid = $other_user->id();
      $roles = $other_user->getRoles();
      $can_edit = _administerusersbyrole_can_edit_user($uid, $roles);
      return AccessResult::allowedIf($can_edit);
    }
    if ($path == '/user/{user}/cancel') {
      $uid = $other_user->id();
      $roles = $other_user->getRoles();
      $can_cancel = _administerusersbyrole_can_cancel_user($uid, $roles);
      return AccessResult::allowedIf($can_cancel);
    }
    if ($path == '/admin/people/create') {
      return AccessResult::allowedIfHasPermission($account, 'create users');
    }
  }
}
?>
