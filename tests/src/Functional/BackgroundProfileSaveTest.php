<?php

namespace Drupal\Tests\profile_redirect\Functional;

use Drupal\profile\Entity\ProfileType;
use Drupal\Tests\BrowserTestBase;

/**
 * A profile saved by code must not hijack the request it was saved in.
 *
 * The returning-member payment step carries Chargebee's ?nextpage=video and
 * saves the profile to clear an old end date. The redirect hook used to send
 * /video and exit() there, so the payment was never linked (2026-10-13).
 *
 * @group profile_redirect
 */
class BackgroundProfileSaveTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['user', 'profile', 'profile_redirect', 'profile_redirect_test'];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stark';

  /**
   * A non-form route with ?nextpage runs to completion.
   */
  public function testBackgroundSaveIgnoresNextpage(): void {
    ProfileType::create(['id' => 'main', 'label' => 'Main'])->save();
    $account = $this->drupalCreateUser();

    $this->drupalGet('profile-redirect-test/background-save/' . $account->id(), ['query' => ['nextpage' => 'video']]);
    $this->assertSession()->pageTextContains('Background work finished.');
    $this->assertSession()->addressMatches('#/profile-redirect-test/background-save/#');
  }

}
