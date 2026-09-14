# Won Nyaci Run 2026

A production-ready starter website/CMS for **Won Nyaci Run 2026**, an initiative under the Lango Cultural Institution (Tekwaro Lango).

## Stack
- Laravel 12 / PHP 8.2+
- Vue 3 + Vite
- MySQL 8+
- Axios
- Custom responsive CSS (purple-led visual identity)

## Included
- Animated landing page: runner animation → finish-line burst/scatter → Won Nyaci Run 2026 title reveal.
- 24/10/2026 event information, Old Akii Bua Stadium, 6:00 AM registration/aerobics and 7:30 AM running.
- Kit CTA at UGX 30,000 and corporate T-shirt at UGX 50,000.
- Payment dashboard with MTN Mobile Money, Airtel Money, Stanbic Flexi-Pay, Bank Transfer and a card-checkout placeholder.
- CMS/admin login.
- Blog/story CRUD with image uploads and publish/draft controls.
- Contact form stored in MySQL; admin inbox with mark-read and mailto reply.
- X/Twitter API integration: sync latest posts and render them on the public website.
- Scheduler hook for automatic X synchronization every 15 minutes when X credentials are configured.
- Editable payment instructions from the CMS.
- Supplied flyer/payment reference images copied into `public/images/`.

## 1. Install locally

Requirements: PHP 8.2+, Composer, Node 20+, MySQL 8+.

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Create a MySQL database called `won_nyaci_run`, then set these values in `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=won_nyaci_run
DB_USERNAME=root
DB_PASSWORD=your_password
```

Then:

```bash
php artisan migrate --seed
php artisan storage:link
npm run build
php artisan serve
```

Open `http://127.0.0.1:8000`.

### Admin

Default credentials are controlled by `.env`:

```env
ADMIN_EMAIL=admin@wonnyacirun.ug
ADMIN_PASSWORD=ChangeMe!2026
```

Open `/admin/login` and **change the password before production use**.

## 2. MySQL import instead of migrations

The folder contains `database/seed.sql`. It creates the database/tables and inserts the initial admin, payment instructions, settings and starter story.

```bash
mysql -u root -p < database/seed.sql
```

If you import the SQL directly, still create/update `.env` with the same MySQL connection.

## 3. X integration

The website is designed so posts made by the configured X account can be synchronized into the site.

Add to `.env`:

```env
X_USERNAME=your_official_account
X_BEARER_TOKEN=your_x_api_bearer_token
X_CACHE_MINUTES=5
```

Then sign in to `/admin/settings` and click **Sync X now**.

For continuous automatic syncing, run Laravel's scheduler:

```bash
php artisan schedule:work
```

On Railway, use a separate worker/cron process for the scheduler if you want the 15-minute automatic sync.

> X API access/plan requirements are controlled by X. The code uses the X API v2 user/tweets endpoints and gracefully reports when credentials are not configured.

## 4. Card payments

The UI includes a card-payment dashboard and secure-checkout placeholder. Before taking real card payments, connect an approved Uganda-compatible payment provider (for example, Flutterwave, Pesapal, DPO or the provider selected by the organisers) and keep secret credentials in `.env`/Railway variables. Do not collect raw card numbers in this Laravel application.

## 5. Railway deployment

This repository includes `nixpacks.toml` and `start.sh`.

Recommended Railway variables:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-domain
APP_KEY=base64:...
DB_CONNECTION=mysql
DB_HOST=...
DB_PORT=3306
DB_DATABASE=...
DB_USERNAME=...
DB_PASSWORD=...
SESSION_DRIVER=database
CACHE_STORE=database
FILESYSTEM_DISK=public
ADMIN_EMAIL=...
ADMIN_PASSWORD=...
X_USERNAME=...
X_BEARER_TOKEN=...
```

The Nixpacks build runs Composer, installs npm dependencies and builds Vue. The start script creates the storage symlink, runs migrations and starts Laravel on `$PORT`.

For persistent uploaded blog images on Railway, attach persistent storage or move uploads to an object-storage provider (S3-compatible storage). Otherwise deployments may not retain local uploaded files.

## Important payment-data verification

The payment values were seeded from the screenshots supplied with the request. The supplied reference clearly shows:
- MTN dial code: `*165*4*4#`
- MTN merchant code: `WCCM`
- Reference: Sponsor's Full Name
- Bank: Centenary
- Account name: WON NYACI ME LANGO
- The flyer shows account number `310010849` in the supplied image; **verify this and all payment details with the official organisers before publishing or accepting payments**.

The CMS intentionally makes payment details editable so the organiser can correct them without changing source code.
