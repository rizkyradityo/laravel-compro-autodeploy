"# Laravel Company Profile CMS - Setup Guide

## 1. Installation & Setup

### Prerequisites
- PHP 8.1 or higher
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Redis (optional)

### Installation Steps

1. **Install Dependencies**
```bash
composer install
npm install
```

2. **Environment Setup**
```bash
cp .env.example .env
php artisan key:generate
```

3. **Database Configuration**
Update `.env` file with your database credentials:
```
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=your_password
```

4. **Run Migrations**
```bash
php artisan migrate
php artisan db:seed
```

5. **Create Storage Link**
```bash
php artisan storage:link
```

6. **Build Assets**
```bash
npm run dev
```

7. **Create Admin User**
```bash
php artisan tinker
>>> User::create(['name' => 'Admin', 'email' => 'admin@example.com', 'password' => bcrypt('password'), 'role' => 'admin']);
```

## 2. Access Points

### Frontend URLs
- Home: `http://your-domain.com/`
- Services: `http://your-domain.com/services`
- Portfolio: `http://your-domain.com/portfolio`
- Blog: `http://your-domain.com/blog`
- Contact: `http://your-domain.com/contact`

### Admin URLs
- Dashboard: `http://your-domain.com/admin`
- Pages: `http://your-domain.com/admin/pages`
- Services: `http://your-domain.com/admin/services`
- Portfolio: `http://your-domain.com/admin/portfolios`
- Posts: `http://your-domain.com/admin/posts`
- Media: `http://your-domain.com/admin/media`
- Contact Messages: `http://your-domain.com/admin/contact-messages`
- Users: `http://your-domain.com/admin/users`

## 3. Features Overview

### Admin Dashboard
- 📊 Statistics overview
- 📄 Page management (Home, About, Contact)
- ⚙️ Services CRUD
- 💼 Portfolio management
- 📰 Blog post management
- 🖼️ Media manager
- ✉️ Contact messages
- 👥 User management

### Frontend Features
- 🎨 Responsive design
- 🔍 Service search
- 🖼️ Portfolio gallery
- 📝 Blog with search
- 📧 Contact form
- 📱 Mobile-friendly

## 4. File Structure

```
app/
├── Http/
│   └── Livewire/
│       ├── Admin/          # Admin components
│       ├── ContactForm.php # Contact form
│       ├── HomeComponent.php
│       ├── ServicesComponent.php
│       ├── PortfolioComponent.php
│       ├── BlogComponent.php
│       └── ContactComponent.php
├── Models/
│   ├── User.php
│   ├── Page.php
│   ├── Service.php
│   ├── Portfolio.php
│   ├── Post.php
│   ├── Media.php
│   └── ContactMessage.php
resources/
├── views/
│   ├── layouts/
│   │   ├── admin.blade.php       # Admin layout
│   │   └── frontend.blade.php    # Frontend layout
│   └── livewire/
│       ├── admin/                # Admin views
│       ├── home.blade.php
│       ├── services.blade.php
│       ├── portfolio.blade.php
│       ├── blog/                 # Blog views
│       ├── contact.blade.php
│       └── contact-form.blade.php
routes/
├── admin.php         # Admin routes
└── web.php          # Frontend routes
database/
└── migrations/      # Database migrations
```

## 5. Troubleshooting

### Common Issues

**1. Storage Link Issues**
```bash
php artisan storage: unlink
php artisan storage:link
```

**2. Permission Issues**
```bash
chmod -R 755 storage bootstrap/cache
```

**3. Database Connection**
- Check `.env` credentials
- Ensure database exists
- Verify MySQL is running

**4. Asset Issues**
```bash
npm run build
```

**5. Livewire Issues**
```bash
php artisan livewire:publish --config
php artisan config:clear
php artisan view:clear
```

## 6. Development Notes

**Relationships:**
- Media is polymorphic (Page, Portfolio, Post, ContactMessage)
- Posts belong to Users
- All content types support Media attachments

**Features to Add:**
- Rich text editor for content
- Image optimization
- SEO improvements
- Google Analytics
- Newsletter subscription
- Multi-language support

## 7. Default Login
- Email: `admin@example.com`
- Password: `password`

*Make sure to change these immediately after installation!*"