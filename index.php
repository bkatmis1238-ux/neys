<?php
/**
 * Neys Grup İnşaat - Ana Router
 */

require_once __DIR__ . '/config/bootstrap.php';

// Sayfa çözümleme
$uri  = $_SERVER['REQUEST_URI'] ?? '/';
$pageInfo = resolve_page($uri, $currentLang);
$currentPage = $pageInfo['page'];
$pageSlug    = $pageInfo['slug'] ?? '';

// SEO meta
$seo = get_seo($pdo, $currentPage === 'project_detail' ? 'projects' : ($currentPage === '404' ? 'home' : $currentPage), $langId);

// Sayfa yönlendirme
$pageFile = PAGES_PATH . '/' . $currentPage . '.php';

if (!file_exists($pageFile)) {
    $currentPage = '404';
    $pageFile = PAGES_PATH . '/404.php';
    http_response_code(404);
}

require $pageFile;
