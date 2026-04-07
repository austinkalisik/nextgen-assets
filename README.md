# NextGen Asset Management System

A modern Laravel-based asset management system for tracking, assigning, and managing company assets.

---

##  Features

* Asset management (CRUD)
* Assign assets to users
* Inventory tracking (Stock In / Out)
* Departments & Suppliers
* User management with roles
* Activity logs
* Dashboard analytics
* Search & filtering
* Clean UI for corporate use

---

##  Tech Stack

* Laravel (Backend)
* Blade (Frontend)
* MySQL (Database)
* XAMPP (Local environment)

---

##  Installation (Step-by-step)

### 1. Clone repository

```bash
git clone https://github.com/austinkalisik/nextgen-assets.git
cd nextgen-assets/backend
```

---

### 2. Install dependencies

```bash
composer install
```

---

### 3. Setup environment

```bash
cp .env.example .env
php artisan key:generate
```

---

### 4. Configure database

Open `.env` and update:

```env
DB_DATABASE=nextgen_assets
DB_USERNAME=root
DB_PASSWORD=
```

---

### 5. Create database

In phpMyAdmin:

```
Create database: nextgen_assets
```

---

### 6. Run migrations + seed

```bash
php artisan migrate:fresh --seed
```

---

### 7. Start server

```bash
php artisan serve
```

---

##  Default Login

```

```
## Default Login Accounts

After running:

php artisan migrate:fresh --seed

Use any of the following accounts:

Admin:
Email: admin@nextgen.local
Password: password

Asset Officer:
Email: assets@nextgen.local
Password: password

ICT Support:
Email: support@nextgen.local
Password: password

Manager:
Email: operations@nextgen.local
Password: password

---

 Note:
If login fails, ensure you have seeded the database:

php artisan migrate:fresh --seed

---

##  Key Modules

* Dashboard → Overview & analytics
* Assets → Manage company assets
* Assignments → Assign & return assets
* Inventory → Stock control
* Suppliers → Vendor management
* Categories → Asset classification
* Departments → Organizational structure
* Users → System users
* Settings → System config

---

##  Notes

* `.env` is not included (create manually)
* Works with XAMPP MySQL
* Designed for corporate asset tracking

---

## Author

Programmer4
