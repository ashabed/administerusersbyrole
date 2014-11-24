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
//      return TRUE;
    return FALSE;
//    return '_access_yourmodule_page';
  }


  public function access(AccountInterface $account, Route $route) {
    dpm($account->id(),'user account id');
    $other_user = \Drupal::request()->attributes->get('user');
    dpm($other_user->id(), 'user object id');

    return AccessResult::allowedIf(_administerusersbyrole_can_edit_user($account, $other_user));


//      $account, 'edit users with no custom roles');
    return AccessResult::allowedIfHasPermission($account, 'edit users with no custom roles');
  }
}
?>
