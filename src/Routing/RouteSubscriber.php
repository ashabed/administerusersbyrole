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
      // Deny access to edit form based on X.
      if ($route = $collection->get('entity.user.edit_form')) {
        $route->setRequirement('_access', 'FALSE');
        dpm($route, 'route deny login access');
      }
  }
}
?>
