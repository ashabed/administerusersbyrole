<?php

/**
 * @file
 * Contains \Drupal\administerusersbyrole\AdministerusersbyrolePermissions.
 */

namespace Drupal\administerusersbyrole;

use Drupal\Component\Utility\String;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Entity\EntityManagerInterface;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides dynamic permissions of the administerusersbyrole module.
 */
class AdministerusersbyrolePermissions implements ContainerInjectionInterface {

  use StringTranslationTrait;

  /**
   * The entity manager.
   *
   * @var \Drupal\Core\Entity\EntityManagerInterface
   */
  protected $entityManager;

  /**
   * Constructs a new AdministerusersbyrolePermissions instance.
   *
   * @param \Drupal\Core\Entity\EntityManagerInterface $entity_manager
   *   The entity manager.
   */
  public function __construct(EntityManagerInterface $entity_manager) {
    $this->entityManager = $entity_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('entity.manager'));
  }

  /**
   * Returns an array of administerusersbyrole permissions.
   *
   * @return array
   */
  public function permissions() {

  $roles = user_roles();
  $permissions = [];

  foreach ($roles as $rid => $role) {
    $role_label = $role->label();
    foreach (array('edit', 'cancel') as $op) {
      // edit/cancel x.
      $perm_string = _administerusersbyrole_build_perm_string($role_label, $op, FALSE);
      $perm_title = ucfirst($perm_string);
      $permissions[$perm_string] = array('title' => $perm_title);

      // edit/cancel $op x and other.
      $perm_string = _administerusersbyrole_build_perm_string($role_label, $op, TRUE);
      $perm_title = ucfirst($perm_string);
      $permissions[$perm_string] = array('title' => $perm_title);
    }
  }
    return $permissions;
  }

}
