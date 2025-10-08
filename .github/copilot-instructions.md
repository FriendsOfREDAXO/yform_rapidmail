# Copilot Instructions for YForm Rapidmail

## Project Overview

This is a REDAXO 5 add-on that integrates the Rapidmail newsletter service with YForm. It provides:
- Rapidmail PHP SDK integration
- Email address synchronization with recipient lists
- YForm action for newsletter signup

**Important**: This is NOT an official Rapidmail add-on, but a community-developed integration.

## Project Structure

```
/
├── .github/          # GitHub workflows and configuration
├── assets/           # Frontend assets (CSS, JS, images)
├── boot.php          # Add-on bootstrap file
├── lang/             # Language/translation files
├── lib/              # PHP libraries
│   ├── rapidmail/    # Rapidmail PHP SDK (third-party)
│   └── yform/        # YForm integration
│       └── action/   # YForm action classes
├── pages/            # Backend page handlers
├── package.yml       # REDAXO package configuration
└── README.md         # Documentation (in German)
```

## Technology Stack

- **Platform**: REDAXO 5 CMS (≥5.15)
- **PHP**: 8.1+ (based on workflow configuration)
- **Dependencies**: 
  - YForm (≥4.2.1)
  - Rapidmail PHP SDK (bundled in `lib/rapidmail/`)
  - Guzzle HTTP client (via Rapidmail SDK)

## Coding Standards

- **PHP CS Fixer**: The project uses PHP CS Fixer for code style enforcement
- Run via: `composer cs-fix` (see `.github/workflows/code-style.yml`)
- Code style is automatically fixed on push/PR via GitHub Actions
- PHP version: 8.1+ with extensions: gd, intl, pdo_mysql

## Key Components

### 1. YForm Action (`lib/yform/action/yform_rapidmail.php`)
- Class: `rex_yform_action_yform_rapidmail`
- Extends: `rex_yform_action_abstract`
- Purpose: Handles newsletter signup form submissions
- Key fields:
  - `list_id`: Rapidmail recipient list ID (required)
  - `email`: Email field name (required)
  - `optin`: DSGVO opt-in checkbox field (optional)
  - `fullname`: Full name field (optional)

### 2. API Configuration
- Stored in REDAXO config system via `rex_config`
- Keys: `api_user_hash`, `api_password_hash`
- Set via backend: YForm > Rapidmail > Einstellungen

### 3. Rapidmail SDK
- Location: `lib/rapidmail/`
- Main class: `Rapidmail\ApiClient\Client`
- Services: Recipients, Mailings, Stats, Jobs, etc.
- Documentation: `lib/rapidmail/docs/`

## Development Guidelines

### When Working with YForm Actions:
- Always check for validation errors before API calls: `count($this->params['warning_messages']) == 0`
- Use `dump()` for error output (REDAXO convention)
- Handle `ApiClientException` with proper HTTP status code checks (400, 401, 403, 406, 409, 415, 422)
- Send activation emails via modifier: `['send_activationmail' => 'yes']`

### API Usage Pattern:
```php
use Rapidmail\ApiClient\Client;
use rex_config;

$client = new Client(
    rex_config::get('yform_rapidmail', 'api_user_hash'),
    rex_config::get('yform_rapidmail', 'api_password_hash')
);

$recipientsService = $client->recipients();
```

### Form Field Definition Format:
```
action|yform_rapidmail|list_id|email_fieldname|opt:optin_fieldname|opt:fullname_fieldname
```

## DSGVO/Privacy Compliance

- Newsletter opt-in must be DSGVO-compliant (German data protection law)
- Use checkbox field for explicit consent
- Activation emails are sent by default (`send_activationmail` = 'yes')
- Only process subscriptions when opt-in is confirmed

## Testing

- No automated test suite currently exists
- Manual testing via REDAXO backend required
- Test API credentials in: YForm > Rapidmail > Einstellungen

## Documentation

- Main docs: `README.md` (German language)
- API docs: `lib/rapidmail/docs/*.md`
- Backend docs accessible at: YForm > Rapidmail > Docs page
- Uses `rex_markdown` for rendering documentation

## Important Notes

- **Language**: Documentation and UI strings are in German
- **No Composer**: Project doesn't use Composer at root level (Rapidmail SDK is bundled)
- **REDAXO Conventions**: Use `rex_*` classes, `dump()` for debugging, `rex_config` for settings
- **Backend Pages**: Defined in `package.yml` under `pages:` section
- **Permissions**: Use `yform_rapidmail[]` permission system

## Common Tasks

### Adding New Features:
1. Check if feature should be in YForm action or separate service
2. Follow REDAXO naming conventions (`rex_yform_action_*`)
3. Update `README.md` with examples (in German)
4. Test in REDAXO backend environment

### Fixing API Issues:
1. Check API credentials configuration
2. Review error handling in action class
3. Consult Rapidmail SDK docs in `lib/rapidmail/docs/`
4. Test with different HTTP error codes

### Updating Documentation:
1. Update `README.md` for user-facing changes
2. Update backend page handlers if docs page needs changes
3. Keep German language for consistency

## External Resources

- [Rapidmail API Documentation](https://developer.rapidmail.wiki/documentation.html)
- [Rapidmail PHP SDK](https://github.com/rapidmail/rapidmail-apiv3-client-php)
- [REDAXO Documentation](https://www.redaxo.org)
- [YForm Documentation](https://github.com/yakamara/redaxo_yform)
