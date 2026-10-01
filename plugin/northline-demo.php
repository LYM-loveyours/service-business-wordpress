<?php
/**
 * Plugin Name: Northline Demo Boundaries
 * Description: Synthetic showcase form and explicit seed command. Blocks outbound mail.
 * Version: 1.0.0
 * License: GPL-2.0-or-later
 */
if (!defined('ABSPATH')) { exit; }
add_filter('pre_wp_mail', '__return_false');
add_filter('elementor/frontend/print_google_fonts', '__return_false');
add_shortcode('northline_demo_form', function () {
    return '<form class="north-form" onsubmit="return false" novalidate>
<p class="north-notice">Demonstration only. Use fictional details. No message will be sent.</p>
<label for="demo-name">Demo name</label><input id="demo-name" required maxlength="80" autocomplete="off" aria-describedby="demo-name-error"><span id="demo-name-error" class="field-error"></span>
<label for="demo-email">Demo email</label><input id="demo-email" type="email" required maxlength="254" placeholder="alex@example.com" autocomplete="off" aria-describedby="demo-email-error"><span id="demo-email-error" class="field-error"></span>
<label for="demo-service">What kind of job?</label><select id="demo-service" required aria-describedby="demo-service-error"><option value="">Choose a service</option><option>Small repairs</option><option>Seasonal upkeep</option><option>Room refresh</option></select><span id="demo-service-error" class="field-error"></span>
<label for="demo-brief">Describe the job</label><textarea id="demo-brief" rows="4" required minlength="20" maxlength="1000" aria-describedby="demo-brief-error"></textarea><span id="demo-brief-error" class="field-error"></span>
<label class="check" for="demo-consent"><input type="checkbox" id="demo-consent" required aria-describedby="demo-consent-error">I understand this is a demonstration.</label><span id="demo-consent-error" class="field-error"></span>
<button type="submit">Complete demo ↗</button><p class="status" role="status" tabindex="-1"></p><noscript>This demonstration requires JavaScript. The form cannot send a message.</noscript></form>';
});
