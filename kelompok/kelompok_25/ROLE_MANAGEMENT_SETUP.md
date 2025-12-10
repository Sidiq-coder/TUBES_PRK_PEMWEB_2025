# Role Management System Setup

## Overview
This role management system provides a comprehensive interface for managing user roles and permissions in the Inventory Manager application.

## Features
- **Role Management**: View and create roles with different permission levels
- **User Management**: View users, create new users, and manage their roles
- **Permission System**: Granular permissions for different system features
- **Status Management**: Toggle user active/inactive status
- **Search Functionality**: Search users by name or email

## Setup Instructions

### 1. Database Setup
Run the `database.sql` file to create the necessary tables and sample data:
```sql
-- Import the database.sql file into your MySQL database
-- This will create all necessary tables and sample data
```

### 2. Default Roles
The system comes with 3 default roles:
- **Owner/Admin**: Full access to all system features
- **Staff Gudang**: Manage inventory operations
- **Keuangan**: Access to financial reports and data

### 3. Default Users
Sample users are created with the following credentials:
- **Admin User**: admin@inventory.com (Password: admin123)
- **Budi Santoso**: budi@inventory.com (Password: admin123)
- **Siti Aminah**: siti@inventory.com (Password: admin123)
- **Ahmad Yani**: ahmad@inventory.com (Password: admin123)
- **Rina Dewi**: rina@inventory.com (Password: admin123)
- **Joko Widodo**: joko@inventory.com (Password: admin123) - Inactive

### 4. Accessing the Role Management
1. Login to the system with admin credentials
2. Navigate to "Manajemen Role" in the sidebar
3. Use the tabs to switch between "Roles" and "Users" views

## Usage

### Managing Roles
- View all roles with their permissions and user counts
- Click "Tambah Role" to create new roles
- Each role card shows:
  - Role name and description
  - Number of users assigned
  - List of permissions

### Managing Users
- View all users with their roles and status
- Search users by name or email
- Click "Tambah User" to create new users
- Each user card shows:
  - User name and contact information
  - Assigned role
  - Active/inactive status
  - Last login time

### Creating New Roles
1. Click "Tambah Role" button
2. Fill in role name, code, and description
3. Submit the form

### Creating New Users
1. Switch to "Users" tab
2. Click "Tambah User" button
3. Fill in user details and select a role
4. Submit the form

## File Structure
```
src/
├── controllers/web/RoleController.php    # Role management logic
├── views/roles/index.php                 # Role management interface
├── models/Role.php                       # Role model
├── models/User.php                       # User model
├── public/assets/css/roles.css          # Role-specific styling
└── routes/web.php                       # Updated routes
```

## API Endpoints
- `GET /roles` - View role management page
- `POST /roles/create` - Create new role
- `POST /roles/create-user` - Create new user
- `POST /roles/toggle-user-status` - Toggle user status

## Permissions System
The system uses a granular permission system with the following permissions:
- Dashboard
- Data Bahan Baku
- Data Supplier
- Data Kategori
- Stok Masuk
- Stok Keluar
- Penyesuaian Stok
- Laporan Stok
- Laporan Transaksi
- Bahan Hampir Habis
- Manajemen Role
- Profil Saya

## Customization
You can customize the role colors by modifying the `getRoleColor()` function in the view file. The system supports different gradient colors for different role types.

## Testing
Run `test_roles.php` to verify that the database connection and models are working correctly before using the role management system.