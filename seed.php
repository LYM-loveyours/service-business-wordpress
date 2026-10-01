<?php
/** Explicit setup only. Must never be run against a client installation. */
require_once '/wordpress/wp-load.php';
require_once ABSPATH . 'wp-admin/includes/plugin.php';
wp_set_current_user(1);
if (!current_user_can('manage_options')) { throw new RuntimeException('Local administrator required'); }
activate_plugin('northline-demo/northline-demo.php');
switch_theme('northline');
update_option('blogname', 'Northline — Home care');
update_option('blogdescription', 'Fictional service-business demonstration by Love Yours Media');
update_option('blog_public', '0');
update_option('permalink_structure', '/%postname%/');
update_option('elementor_disable_color_schemes', 'yes');
update_option('elementor_disable_typography_schemes', 'yes');
update_option('elementor_experiment-container', 'active');
update_option('elementor_css_print_method', 'internal');
$pages = json_decode(file_get_contents('/demo-content/pages.json'), true, 512, JSON_THROW_ON_ERROR);
foreach ($pages as $slug => $page) {
    $existing = get_page_by_path($slug);
    $id = wp_insert_post(['ID' => $existing ? $existing->ID : 0, 'post_type' => 'page',
        'post_status' => 'publish', 'post_name' => $slug, 'post_title' => $page['title'],
        'post_content' => ''], true);
    if (is_wp_error($id)) { throw new RuntimeException('Could not seed page'); }
    update_post_meta($id, '_elementor_edit_mode', 'builder');
    update_post_meta($id, '_elementor_template_type', 'wp-page');
    update_post_meta($id, '_elementor_version', ELEMENTOR_VERSION);
    update_post_meta($id, '_elementor_data', wp_slash(wp_json_encode($page['elements'])));
    if ($slug === 'home') { update_option('show_on_front', 'page'); update_option('page_on_front', $id); }
}
flush_rewrite_rules();
// Playground starts its HTTP listener before the blueprint has finished.
// Publish readiness only after the complete content/theme setup is verified.
foreach (array_keys($pages) as $slug) {
    $page = get_page_by_path($slug);
    if (!$page || $page->post_status !== 'publish' || !get_post_meta($page->ID, '_elementor_data', true)) {
        throw new RuntimeException('Demo page setup incomplete: ' . $slug);
    }
}
if (get_stylesheet() !== 'northline') { throw new RuntimeException('Demo theme not active'); }
if (file_put_contents(ABSPATH . 'northline-ready.json', wp_json_encode(['ready' => true, 'pages' => count($pages)])) === false) {
    throw new RuntimeException('Could not publish local readiness marker');
}
echo 'Northline demonstration seeded.';
