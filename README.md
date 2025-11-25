# CodeIgniter 4 Invoicing & Offer Generation System

Complete Dutch-language invoicing system with public form submission, admin dashboard, and PDF generation.

## Features

- Public form for clients to submit project details
- Admin dashboard for managing submissions and offers
- Automatic offer number generation (OA2501001 format)
- Professional PDF generation matching exact reference layout
- Email functionality to send offers to clients
- Responsive design for both public and admin interfaces

## Installation

### 1. Install Dependencies

```bash
composer install
```

### 2. Database Setup

Create a database named `invoicing-system` in phpMyAdmin:

```sql
CREATE DATABASE `invoicing-system`;
```

### 3. Configure Environment

The `.env` file is already configured for XAMPP:
- Database: `invoicing-system`
- Username: `root`
- Password: (empty)
- Host: `localhost`
- Port: `3306`

### 4. Run Migrations

```bash
php spark migrate
```

### 5. Seed Admin User

```bash
php spark db:seed AdminSeeder
```

This creates the admin user:
- Username: `hanzala`
- Email: `hanzala@gmail.com`
- Password: `admin123`

### 6. Add Company Logo

Place your company logo at:
```
public/uploads/logo/company-logo.png
```

The logo will appear in the top-right corner of generated PDFs.

### 7. Start Development Server

```bash
php spark serve
```

The application will be available at: `http://localhost:8080`

## Usage

### Public Form
- Access: `http://localhost:8080/form`
- Clients can submit project details
- All fields are in Dutch

### Admin Panel
- Access: `http://localhost:8080/admin/login`
- Login with: `hanzala` / `admin123`
- View submissions
- Create offers
- Generate PDFs
- Email offers to clients

## Workflow

1. Client submits form at `/form`
2. Admin logs in at `/admin/login`
3. Admin views submission in dashboard
4. Admin clicks "Offerte Aanmaken" (Create Offer)
5. Admin fills in offer items and prices
6. System generates offer number automatically (e.g., OA2501001)
7. Admin generates PDF with exact formatting
8. Admin downloads or emails PDF to client

## Offer Number Format

Format: `OA + YY + MM + 001`
- OA: Prefix
- YY: Last two digits of year
- MM: Two-digit month
- 001: Three-digit counter (resets monthly)

Example: `OA2501001` (January 2025, first offer)

## PDF Generation

PDFs are generated using Dompdf and match the exact layout from the reference PDF:
- Company logo in top-right
- Dutch text throughout
- Client and project details
- Items table with pricing
- Subtotal, BTW (21%), and total
- Payment terms and conditions
- Signature blocks

## File Structure

```
app/
├── Controllers/
│   ├── FormController.php
│   └── Admin/
│       ├── AuthController.php
│       ├── AdminController.php
│       └── OfferController.php
├── Models/
│   ├── UserModel.php
│   ├── FormSubmissionModel.php
│   ├── OfferModel.php
│   ├── OfferItemModel.php
│   └── CounterModel.php
├── Views/
│   ├── public/
│   │   ├── form.php
│   │   └── success.php
│   ├── admin/
│   │   ├── login.php
│   │   ├── dashboard.php
│   │   ├── submissions_list.php
│   │   ├── submission_detail.php
│   │   ├── create_offer.php
│   │   ├── offers_list.php
│   │   └── offer_detail.php
│   ├── layouts/
│   │   └── admin_layout.php
│   └── pdf/
│       └── offer_template.php
├── Services/
│   └── PdfService.php
├── Helpers/
│   └── offer_number_helper.php
├── Config/
│   ├── Routes.php
│   └── FieldMapper.php
└── Database/
    ├── Migrations/
    │   ├── 2025-01-01-000001_CreateUsers.php
    │   ├── 2025-01-01-000002_CreateFormSubmissions.php
    │   ├── 2025-01-01-000003_CreateOffers.php
    │   ├── 2025-01-01-000004_CreateOfferItems.php
    │   └── 2025-01-01-000005_CreateCounters.php
    └── Seeds/
        └── AdminSeeder.php
```

## Customization

### Company Information

Edit `app/Config/FieldMapper.php` to update:
- Company name
- Address
- Contact details
- KvK number
- BTW number
- IBAN

### PDF Layout

Edit `app/Views/pdf/offer_template.php` to customize PDF layout.

### Styling

- Public form: `public/assets/css/public.css`
- Admin panel: `public/assets/css/admin.css`

## Requirements

- PHP 8.1 or higher
- MySQL/MariaDB
- Composer
- XAMPP (recommended for local development)

## Support

For issues or questions, refer to the CodeIgniter 4 documentation:
https://codeigniter.com/user_guide/
