<?php

namespace Drupal\profile_redirect_test\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\profile\Entity\Profile;
use Drupal\user\UserInterface;
use Symfony\Component\HttpFoundation\Response;

/**
 * Saves a main profile mid-request, then finishes its own work.
 */
class BackgroundSaveController extends ControllerBase {

  /**
   * Stands in for /membership-initiate: save the profile, then carry on.
   */
  public function save(UserInterface $user): Response {
    $profile = Profile::create(['type' => 'main', 'uid' => $user->id()]);
    $profile->save();
    $profile->setNewRevision(TRUE);
    $profile->save();
    return new Response('Background work finished.');
  }

}
