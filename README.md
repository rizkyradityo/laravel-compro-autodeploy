"# Laravel Company Profile CMS

A modern, responsive company website with full admin panel built with Laravel 10, Livewire 3, and Tailwind CSS.

## ✨ Features

### Admin Panel
- 📊 **Dashboard** - Overview statistics and analytics
- 📄 **Page Management** - Manage Home, About, Contact pages
- ⚙️ **Services CRUD** - Full service management with images
- 💼 **Portfolio** - Portfolio project showcase
- 📰 **Blog System** - Complete blog with search and categories
- 🖼️ **Media Manager** - Centralized file management
- ✉️ **Contact Messages** - Message management with read/unread status
- 👥 **User Management** - Admin and user roles

### Frontend
- 🎨 **Modern Design** - Clean, responsive UI
- 📱 **Mobile First** - Fully responsive design
- 🔍 **Search** - Content search functionality
- 🖼️ **Image Support** - Media attachments for all content
- ⚡ **Fast Loading** - Optimized performance
- 📧 **Contact Form** - Functional contact form with attachments

## 🛠️ Tech Stack

- **Backend:** Laravel 10, Livewire 3
- **Frontend:** Tailwind CSS, Alpine.js
- **Database:** MySQL/MariaDB
- **File Upload:** Laravel Storage
- **Icons:** Font Awesome 6

## 📋 Requirements

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL/MariaDB

## 🚀 Installation

1. **Clone repository**
```bash
git clone <repository-url>
cd laravel-compro
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Configure database**
Edit `.env` file:
```env
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Run migrations**
```bash
php artisan migrate
php artisan storage:link
```

6. **Start development server**
```bash
php artisan serve
npm run dev
```

7. **Access application**
- Frontend: `http://localhost:8000`
- Admin: `http://localhost:8000/admin`

## 👤 Default Admin

- **Email:** `admin@example.com`
- **Password:** `password`

⚠️ **Important:** Change default credentials immediately!

## 📁 Project Structure

```
├── app/
│   ├── Http/
│   │   └── Livewire/
│   │       ├── Admin/              # Admin components
│   │       └── Frontend/           # Frontend components
│   └── Models/                     # Eloquent models
├── resources/
│   ├── views/
│   │   ├── layouts/                # Layout templates
│   │   └── livewire/              # Livewire views
├── routes/
│   ├── admin.php                   # Admin routes
│   └── web.php                     # Frontend routes
└── database/
    └── migrations/                 # Database migrations
```

## 🎯 Usage

### Admin Panel

1. **Login** at `/admin` with admin credentials
2. **Dashboard** shows statistics for all content
3. **Manage Content** using sidebar navigation
4. **Upload Images** using Media Manager
5. **Create/Edit** using modal forms

### Frontend

- **Home** displays featured services, portfolio, and blog posts
- **Services** page lists all services
- **Portfolio** showcases projects
- **Blog** includes search and individual post views
- **Contact** form sends messages to admin

## 🔧 Configuration

### Media Storage
Images are stored in `storage/app/public/cms/` and served via `public/storage`

### File Upload Limits
- Max file size: 2MB
- Supported formats: Images (jpg, png, gif, svg)

### Page Types
- `home` - Homepage
- `about` - About page
- `contact` - Contact page

## 🎨 Customization

### Styles
- Edit `resources/css/app.css`
- Use Tailwind classes in Blade templates
- Customize colors in `tailwind.config.js`

### Content
- Edit pages via Admin Panel
- Or directly edit content in database
- Use Media Manager for images

### Layouts
- Admin: `resources/views/layouts/admin.blade.php`
- Frontend: `resources/views/layouts/frontend.blade.php`

## 📱 Accessibility

- Semantic HTML5
- ARIA labels
- Keyboard navigation
- Screen reader support
- WCAG 2.1 compliant

## 🔒 Security

- CSRF protection
- XSS protection
- SQL injection prevention
- File upload validation
- Admin authentication
- Rate limiting

## ⚡ Performance

- Image optimization ready
- Lazy loading capable
- Database indexing
- Caching support
- Asset minification

## 🤝 Contributing

1. Fork the repository
2. Create feature branch
3. Commit changes
4. Push to branch
5. Create Pull Request

## 📄 License

This project is open-source software.

## 🆘 Support

For issues and questions:
- Open an issue on GitHub
- Check documentation
- Review troubleshooting guide

## 🔄 Updates

Regular updates include:
- Security patches
- Feature enhancements
- Bug fixes
- Performance improvements

---

**Built with ❤️ using Laravel & Livewire**