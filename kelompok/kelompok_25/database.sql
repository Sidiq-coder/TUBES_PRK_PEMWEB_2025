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
INSERT INTO roles (name, code, description) VALUES
('Administrator', 'admin', 'Full access to all features'),
('Manager', 'manager', 'Manage inventory and reports'),
('Staff', 'staff', 'Basic inventory operations');

-- Insert default permissions
INSERT INTO permissions (name, code, description) VALUES
('Dashboard', 'dashboard', 'Access to dashboard'),
('Data Bahan Baku', 'data_bahan_baku', 'Manage materials data'),
('Data Supplier', 'data_supplier', 'Manage supplier information'),
('Data Kategori', 'data_kategori', 'Manage categories'),
('Stok Masuk', 'stok_masuk', 'Record incoming stock'),
('Stok Keluar', 'stok_keluar', 'Record outgoing stock'),
('Penyesuaian Stok', 'penyesuaian_stok', 'Adjust stock levels'),
('Laporan Stok', 'laporan_stok', 'View stock reports'),
('Laporan Transaksi', 'laporan_transaksi', 'View transaction reports'),
('Bahan Hampir Habis', 'bahan_hampir_habis', 'View low stock alerts'),
('Manajemen Role', 'manajemen_role', 'Manage user roles and permissions'),
('Profil Saya', 'profil_saya', 'Manage personal profile');

-- Assign permissions to admin role
INSERT INTO role_permissions (role_id, permission_id, is_default)
SELECT 
    (SELECT id FROM roles WHERE code = 'admin'),
    id,
    TRUE
FROM permissions;

-- Assign permissions to manager role
INSERT INTO role_permissions (role_id, permission_id, is_default)
SELECT 
    (SELECT id FROM roles WHERE code = 'manager'),
    id,
    TRUE
FROM permissions
WHERE code IN ('view_dashboard', 'view_materials', 'create_materials', 'edit_materials', 
               'view_stock', 'stock_in', 'stock_out', 'stock_adjustment', 
               'view_reports', 'manage_suppliers', 'manage_categories');

-- Assign permissions to staff role
INSERT INTO role_permissions (role_id, permission_id, is_default)
SELECT 
    (SELECT id FROM roles WHERE code = 'staff'),
    id,
    TRUE
FROM permissions
WHERE code IN ('view_dashboard', 'view_materials', 'view_stock', 'stock_in', 'stock_out');

-- Create default users
-- Password for all users: admin123
INSERT INTO users (name, email, password_hash, phone, is_active) VALUES
('Admin User', 'admin@inventory.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0812-3456-7890', TRUE),
('Budi Santoso', 'budi@inventory.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0813-4567-8901', TRUE),
('Siti Aminah', 'siti@inventory.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0814-5678-9012', TRUE),
('Ahmad Yani', 'ahmad@inventory.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0815-6789-0123', TRUE),
('Rina Dewi', 'rina@inventory.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0816-7890-1234', TRUE),
('Joko Widodo', 'joko@inventory.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0817-8901-2345', FALSE);

-- Assign roles to users
INSERT INTO user_roles (user_id, role_id, is_default) VALUES
(1, (SELECT id FROM roles WHERE code = 'admin'), TRUE),
(2, (SELECT id FROM roles WHERE code = 'admin'), TRUE),
(3, (SELECT id FROM roles WHERE code = 'manager'), TRUE),
(4, (SELECT id FROM roles WHERE code = 'manager'), TRUE),
(5, (SELECT id FROM roles WHERE code = 'staff'), TRUE),
(6, (SELECT id FROM roles WHERE code = 'manager'), TRUE);

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
