# Deploying to Vercel

This Laravel frontend runs on Vercel using the `vercel-php` runtime. The repo already includes the required files:

- `vercel.json` – build and routing config
- `api/index.php` – serverless entry that boots Laravel via `public/index.php`
- `.vercelignore` – ignore unnecessary files during deployment

## One-time setup

1. Install the Vercel CLI (optional, you can also use the dashboard):
   ```bash
   npm i -g vercel
   ```
2. Ensure you deploy the `laravel-app` folder as the project root.

## Environment variables (Vercel Project Settings → Environment Variables)

Set these before the first deploy:

- `APP_ENV` = `production`
- `APP_DEBUG` = `false`
- `APP_KEY` = run locally `php artisan key:generate --show` and paste the value
- `SESSION_DRIVER` = `cookie`
- `CACHE_DRIVER` = `array`
- `LOG_CHANNEL` = `stderr`
- `APP_URL` = your deployed URL (e.g., `https://your-app.vercel.app`)

No database is needed for this frontend-only version. If you add a DB later, provide the DB_* variables as usual.

## Deploy (from the `laravel-app` directory)

```bash
cd laravel-app
vercel  # first time: follow prompts; choose this folder as project root
# subsequent deploys
vercel --prod
```

Vercel will:

1) Install PHP deps: `composer install --no-dev --prefer-dist --optimize-autoloader`
2) Build assets: `npm ci` (or `npm install`) and `npm run build` (Vite → `public/build`)
3) Cache/optimize config/routes/views
4) Route all requests to `api/index.php` so Laravel handles the routes, while static assets are served from `public/`

## Notes

- Storage is ephemeral on serverless. For this frontend-only build, sessions use cookies and cache uses `array`.
- If you later add file uploads, use an external storage (S3, etc.).
- To change build steps, edit `vercel.json` → `buildCommand`.




