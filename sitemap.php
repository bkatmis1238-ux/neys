<?php
/**
 * Dinamik Sitemap.xml
 */
require_once __DIR__ . '/config/bootstrap.php';

header('Content-Type: application/xml; charset=utf-8');

$baseUrl = rtrim($appConfig['url'], '/');
$languages = get_active_languages($pdo);

echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";

$staticPages = [
    'tr' => ['', 'hakkimizda', 'hizmetler', 'projeler', 'iletisim', 'kvkk', 'gizlilik-politikasi', 'cerez-politikasi'],
    'en' => ['en', 'en/about', 'en/services', 'en/projects', 'en/contact', 'en/gdpr', 'en/privacy-policy', 'en/cookie-policy'],
    'ku' => ['ku', 'ku/derbare-me', 'ku/xizmeten', 'ku/projeyen', 'ku/tekili', 'ku/kvkk-ku', 'ku/politika-nepenitiye', 'ku/politika-cookie'],
];

foreach ($staticPages as $lang => $pages) {
    foreach ($pages as $page) {
        $loc = $baseUrl . ($page ? '/' . $page : '');
        echo "  <url>\n";
        echo "    <loc>" . htmlspecialchars($loc) . "</loc>\n";
        echo "    <changefreq>weekly</changefreq>\n";
        echo "    <priority>" . ($page === '' || str_ends_with($page, '/') ? '1.0' : '0.8') . "</priority>\n";
        echo "  </url>\n";
    }
}

// Projeler
$projects = db_fetch_all($pdo,
    'SELECT pt.slug, l.code, p.updated_at
     FROM project_translations pt
     JOIN projects p ON pt.project_id = p.id
     JOIN languages l ON pt.language_id = l.id
     WHERE p.is_active = 1'
);

foreach ($projects as $proj) {
    $prefix = $proj['code'] === 'tr' ? 'proje' : 'project';
    $langPrefix = $proj['code'] === 'tr' ? '' : $proj['code'] . '/';
    $loc = $baseUrl . '/' . $langPrefix . $prefix . '/' . $proj['slug'];
    echo "  <url>\n";
    echo "    <loc>" . htmlspecialchars($loc) . "</loc>\n";
    echo "    <lastmod>" . date('Y-m-d', strtotime($proj['updated_at'])) . "</lastmod>\n";
    echo "    <changefreq>monthly</changefreq>\n";
    echo "    <priority>0.7</priority>\n";
    echo "  </url>\n";
}

echo '</urlset>';
