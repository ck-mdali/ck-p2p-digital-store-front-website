# 🧠 ROOT CONTEXT: Personal Script Store & P2P Checkout Platform
---
## ✅ Level 1: Vision-Level (The What & Why)

**Goal**:  
Build a personal-brand-driven micro-marketplace platform to sell code/scripts/themes and offer freelance services with P2P-style checkout (manual payments via UPI/Bank). Inspired by Codecanyon + Fiverr, but focused on a solo creator.

Users can:
- Browse products (scripts, themes, etc.)
- View product details (video, screenshots, etc.)
- Checkout and pay via UPI or bank (manual)
- Chat with admin during checkout
- Hire for freelance services

Admin (me) can:
- Upload/manage products
- Manage orders manually
- Chat with customers
- Release downloads after payment
- Get notified (sound alert) on new orders

---
## 🧱 Level 2: System-Level (Architecture & Stack)

### 🔧 Tech Stack

| Layer         | Technology                  |
|---------------|------------------------------|
| Backend       | Laravel (PHP)                |
| Frontend      | Blade + TailwindCSS          |
| Admin Panel   | FilamentPHP                  |
| Auth          | Laravel Breeze               |
| Database      | MySQL (cPanel VPS)           |
| Hosting       | VPS with cPanel              |
| Storage       | Local storage (public)       |
| Chat          | Polling-based (v1), Websockets (v2) |
| Payments      | Manual UPI / Bank Transfer   |
| Notifications | Sound (browser), Email (SMTP) |

### 🧩 Modules Overview

- Product Catalog
- Product Detail View
- P2P Checkout Flow (with chat and proof upload)
- Admin Order Management (Filament)
- Freelance Request Form
- Download Release on Payment
- Notification System (Sound & Email)

---

## ⚙️ Level 3: Feature-Level (Modules & Interactions)

### 📦 Product Module

- Admin adds/edit products via Filament:
  - title, description, price, video, screenshots, download file
- Public store shows products in card grid
- Each product has a detail page with:
  - YouTube demo, screenshots, live demo
  - Description, price, author info
  - Buy button → leads to checkout

---

### 💳 P2P Checkout Flow

- User clicks "Buy" → login or register if needed
- Sent to product-specific checkout page
- Page layout:
  - **Left panel**: UPI/Bank payment details, price, payment proof upload
  - **Right panel**: Chatbox with admin (order-specific)
- User uploads payment screenshot & marks "Paid"
- Admin hears sound alert in dashboard
- Admin reviews and marks as "Completed"
- File or license is released to user

---

### 💬 Order Chat System

- Each order has its own chat thread
- Admin & user can exchange messages (polling or WebSocket)
- Optional file upload
- Chat shows on both user checkout page and admin order view

---

### 👨‍💼 Admin Panel (FilamentPHP)

- Manage:
  - Products (CRUD)
  - Orders (view, mark paid, release files)
  - Chats (read/respond per order)
  - Freelance requests
- Sound alert plays when:
  - New `payment_uploaded` order is received
- Email notification on "Order Completed" (file sent)

---

### 💼 Freelance Request System

- Public "Hire Me" form:
  - name, email, project details, budget, deadline
- Saves to `freelance_requests` table or emails admin
- Admin manages requests in Filament or manually

---

## 🧩 Level 4: Entity-Level (Database Models)

### 🧑 Users
```php
id, name, email, password, profile_photo, timestamps