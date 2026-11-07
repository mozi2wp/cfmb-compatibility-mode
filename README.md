<p align="center">
  <img src=".wordpress-org/banner-1544x500.png" alt="CFMB Compatibility Mode - keep ACF get_field() and have_rows() working after migrating to CFMB" width="100%">
</p>

# CFMB Compatibility Mode

**Switch from ACF without breaking your theme.** CFMB Compatibility Mode keeps `get_field()`, `the_field()`, `have_rows()`, `get_sub_field()` and other Advanced Custom Fields template functions working after you migrate to the free [CFMB - Custom Fields Meta Box](https://wordpress.org/plugins/custom-fields-meta-box/) plugin. No template edits needed.

[![License: GPL v2+](https://img.shields.io/badge/license-GPLv2%2B-blue.svg)](https://www.gnu.org/licenses/gpl-2.0.html)
![PHP 7.4+](https://img.shields.io/badge/PHP-7.4%2B-777bb4.svg)
![WordPress 6.6+](https://img.shields.io/badge/WordPress-6.6%2B-21759b.svg)
![Version 1.0.0](https://img.shields.io/badge/version-1.0.0-green.svg)

**[Download on WordPress.org](https://wordpress.org/plugins/cfmb-compatibility-mode/)** · **[CFMB on GitHub](https://github.com/mozi2wp/cfmb)** · **[Website](https://mozi2wp.com/cfmb)**

## Why use it

You moved your field groups and values from ACF, ACF Pro or Secure Custom Fields (SCF) to CFMB with its **Switch Assistant**. Your theme still calls ACF functions. This plugin answers those calls with CFMB, so your site keeps showing the same content and you can update templates at your own pace.

- **Zero template changes** on day one of the migration.
- **Repeater and flexible content loops** keep working with `have_rows()` and `the_row()`.
- **Options pages** keep working with `get_field( 'phone', 'option' )`.
- **Safe next to ACF.** It pauses itself while ACF, ACF Pro or Secure Custom Fields is active.
- **Stores nothing.** Remove it once your templates use the `cfmb_` functions.

## Supported ACF functions

| ACF function | Answered by |
| --- | --- |
| `get_field()`, `the_field()` | `cfmb_get_field()`, `cfmb_the_field()` |
| `get_fields()`, `get_field_object()` | `cfmb_get_fields()`, `cfmb_get_field_object()` |
| `update_field()`, `delete_field()` | `cfmb_update_field()`, `cfmb_delete_field()` |
| `have_rows()`, `the_row()`, `reset_rows()` | `cfmb_have_rows()`, `cfmb_the_row()`, `cfmb_reset_rows()` |
| `get_sub_field()`, `the_sub_field()` | `cfmb_get_sub_field()`, `cfmb_the_sub_field()` |
| `get_row_layout()`, `get_row_index()` | `cfmb_get_row_layout()`, `cfmb_get_row_index()` (counted from 1, like ACF) |
| `acf_add_options_page()`, `acf_add_options_sub_page()` | `cfmb_add_options_page()` |

ACF arguments are translated for you:

- `false` / `null` → the current post
- `'option'` / `'options'` → the CFMB options page that has the field
- `'user_5'`, `'term_12'`, `'comment_3'` → the same object in CFMB
- `'{taxonomy}_12'` (ACF's older term format) → `term_12`
- `field_…` keys → the field the Switch Assistant imported from that key

## Example

This ACF template keeps working unchanged:

```php
<h1><?php the_field( 'subtitle' ); ?></h1>

<?php while ( have_rows( 'sections' ) ) : the_row(); ?>
	<?php if ( 'hero' === get_row_layout() ) : ?>
		<h2><?php the_sub_field( 'heading' ); ?></h2>
	<?php endif; ?>
<?php endwhile; ?>

<p><?php echo esc_html( get_field( 'phone', 'option' ) ); ?></p>
```

## Migrate from ACF to CFMB in 4 steps

1. Install [CFMB - Custom Fields Meta Box](https://wordpress.org/plugins/custom-fields-meta-box/) and run **CFMB > Switch Assistant**.
2. Install and activate **CFMB Compatibility Mode**.
3. Deactivate ACF or Secure Custom Fields. The theme keeps working.
4. Replace `get_field()` with `cfmb_get_field()` over time, then remove this plugin.

## Safe next to ACF

The functions are never defined while ACF, ACF Pro or Secure Custom Fields is active. A notice on the Plugins screen says so. Each function is also wrapped in `function_exists()`, so nothing is ever declared twice. Without CFMB active, nothing loads and a notice tells you why.

## Not covered

Only the functions listed above are provided. For anything else (for example `acf_form()` or `acf_register_block_type()`), use the CFMB equivalent, such as Field Blocks for custom Gutenberg blocks.

## Requirements

- WordPress 6.6 or later
- PHP 7.4 or later
- [CFMB - Custom Fields Meta Box](https://wordpress.org/plugins/custom-fields-meta-box/) (active)

## Development

```bash
composer global require wp-coding-standards/wpcs phpcompatibility/phpcompatibility-wp
phpcs
```

Coding standards are in `phpcs.xml.dist`. Files listed in `.distignore` are left out of the WordPress.org release.

## Contributing

Bug reports and pull requests are welcome in [Issues](https://github.com/mozi2wp/cfmb-compatibility-mode/issues). For support, use the [WordPress.org support forum](https://wordpress.org/support/plugin/cfmb-compatibility-mode/).

## License

GPLv2 or later. Made by [Mozi2WP](https://mozi2wp.com). Not affiliated with or endorsed by Advanced Custom Fields or WP Engine.
