# Name Generator Plugin

## Overview

The Name Generator Plugin is a dynamic WordPress tool that generates random names based on custom post metadata using AJAX technology.

## Features

-   AJAX-powered random name generation
-   Secure requests using WordPress nonces
-   Easy shortcode integration
-   Supports names stored in custom post meta
-   Dynamically fetches up to 5 unique random names

## Installation

### Automatic Installation

1. Download the plugin as a .zip file
2. Navigate to WordPress dashboard > Plugins > Add New
3. Click "Upload Plugin" and select the .zip file
4. Install and activate the plugin

### Manual Installation

1. Unzip the plugin files
2. Upload the `name-generator-plugin` folder to `/wp-content/plugins/`
3. Activate the plugin from WordPress dashboard > Plugins > Installed Plugins

## Usage

### Setting Up Metadata

Add a custom meta field to your post or page:

-   Key: `_names`
-   Value: Comma-separated list of names (e.g., `John, Sarah, Michael, Emma, Olivia`)

### Adding Name Generator to Posts/Pages

Use the shortcode `[random_names]` anywhere in post or page content.

#### Example

```
[random_names]
```

When the page loads, a name generator button will appear. Clicking the button fetches and displays random name suggestions.

## File Structure

```
name-generator-plugin/
├── assets/
│   └── script.js               # JavaScript for AJAX functionality
├── includes/
│   ├── meta.php                # Optional: Metadata processing
│   └── widget.php              # Optional: Widget logic
├── name-generator-plugin.php   # Main plugin file
└── README.md                   # Documentation
```

## AJAX Functionality

-   Uses WordPress AJAX to fetch random names
-   AJAX Endpoint: `admin-ajax.php`
-   Secured with WordPress nonce (`generate_names_nonce`)

### How It Works

1. Shortcode renders a button and empty list
2. Button click triggers AJAX request
3. Fetches up to 5 unique names from `_names` custom meta field
4. Displays names in the list

## Support

For issues or help, contact the author.

## Changelog

### Version 1.0

-   Initial release
-   AJAX-based name generator
-   Shortcode functionality

## Author

-   **Haroon Yamin**
-   Email: haroon.webdev@gmail.com
-   Linkedin: https://www.linkedin.com/in/haroon-webdev/
