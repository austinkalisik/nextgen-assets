#  NextGen Assets Management System

A modern **Asset Management System** built with Laravel to manage inventory, track assignments, and monitor system activity in real time.

---

##  System Overview

NextGen Assets helps organizations:

* Track assets (IT equipment, tools, devices)
* Assign assets to users
* Monitor asset lifecycle (created, assigned, returned)
* Manage suppliers and categories
* View real-time dashboard analytics

---

##  Core System Logic (ERD-Based)

The system is structured around these relationships:

* **Category (1) → (Many) Items**
* **Supplier (1) → (Many) Items**
* **Item (1) → (Many) Asset Logs**
* **User (1) → (Many) Asset Logs**
* **Item (1) → (Many) Assignments**
* **User (1) → (Many) Assignments**

 This ensures a **real asset tracking workflow**, not just static inventory.

---

##  Features

###  Authentication

* Login & Registration
* Secure password hashing
* Session-based authentication

---

###  Dashboard

* Total Assets
* Available / Assigned / Maintenance
* Low stock alerts
* Monthly asset analytics
* Real-time Port Moresby time
* Recent asset activity

---

###  Asset Management

* Add / Edit / Delete assets
* Track:

  * Part Number
  * Brand
  * Name
  * Description
  * Category
  * Supplier
  * Quantity
  * Status

---

###  Asset Assignment (Core Feature)

* Assign assets to users
* Track active assignments
* Track returned assets (via `returned_at`)
* Maintain assignment history

---

###  Categories

* Create categories
* Search & filter categories
* Organize assets logically

---

###  Suppliers

* Add / Edit / Delete suppliers
* Link suppliers to assets

---

###  Users

* Manage system users
* Assign assets to users
* Role support (Admin / User)

---

###  Activity Logs

* Track asset actions:

  * Created
  * Updated
  * Assigned
  * Deleted
* Full audit trail for accountability

---

###  Settings

* System name configuration
* Admin email settings

---

###  Reports (In Progress)

* CSV export (partially implemented)
* Analytics dashboard

---

##  Tech Stack

* Laravel (Backend)
* MySQL (Database)
* Blade (Frontend)
* Tailwind CSS (UI)

---

##  Installation

### 1. Clone Repository

```bash
git clone https://github.com/austinkalisik/nextgen-assets.git
cd backend
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database

```env
DB_DATABASE=nextgen_assets
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Run Migrations + Seeders

```bash
php artisan migrate:fresh --seed
```

### 6. Start Server

```bash
php artisan serve
```

Visit:

```
http://127.0.0.1:8000
```

---

##  Default Login

```
Email: admin@nextgen.com
Password: password
```

---

##  Project Structure

| Layer       | Location             |
| ----------- | -------------------- |
| Controllers | app/Http/Controllers |
| Models      | app/Models           |
| Views       | resources/views      |
| Routes      | routes/web.php       |
| Database    | database/migrations  |
| Seeders     | database/seeders     |

---

##  Current Limitations

* CSV export not fully working
* Assignment UI not fully implemented
* Some features still rely on `status` instead of assignments

---

##  Future Improvements

* Full assignment workflow (assign → return)
* CSV & PDF reporting
* Role-based permissions
* Notifications system
* Advanced analytics dashboard

---

##

NextGen Assets System

---

##  License

MIT License
