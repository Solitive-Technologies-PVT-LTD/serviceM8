# Installation Guide - Tom's Pest Control Client Portal

## For Windows Users - Quick Start 🚀

### Prerequisites
Make sure you have installed:
- ✅ PHP 8.1 or higher ([Download PHP](https://windows.php.net/download/))
- ✅ Composer ([Download Composer](https://getcomposer.org/download/))
- ✅ Node.js & NPM ([Download Node.js](https://nodejs.org/))

### Step-by-Step Installation

#### 1. Open Command Prompt or PowerShell
Navigate to the project folder:
```cmd
cd "D:\Project\Toms pest control\laravel-app"
```

#### 2. Install PHP Dependencies
```cmd
composer install
```
⏱️ This may take 2-3 minutes...

#### 3. Install Node.js Dependencies
```cmd
npm install
```
⏱️ This may take 2-3 minutes...

#### 4. Setup Environment File
```cmd
copy .env.example .env
php artisan key:generate
```

#### 5. Start the Portal (Easy Method)

**Option A: Using the Start Script (Easiest)**
Just double-click: `start-portal.bat`

**Option B: Manual Start**

Open TWO separate Command Prompt windows:

**Window 1 - Laravel Server:**
```cmd
cd "D:\Project\Toms pest control\laravel-app"
php artisan serve
```

**Window 2 - Vite Dev Server:**
```cmd
cd "D:\Project\Toms pest control\laravel-app"
npm run dev
```

#### 6. Open Your Browser
Visit: **http://localhost:8000**

---

## Troubleshooting

### Issue: "composer: command not found"
**Solution**: Install Composer from https://getcomposer.org/download/

### Issue: "npm: command not found"
**Solution**: Install Node.js from https://nodejs.org/

### Issue: "php: command not found"
**Solution**: Install PHP and add it to your system PATH

### Issue: Port 8000 is already in use
**Solution**: 
```cmd
php artisan serve --port=8001
```
Then visit: http://localhost:8001

### Issue: Vite connection error
**Solution**: 
1. Stop the Vite server (Ctrl+C)
2. Delete `node_modules` folder
3. Run `npm install` again
4. Run `npm run dev`

---

## What You'll See

Once running, you can navigate through:

### Public Pages (No Login Needed)
- **Home** - Main landing page
- **Universal Documentation** - Company documents
- **Login/Register** - Authentication pages

### Demo Login Flow
Since backend is not connected yet, clicking "Log In" will take you to:
- **Site Selection** - Choose a demo site
- **Dashboard** - Main portal with service history
- **All other features** - Invoices, quotes, documents, contact

---

## Development Notes

### Current Status
✅ All frontend pages completed
✅ All routes configured
✅ Tailwind CSS styling applied
✅ Responsive design implemented

### Pending (For Backend Developer)
⏳ Database setup
⏳ User authentication
⏳ ServiceM8 integration
⏳ File upload/download
⏳ Email functionality

---

## File Structure Overview

```
laravel-app/
├── resources/views/     ← All page templates
├── routes/web.php       ← All URL routes
├── public/              ← Images, CSS, JS
├── resources/css/       ← Tailwind CSS
└── tailwind.config.js   ← Theme colors
```

---

## Making Changes

### To modify page content:
Edit files in: `resources/views/`

### To change colors/styling:
1. Edit: `tailwind.config.js`
2. Edit: `resources/css/app.css`

### To add new routes:
Edit: `routes/web.php`

### After making changes:
The page will auto-refresh if Vite dev server is running!

---

## Production Deployment

When ready to deploy to production:

```cmd
cd laravel-app
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Need Help?

Contact Tom's Pest Control:
- **Phone**: 1300 866 773
- **Email**: office@tomspestcontrol.com.au


