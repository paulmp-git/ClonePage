# Clone Page

A super lightweight WordPress plugin that adds a one-click "Clone" option to duplicate pages.

## Description

Clone Page does one thing and does it well — it adds a "Clone" link to the page row actions in your WordPress admin. Click it, and you get an exact duplicate of your page opened in draft mode, ready to edit.

No bloat. No settings pages. No database tables. Just clone and go.

## Features

- **One-click cloning** — Clone link appears on hover in the Pages list
- **Complete duplication** — Copies title, content, excerpt, page template, custom fields, and all post meta
- **Draft mode** — Cloned pages are created as drafts and opened directly in the editor
- **Elementor compatible** — Preserves Elementor data and layouts
- **Lightweight** — Single file, ~100 lines of code, no external dependencies
- **Secure** — Uses WordPress nonces and capability checks

## Installation

### Manual Installation

1. Download the plugin files
2. Upload the `clone-page` folder to `/wp-content/plugins/`
3. Activate the plugin through the 'Plugins' menu in WordPress

### From GitHub

1. Download the latest release as a ZIP file
2. In WordPress admin, go to Plugins → Add New → Upload Plugin
3. Upload the ZIP file and activate

## Usage

1. Go to **Pages → All Pages** in your WordPress admin
2. Hover over any page
3. Click **Clone** in the row actions
4. The cloned page opens in the editor as a draft with "(Copy)" appended to the title

![Clone link location](https://via.placeholder.com/800x200?text=Clone+link+appears+in+row+actions)

## Requirements

- WordPress 4.7 or higher
- PHP 5.6 or higher

## Frequently Asked Questions

### Does it clone custom fields?

Yes. All post meta data is duplicated, including custom fields, page templates, and page builder data.

### Does it work with Elementor/Gutenberg/other page builders?

Yes. Since it clones all post meta, any page builder data stored in meta fields is preserved.

### Can I clone posts too?

Currently, this plugin only supports pages. For posts, you would need to modify the code or use a different plugin.

### Is it translation ready?

Yes. The plugin uses WordPress i18n functions and can be translated.

## Changelog

### 1.0.0
- Initial release

## License

This plugin is licensed under the GPL v2 or later.

```
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
```

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Support

If you encounter any issues or have questions, please [open an issue](../../issues) on GitHub.
