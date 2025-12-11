-- Database: inventory_manager
-- SQL Script untuk membuat database dan tabel sesuai ERD

-- Create Database
CREATE DATABASE IF NOT EXISTS inventory_manager CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE inventory_manager;

-- Table: roles
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    code VARCHAR(50) NOT NULL UNIQUE,
    description VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_code (code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: permissions
CREATE TABLE permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    code VARCHAR(100) NOT NULL UNIQUE,
    description VARCHAR(255),
    is_active TINYINT(1) DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_code (code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: role_permissions
CREATE TABLE role_permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    role_id INT NOT NULL,
    permission_id INT NOT NULL,
    is_default BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE,
    UNIQUE KEY unique_role_permission (role_id, permission_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    avatar_url VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    remember_token VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: user_roles
CREATE TABLE user_roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    role_id INT NOT NULL,
    is_default BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_role (user_id, role_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: categories
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: suppliers
CREATE TABLE suppliers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    contact_person VARCHAR(100),
    phone VARCHAR(50),
    email VARCHAR(255),
    address TEXT,
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: materials
CREATE TABLE materials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(50) UNIQUE,
    name VARCHAR(255) NOT NULL,
    category_id INT,
    default_supplier_id INT,
    unit VARCHAR(50) NOT NULL,
    min_stock DECIMAL(18,2) NOT NULL DEFAULT 0,
    current_stock DECIMAL(18,2) NOT NULL DEFAULT 0,
    image_url VARCHAR(255),
    is_active BOOLEAN DEFAULT TRUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL,
    FOREIGN KEY (default_supplier_id) REFERENCES suppliers(id) ON DELETE SET NULL,
    INDEX idx_code (code),
    INDEX idx_active (is_active)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: material_images
CREATE TABLE material_images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    material_id INT NOT NULL,
    image_url VARCHAR(255) NOT NULL,
    is_primary BOOLEAN DEFAULT FALSE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (material_id) REFERENCES materials(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: stock_in (Stok Masuk)
CREATE TABLE stock_in (
    id INT AUTO_INCREMENT PRIMARY KEY,
    material_id INT NOT NULL,
    supplier_id INT,
    quantity DECIMAL(18,2) NOT NULL,
    unit_price DECIMAL(18,2),
    total_price DECIMAL(18,2),
    txn_date DATE NOT NULL,
    reference_number VARCHAR(100),
    note TEXT,
    created_by INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (material_id) REFERENCES materials(id) ON DELETE RESTRICT,
    FOREIGN KEY (supplier_id) REFERENCES suppliers(id) ON DELETE SET NULL,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_txn_date (txn_date),
    INDEX idx_material (material_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: stock_out (Stok Keluar)
CREATE TABLE stock_out (
    id INT AUTO_INCREMENT PRIMARY KEY,
    material_id INT NOT NULL,
    quantity DECIMAL(18,2) NOT NULL,
    usage_type VARCHAR(100),
    txn_date DATE NOT NULL,
    reference_number VARCHAR(100),
    note TEXT,
    created_by INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (material_id) REFERENCES materials(id) ON DELETE RESTRICT,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_txn_date (txn_date),
    INDEX idx_material (material_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: stock_adjustments (Penyesuaian Stok)
CREATE TABLE stock_adjustments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    material_id INT NOT NULL,
    old_stock DECIMAL(18,2) NOT NULL,
    new_stock DECIMAL(18,2) NOT NULL,
    difference DECIMAL(18,2) NOT NULL,
    reason VARCHAR(255),
    adjustment_date DATE NOT NULL,
    created_by INT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (material_id) REFERENCES materials(id) ON DELETE RESTRICT,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_adjustment_date (adjustment_date),
    INDEX idx_material (material_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: activity_logs
CREATE TABLE activity_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(100) NOT NULL,
    entity_type VARCHAR(50),
    entity_id INT,
    description TEXT,
    ip_address VARCHAR(45),
    user_agent VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_user (user_id),
    INDEX idx_created_at (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert default roles
INSERT INTO roles (name, code, description, is_active) VALUES
('Administrator', 'admin', 'Full access to all features', 1),
('Manager', 'manager', 'Manage inventory and reports', 1),
('Staff', 'staff', 'Basic inventory operations', 1);

-- Insert default permissions (33 permissions)
INSERT INTO permissions (name, code, description, is_active) VALUES
-- Dashboard (1)
('View Dashboard', 'view_dashboard', 'Access to dashboard', 1),

-- Materials (6)
('View Materials', 'view_materials', 'View materials list', 1),
('Create Materials', 'create_materials', 'Add new materials', 1),
('Edit Materials', 'edit_materials', 'Edit existing materials', 1),
('Delete Materials', 'delete_materials', 'Delete materials', 1),
('Export Materials', 'export_materials', 'Export materials data', 1),
('Import Materials', 'import_materials', 'Import materials data', 1),

-- Categories (4)
('View Categories', 'view_categories', 'View categories list', 1),
('Create Categories', 'create_categories', 'Add new categories', 1),
('Edit Categories', 'edit_categories', 'Edit existing categories', 1),
('Delete Categories', 'delete_categories', 'Delete categories', 1),

-- Suppliers (4)
('View Suppliers', 'view_suppliers', 'View suppliers list', 1),
('Create Suppliers', 'create_suppliers', 'Add new suppliers', 1),
('Edit Suppliers', 'edit_suppliers', 'Edit existing suppliers', 1),
('Delete Suppliers', 'delete_suppliers', 'Delete suppliers', 1),

-- Stock In (4)
('View Stock In', 'view_stock_in', 'View stock in transactions', 1),
('Create Stock In', 'create_stock_in', 'Record stock in transactions', 1),
('Edit Stock In', 'edit_stock_in', 'Edit stock in transactions', 1),
('Delete Stock In', 'delete_stock_in', 'Delete stock in transactions', 1),

-- Stock Out (4)
('View Stock Out', 'view_stock_out', 'View stock out transactions', 1),
('Create Stock Out', 'create_stock_out', 'Record stock out transactions', 1),
('Edit Stock Out', 'edit_stock_out', 'Edit stock out transactions', 1),
('Delete Stock Out', 'delete_stock_out', 'Delete stock out transactions', 1),

-- Stock Adjustments (3)
('View Stock Adjustments', 'view_stock_adjustments', 'View stock adjustments', 1),
('Create Stock Adjustments', 'create_stock_adjustments', 'Create stock adjustments', 1),
('Delete Stock Adjustments', 'delete_stock_adjustments', 'Delete stock adjustments', 1),

-- Reports (3)
('View Reports', 'view_reports', 'Access to reports', 1),
('Export Reports', 'export_reports', 'Export report data', 1),
('View Low Stock', 'view_low_stock', 'View low stock alerts', 1),

-- Users (4)
('View Users', 'view_users', 'View users list', 1),
('Create Users', 'create_users', 'Add new users', 1),
('Edit Users', 'edit_users', 'Edit existing users', 1),
('Delete Users', 'delete_users', 'Delete users', 1);

-- Assign ALL permissions to Administrator role
INSERT INTO role_permissions (role_id, permission_id, is_default)
SELECT 
    (SELECT id FROM roles WHERE code = 'admin'),
    id,
    TRUE
FROM permissions;

-- Assign permissions to Manager role (20 permissions)
INSERT INTO role_permissions (role_id, permission_id, is_default)
SELECT 
    (SELECT id FROM roles WHERE code = 'manager'),
    id,
    TRUE
FROM permissions
WHERE code IN (
    'view_dashboard',
    'view_materials', 'create_materials', 'edit_materials', 'export_materials',
    'view_categories', 'create_categories', 'edit_categories',
    'view_suppliers', 'create_suppliers', 'edit_suppliers',
    'view_stock_in', 'create_stock_in', 'edit_stock_in',
    'view_stock_out', 'create_stock_out', 'edit_stock_out',
    'view_stock_adjustments', 'create_stock_adjustments',
    'view_reports', 'export_reports', 'view_low_stock'
);

-- Assign permissions to Staff role (9 permissions)
INSERT INTO role_permissions (role_id, permission_id, is_default)
SELECT 
    (SELECT id FROM roles WHERE code = 'staff'),
    id,
    TRUE
FROM permissions
WHERE code IN (
    'view_dashboard',
    'view_materials',
    'view_categories',
    'view_suppliers',
    'view_stock_in', 'create_stock_in',
    'view_stock_out', 'create_stock_out',
    'view_low_stock'
);

-- Create default admin user
-- Password: admin123
INSERT INTO users (name, email, password_hash, is_active) VALUES
('Administrator', 'admin@inventory.com', '$2y$12$LQv3c1yycjQzybzKj0Rlj.8r1r5Jq5F5R1F5R1F5R1F5R1F5R1F5Ru', TRUE);

-- Assign admin role to admin user
INSERT INTO user_roles (user_id, role_id, is_default)
VALUES (1, (SELECT id FROM roles WHERE code = 'admin'), TRUE);

-- Insert sample categories
INSERT INTO categories (name, description) VALUES
('Bahan Baku Utama', 'Bahan baku utama untuk produksi'),
('Bahan Pembantu', 'Bahan pembantu dalam proses produksi'),
('Bahan Kemasan', 'Material untuk kemasan produk'),
('Bahan Kimia', 'Bahan kimia untuk proses produksi');

-- Insert sample suppliers
INSERT INTO suppliers (name, contact_person, phone, email, address, is_active) VALUES
('PT Supplier Utama', 'John Doe', '081234567890', 'supplier1@email.com', 'Jakarta', TRUE),
('CV Bahan Baku', 'Jane Smith', '082345678901', 'supplier2@email.com', 'Bandung', TRUE),
('PT Material Indo', 'Bob Johnson', '083456789012', 'supplier3@email.com', 'Surabaya', TRUE);

-- Note: Password untuk admin user adalah 'admin123'
-- Untuk generate password hash baru, gunakan PHP:
-- password_hash('password_anda', PASSWORD_DEFAULT)
