=== CFMB Compatibility Mode ===
Contributors: mozi2wp
Tags: custom fields, migration, compatibility, theme, template
Requires at least: 6.6
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Keep get_field() and have_rows() working in your theme after you migrate from ACF to CFMB - Custom Fields Meta Box. No template edits.

== Description ==

**CFMB Compatibility Mode** keeps themes built for Advanced Custom Fields (ACF) working after you switch to the free [CFMB - Custom Fields Meta Box](https://wordpress.org/plugins/custom-fields-meta-box/) plugin.

You moved your field groups and values from ACF or Secure Custom Fields to CFMB with its Switch Assistant. Your theme still calls `get_field()`, `have_rows()` and `the_sub_field()`. This plugin answers those calls with CFMB, so the theme keeps working and you can update your templates at your own pace.

= Supported functions =

`get_field()`, `the_field()`, `get_fields()`, `get_field_object()`, `update_field()`, `delete_field()`, `have_rows()`, `the_row()`, `get_sub_field()`, `the_sub_field()`, `get_row_layout()`, `get_row_index()`, `reset_rows()`, `acf_add_options_page()` and `acf_add_options_sub_page()`.

Each one is a thin wrapper around its `cfmb_` version. Arguments such as `'option'`, `'user_5'`, `'term_12'` and `field_…` keys are translated to CFMB's.

= How to switch from ACF without breaking your theme =

1. Install CFMB - Custom Fields Meta Box and run its Switch Assistant to import your field groups and values.
2. Install this plugin.
3. Deactivate ACF or Secure Custom Fields. Your theme keeps showing the same fields.
4. Over time, replace `get_field()` with `cfmb_get_field()` in your templates, then remove this plugin.

= Why this is a separate plugin =

These function names are not prefixed, because they have to match the ones your theme already calls. Keeping them out of CFMB means nothing is defined unless you install this plugin on purpose.

= Safe to install next to ACF =

The functions are never defined while ACF, ACF Pro or Secure Custom Fields is active. A notice on the Plugins screen says so. Every function is also wrapped in `function_exists()`, so nothing is ever declared twice.

New templates should use the `cfmb_` functions. They work without this plugin.

This plugin is not affiliated with or endorsed by Advanced Custom Fields or WP Engine.

== Installation ==

1. Install and activate CFMB - Custom Fields Meta Box.
2. Install and activate CFMB Compatibility Mode.
3. Deactivate ACF or Secure Custom Fields after the Switch Assistant has moved your values.

== Frequently Asked Questions ==

= Does it need ACF? =

No. It replaces ACF's template functions. ACF must be inactive for them to load.

= Do flexible content and repeater loops keep working? =

Yes. `have_rows()`, `the_row()`, `get_sub_field()` and `get_row_layout()` read CFMB Repeater and Stacks fields.

= Do options pages keep working? =

Yes. `get_field( 'phone', 'option' )` reads CFMB options pages, and `acf_add_options_page()` registers one.

= Can I remove it later? =

Yes. Once your templates call the `cfmb_` functions, deactivate and delete this plugin. It stores nothing.

== Changelog ==

= 1.0.0 =
* First release. Moved out of CFMB - Custom Fields Meta Box into its own plugin.
