# Profile Registration Redirect Module

This Drupal module customizes the user registration and profile completion process by handling redirections based on query parameters such as `profile`, `nextpage`, and `destination`.

The purpose is to allow a path where new users refered from a payment sysytem first fill in basic information for their drupal account, and then are directed to the approipriate profile page. The nextpage option allows the page following that to also be specificed.

## Features

- **Profile-Based Redirection:**  
  Redirect users to their profile page (`/user/{uid}/main`) upon registration if `profile=main` is provided.
- **Destination Handling:**  
  Supports `destination` parameter for redirection to a specific page after registration, overriding other redirects.
- **Next Page Parameter:**  
  Passes a `nextpage` query parameter to the profile page to guide users to their next step after profile completion.
- **Fallback to User Account Page:**  
  If no query parameters are provided, users are redirected to their default user account page.

## Installation

1. Place the module files in your Drupal site's `modules/custom/profile_registration_redirect` directory.
2. Enable the module using Drupal's admin interface or via Drush:

   ```sh
   drush en profile_registration_redirect -y
