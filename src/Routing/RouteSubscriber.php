<?php
/**
 * @file
 * Contains \Drupal\administerusersbyrole\Routing\RouteSubscriber.
 */

namespace Drupal\administerusersbyrole\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  public function alterRoutes(RouteCollection $collection) {
      // Change path '/user/login' to '/login'.
      if ($route = $collection->get('entity.user.edit_form')) {
        $route->setRequirement('_access', 'FALSE');
  //      $route->setPath('/login');
        dpm($route, 'route deny login access');
      }
      // Always deny access to '/user/logout'.
      // Note that the second parameter of setRequirement() is a string.
      //if ($route = $collection->get('user.logout')) {
        //$route->setRequirement('_access', 'FALSE');
      //}
  }
}
?>
