<?php
/**
 * @file
 * Contains \Drupal\administerusersbyrole\Routing\RouteSubscriber.
 */

namespace Drupal\administerusersbyrole\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

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
dpm('route is good');
//setCondition instead of setRequirement
// $collection->setCondition('context.getMethod() == "POST"');

$account = \Drupal::currentUser();
        $route->setCondition('$account->id() == 1');
//        $route->setRequirement('_access', 'FALSE');
        dpm($route, 'route deny login access');
      }
  }
}
?>
