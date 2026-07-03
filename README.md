# Neys Grup İnşaat - Kurumsal Web Sitesi

Profesyonel, çok dilli (TR/EN/KU), SEO uyumlu kurumsal inşaat firması web sitesi.

## Teknolojiler

- **Frontend:** HTML5, CSS3, Vanilla JS, Bootstrap 5, AOS
- **Backend:** PHP 8+
- **Veritabanı:** MySQL
- **Hosting:** NATRO uyumlu (Node.js/Laravel gerektirmez)

## Kurulum (NATRO)

### 1. Dosyaları yükleyin
Tüm proje dosyalarını hosting `public_html` veya alt klasöre yükleyin.

### 2. Veritabanı oluşturun
cPanel > MySQL Veritabanları bölümünden veritabanı ve kullanıcı oluşturun.

### 3. SQL import
phpMyAdmin üzerinden sırasıyla import edin:
1. `database/schema.sql`
2. `database/seed.sql`
3. `database/update_admin_password.sql` (admin şifresi için)

### 4. Yapılandırma
`config/database.php` dosyasını düzenleyin:
```php
'host'     => 'localhost',
'dbname'   => 'veritabani_adi',
'username' => 'kullanici_adi',
'password' => 'sifre',
```

`config/app.php` dosyasında site URL'sini güncelleyin:
```php
'url' => 'https://www.neysgrupinsaat.com',
```

`.htaccess` içindeki `RewriteBase` değerini klasör yapınıza göre ayarlayın.

### 5. Placeholder görseller
SSH veya terminal varsa:
```bash
php install/placeholders.php
```

### 6. Klasör izinleri
`assets/uploads/` klasörüne yazma izni verin (755 veya 775).

## Admin Panel

- **URL:** `/admin/login.php`
- **Kullanıcı:** `admin`
- **Şifre:** `Admin@2026!`

## Özellikler

- Sticky header, hamburger mobil menü
- 3 dil (Türkçe, İngilizce, Kürtçe) - tam dinamik çeviri sistemi
- Dark/Light mode (localStorage)
- Hero slider, hizmetler, projeler, istatistik sayaçları
- Proje detay (galeri, video, PDF broşür, harita)
- İletişim formu (CSRF, honeypot, rate limit, PHP mail)
- WhatsApp sabit buton
- SEO (meta, OG, Twitter Card, Schema.org, sitemap, robots.txt)
- Admin panel (slider, hizmet, proje, mesaj, çeviri, tema yönetimi)
- 404, bakım modu, KVKK/Gizlilik/Çerez sayfaları
- Cookie bildirimi, back to top, breadcrumb, site içi arama

## Dosya Yapısı

```
assets/          CSS, JS, görseller, uploads
admin/           Yönetim paneli
api/             Form API
config/          Yapılandırma
database/        SQL dosyaları
functions/       PHP fonksiyonları
includes/        Header, footer, head
pages/           Sayfa şablonları
install/         Kurulum yardımcıları
```

## Güvenlik

- PDO Prepared Statements
- XSS koruması (`e()` fonksiyonu)
- CSRF token
- Dosya yükleme validasyonu
- Admin session kontrolü
- Spam koruması (honeypot + rate limit)

## Destek

Neys Grup İnşaat - info@neysgrupinsaat.com
