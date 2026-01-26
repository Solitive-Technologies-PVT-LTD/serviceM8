# Tom's Pest Control Client Portal

A Laravel-based customer portal for Tom's Pest Control with a beautiful, modern frontend interface.

## Features

### Public Pages
- **Homepage** - Welcome page with Universal Documentation access
- **Universal Documentation** - Browse company-wide documents (licenses, SDS, etc.)
- **Login/Register** - User authentication pages

### Customer Portal (After Login)
- **Site Selection** - Choose from multiple customer sites
- **Dashboard** - Main portal with:
  - Service History (clickable job records)
  - Upcoming Jobs (auto-pulled from ServiceM8 - backend integration needed)
  - Quick Actions (Request Quote, View Invoices, etc.)
- **Service Detail** - Individual job details with downloadable documents
- **Invoices & Payments** - All invoices with status tracking
- **Request Quote** - Contact form (sends to commercial@tomspestcontrol.com.au)
- **Site Documentation** - Site-specific document folders
- **Contact Information** - Complete company contact details

## Installation

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js & NPM

### Setup Steps

1. **Install PHP Dependencies**
```bash
cd laravel-app
composer install
```

2. **Install Node Dependencies**
```bash
npm install
```

3. **Environment Configuration**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure Database** (Optional for frontend-only)
Edit `.env` file with your database credentials:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=toms_pest_control
DB_USERNAME=root
DB_PASSWORD=
```

5. **Build Frontend Assets**
```bash
npm run dev
```

6. **Start Development Server**
```bash
php artisan serve
```

Visit: `http://localhost:8000`

## Production Build

For production deployment:
```bash
npm run build
```

## Project Structure

```
laravel-app/
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php          # Main layout template
│   │   ├── auth/
│   │   │   ├── login.blade.php        # Login page
│   │   │   └── register.blade.php     # Registration page
│   │   ├── sites/
│   │   │   └── select.blade.php       # Site selection page
│   │   ├── home.blade.php             # Homepage
│   │   ├── universal-docs.blade.php   # Universal documentation
│   │   ├── dashboard.blade.php        # Main dashboard
│   │   ├── service-detail.blade.php   # Job detail page
│   │   ├── invoices.blade.php         # Invoices list
│   │   ├── request-quote.blade.php    # Quote request form
│   │   ├── site-documentation.blade.php # Site docs
│   │   └── contact.blade.php          # Contact info
│   └── css/
│       └── app.css                    # Tailwind CSS
├── routes/
│   └── web.php                        # All routes
└── tailwind.config.js                 # Tailwind configuration
```

## Color Scheme

- **Primary Green**: `#6B8E6B` (toms-green)
- **Dark**: `#2C3E3C` (toms-dark)
- **Background**: Light gray (`#F9FAFB`)

## Routes

| Route | Name | Description |
|-------|------|-------------|
| `/` | home | Homepage with Universal Docs |
| `/universal-documentation` | universal-docs | Browse public documents |
| `/login` | login | Login page |
| `/register` | register | Registration page |
| `/sites` | sites.select | Site selection |
| `/dashboard/{site}` | dashboard | Main dashboard |
| `/service/{id}` | service.detail | Service job details |
| `/invoices` | invoices | Invoices list |
| `/quote/request` | quote.request | Request quote form |
| `/site-documentation` | site.documentation | Site documents |
| `/contact` | contact | Contact information |

## Backend Integration Required

The following features need backend implementation:

1. **ServiceM8 Integration**
   - Auto-pull service history
   - Auto-pull upcoming jobs
   - Sync job details and documents

2. **Authentication**
   - User login/registration
   - Password reset
   - Session management

3. **Email Integration**
   - Quote requests to `commercial@tomspestcontrol.com.au`
   - Form submissions

4. **Document Management**
   - File upload/download
   - Folder organization
   - Dynamic folder creation/deletion

5. **Database Models**
   - Users
   - Sites
   - Services
   - Invoices
   - Documents

## Design Reference

The UI design is based on the provided mockups in the `UI Images` folder:
- Clean, modern interface
- Green color scheme matching Tom's Pest Control branding
- Mobile-responsive design using Tailwind CSS
- Card-based layouts for better organization

## Support

For issues or questions, contact:
- **Email**: office@tomspestcontrol.com.au
- **Phone**: 1300 866 773

## License

Proprietary - Tom's Pest Control Pty Ltd




