# Copilot Instructions for AI Coding Agents

## Project Overview
This is a PHP web application for a community platform ("PRO Community"). The codebase is organized by feature and responsibility, with a focus on modularity and clarity. The main entry point is `index.php`, with supporting pages for authentication, user management, and dashboard functionality.

## Key Architectural Components
- **Configuration**: All environment, database, and site settings are in `conf.php`. This file is required by most scripts and should be kept up to date. Use `conf.sample.php` as a template.
- **Database**: Database migrations and seeders are managed via scripts in `database/` (`migrations.php`, `seeders.php`).
- **Autoloading**: Classes are autoloaded via `ClassAutoLoad.php`.
- **Core Logic**: Business logic and helpers are in `Globals/` (e.g., `fncs.php`, `SendMail.php`).
- **Forms and Tables**: Form definitions are in `Forms/forms.php`. Table-related logic is in `Tables/`.
- **Authentication**: Auth logic is in `Proc/auth.php` and related files.
- **Mail**: Email sending uses PHPMailer, located in `Plugins/PHPMailer/`.

## Developer Workflows
- **Setup**: Copy `conf.sample.php` to `conf.php` and fill in credentials.
- **Database**: Run migrations and seeders from the `database/` directory:
  ```sh
  cd database
  php migrations.php   # Sets up DB structure
  php seeders.php      # Seeds initial data
  ```
- **Debugging**: In development, error reporting is enabled by default (see `conf.php`).
- **Language**: Site language is set in `conf.php` and loaded from `Lang/`.

## Project Conventions
- **Configuration**: All config is centralized in `conf.php`.
- **URL Construction**: Use `$conf['site_url']` for base URLs. This is dynamically set based on environment.
- **Session Management**: Sessions are started in `conf.php` if not already active.
- **Email**: Use the PHPMailer integration in `Plugins/PHPMailer/` for all outgoing mail.
- **Password Policy**: Minimum password length is set in `conf.php` (`min_password_length`).
- **Valid Email Domains**: Controlled via `conf.php` (`valid_email_domains`).

## Integration Points
- **PHPMailer**: All mail logic is in `Plugins/PHPMailer/`.
- **Language Files**: Add new languages in `Lang/` and update `conf.php` to use them.

## Examples
- To add a new form, update `Forms/forms.php`.
- To add a new user table, update `Tables/user_list.php`.
- To change the site slogan, update `conf.php` (`site_slogan`).

## References
- Main config: `conf.php`
- Database scripts: `database/migrations.php`, `database/seeders.php`
- Mail: `Plugins/PHPMailer/`
- Helpers: `Globals/`
- Forms: `Forms/forms.php`
- Tables: `Tables/`

---
If you are unsure about a workflow or pattern, check for examples in the referenced files or ask for clarification.
