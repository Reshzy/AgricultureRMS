# 🗺️ Roadmap: "FarmTrack" - Farmers Record Management System

## 1. Project Setup

-   [x] Initialize new Laravel project
-   [x] Set up authentication (admin-only access)
-   [x] Configure database (MySQL recommended)
-   [x] Set up file storage for images

---

## 2. Landing Page

-   [x] Dashboard showing:
    -   Total records
    -   Total barangays
    -   Total requests
    -   Number of farmers, laborers, fisherfolks, agriyouth
-   [x] Navbar with:
    -   Home
    -   About Us
    -   Contact Us

---

## 3. User Management

-   [x] Admin login/logout
-   [x] Admin-only dashboard access
-   [x] Public access to landing, about, contact pages
-   [x] Admin middleware for access control

---

## 4. Records Management

-   [ ] CRUD (Create, Read, Update, Delete) for:
    -   Farmers
    -   Laborers
    -   Fisherfolks
    -   Agriyouth
-   [ ] Each record includes:
    -   Personal info (name, address, etc.)
    -   Barangay
    -   Category (farmer, laborer, etc.)
    -   Picture upload
-   [ ] AJAX search bar for filtering records
-   [ ] View, update, delete actions for each record

---

## 5. Registration Form

-   [ ] Modal-based form for adding new records
-   [ ] Form fields as per FarmTrack record requirements
-   [ ] Image upload in the form

---

## 6. Other Pages

-   [ ] About Us page (static content)
-   [ ] Contact Us page (static content or contact form)

---

## 7. UI/UX

-   [ ] Responsive design (Bootstrap or Tailwind CSS)
-   [ ] Clean, admin-friendly interface

---

## 8. Testing & Deployment

-   [ ] Test all features (CRUD, search, authentication)
-   [ ] Deploy to production server

---

## 9. News

-   [ ] Admin news management (CRUD)

    -   Based on `ZclientFiles/uploadNews.html` UI
    -   Create `News` model, migration, controller, and policies
    -   Fields: title, content, featured_image_path, categories, audience, priority, status, published_at, tags
    -   Image upload with preview and 5MB limit
    -   Publish now or schedule; save draft

-   [ ] Public news pages

    -   News listing with search, filters (categories/tags/audience), and pagination
    -   News detail page
    -   Latest news widget on landing page

-   [ ] Backend/API

    -   Routes and controllers for admin and public endpoints
    -   Validation and authorization (admin-only for management)
    -   Slug generation and soft deletes

-   [ ] Testing
    -   CRUD and visibility (only published visible publicly)
    -   Scheduling publishes using `published_at`
