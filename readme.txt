=== CFMB Compatibility Mode ===
Contributors: mozi2wp
Tags: custom fields, migration, get_field, repeater, compatibility
Requires at least: 6.6
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Switch from ACF without breaking your theme. Keeps get_field(), have_rows() and other ACF functions working with CFMB - Custom Fields Meta Box.

== Description ==

**CFMB Compatibility Mode** keeps themes built for Advanced Custom Fields (ACF) working after you switch to the free [CFMB - Custom Fields Meta Box](https://wordpress.org/plugins/custom-fields-meta-box/) plugin. No template edits needed.

You moved your field groups and values from ACF, ACF Pro or Secure Custom Fields (SCF) to CFMB with its Switch Assistant. Your theme still calls `get_field()`, `have_rows()` and `the_sub_field()`. This plugin answers those calls with CFMB, so your site keeps showing the same content and you can update your templates at your own pace.

= Features =

* **Zero template changes** on day one of the migration.
* **Repeater and flexible content loops** keep working with `have_rows()`, `the_row()`, `get_sub_field()` and `get_row_layout()`.
* **Options pages** keep working with `get_field( 'phone', 'option' )` and `acf_add_options_page()`.
* **Field keys** (`field_…`) are mapped to the fields the Switch Assistant imported.
* **Safe next to ACF.** It pauses itself while ACF, ACF Pro or Secure Custom Fields is active.
* **Stores nothing.** Remove it once your templates use the `cfmb_` functions.

= Supported ACF functions =

`get_field()`, `the_field()`, `get_fields()`, `get_field_object()`, `update_field()`, `delete_field()`, `have_rows()`, `the_row()`, `get_sub_field()`, `the_sub_field()`, `get_row_layout()`, `get_row_index()`, `reset_rows()`, `acf_add_options_page()` and `acf_add_options_sub_page()`.

Each one is a thin wrapper around its `cfmb_` version. Arguments such as `'option'`, `'user_5'`, `'term_12'`, `'category_12'` and `field_…` keys are translated to CFMB's.

= How to switch from ACF to CFMB without breaking your theme =

1. Install CFMB - Custom Fields Meta Box and run its Switch Assistant to import your field groups and values.
2. Install this plugin.
3. Deactivate ACF or Secure Custom Fields. Your theme keeps showing the same fields.
4. Over time, replace `get_field()` with `cfmb_get_field()` in your templates, then remove this plugin.

= Why this is a separate plugin =

These function names are not prefixed, because they have to match the ones your theme already calls. Keeping them out of CFMB means nothing is defined unless you install this plugin on purpose.

= Safe to install next to ACF =

The functions are never defined while ACF, ACF Pro or Secure Custom Fields is active. A notice on the Plugins screen says so. Every function is also wrapped in `function_exists()`, so nothing is ever declared twice.

New templates should use the `cfmb_` functions. They work without this plugin.

= Links =

* [CFMB - Custom Fields Meta Box](https://wordpress.org/plugins/custom-fields-meta-box/)
* [Source code on GitHub](https://github.com/mozi2wp/cfmb-compatibility-mode)
* [Website](https://mozi2wp.com/cfmb)

This plugin is not affiliated with or endorsed by Advanced Custom Fields or WP Engine.

== Installation ==

1. Install and activate CFMB - Custom Fields Meta Box.
2. Go to Plugins > Add New, search for "CFMB Compatibility Mode", then install and activate it.
3. Deactivate ACF or Secure Custom Fields after the Switch Assistant has moved your values.

== Frequently Asked Questions ==

= Does it need ACF? =

No. It replaces ACF's template functions. ACF must be inactive for them to load.

= What happens if ACF is still active? =

Nothing is defined, and a notice on the Plugins screen says the plugin is paused. Deactivate ACF, ACF Pro or Secure Custom Fields to let CFMB answer the calls.

= Do flexible content and repeater loops keep working? =

Yes. `have_rows()`, `the_row()`, `get_sub_field()` and `get_row_layout()` read CFMB Repeater and Stacks fields. `get_row_index()` counts from 1, like ACF.

= Do options pages keep working? =

Yes. `get_field( 'phone', 'option' )` reads CFMB options pages, and `acf_add_options_page()` registers one.

= Does it work with Secure Custom Fields (SCF)? =

Yes. Import from SCF with the CFMB Switch Assistant, deactivate SCF, and this plugin answers the same function calls.

= Which ACF functions are not covered? =

Only the functions listed above are provided. For others, such as `acf_form()` or `acf_register_block_type()`, use the CFMB equivalent, such as Field Blocks for custom Gutenberg blocks.

= Can I remove it later? =

Yes. Once your templates call the `cfmb_` functions, deactivate and delete this plugin. It stores nothing.

== Changelog ==

= 1.0.0 =
* First release. Moved out of CFMB - Custom Fields Meta Box into its own plugin.

== Upgrade Notice ==

= 1.0.0 =
First release.
