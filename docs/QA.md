# QA evidence · 1 October 2026

14 Playwright checks: six pages at 1440×1000 and 390×844 in Chromium, plus invalid-input and successful non-sending form checks at both sizes. Checks cover one H1, horizontal overflow, browser exceptions, failed responses and automated WCAG 2 A/AA and 2.1 AA rules. Separate form checks passed in Chromium, Firefox and WebKit.

WordPress 7.1.2 / PHP 8.3 / Elementor 4.3.3 / Hello Elementor 3.5.1 loaded locally. The native Elementor editor opened the homepage; an editor screenshot is included. Native homepage H1 edit, local Publish, frontend verification, editor reload and persistence, then restoration and frontend re-verification passed on 1 October 2026. This is persistence within the running disposable Playground, not across restarts. An older long-running preview returned HTTP 500; restarting the unchanged disposable instance restored operation.

The Playground dependency originally pulled vulnerable `qs`; a 6.16.0 override resolves the reported advisories. The final local server and page suite were rerun. `npm audit`: zero known vulnerabilities in the npm tooling dependency tree. This is not a WordPress/plugin vulnerability-database audit.

Setup downloaded third-party software. The demo launcher binds to 127.0.0.1; the default disposable administrator must never be exposed to the internet.

Not tested: physical devices, assistive-technology user testing, production hosting, live delivery, load/performance under real traffic or GitHub-hosted CI. Automated accessibility checks are not certification. No measured commercial results are claimed. Nothing deployed.
