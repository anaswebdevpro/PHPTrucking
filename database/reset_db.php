<?php
require_once __DIR__ . '/../app/config/config.php';

try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Dropping all existing tables...\n";
    $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    foreach($tables as $table) {
        $pdo->exec("DROP TABLE `$table`");
        echo "Dropped table: $table\n";
    }
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");

    echo "\nCreating fresh tables...\n";

    // 1. Admins Table
    $pdo->exec("CREATE TABLE admins (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    $password = password_hash('admin123', PASSWORD_DEFAULT);
    $pdo->exec("INSERT INTO admins (username, password) VALUES ('admin', '$password')");

    // 2. Settings Table
    $pdo->exec("CREATE TABLE settings (
        id INT AUTO_INCREMENT PRIMARY KEY,
        site_name VARCHAR(255) DEFAULT 'Truck Zone',
        phone VARCHAR(50),
        email VARCHAR(100),
        address TEXT,
        facebook VARCHAR(255),
        instagram VARCHAR(255),
        twitter VARCHAR(255),
        linkedin VARCHAR(255),
        logo VARCHAR(255),
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");
    $pdo->exec("INSERT INTO settings (site_name, phone, email, address, facebook, instagram, twitter, linkedin) 
        VALUES ('TRUCKZONE', '(514) 802-9999', 'info@truckzone.ca', '2362 46th Ave, Lachine, QC H8T 2P3', '#', '#', '#', '#')");

    // 3. Banners Table (for Hero Slider)
    $pdo->exec("CREATE TABLE banners (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255),
        image VARCHAR(255) NOT NULL,
        is_active BOOLEAN DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    $pdo->exec("INSERT INTO banners (title, image) VALUES ('THE PARTS YOU NEED. THE SERVICE YOU DESERVE.', 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?auto=format&fit=crop&w=2070&q=80')");

    // 4. Homepage Sections
    $pdo->exec("CREATE TABLE homepage_sections (
        id INT AUTO_INCREMENT PRIMARY KEY,
        section_key VARCHAR(50) UNIQUE NOT NULL,
        title VARCHAR(255),
        content TEXT,
        image VARCHAR(255),
        is_active BOOLEAN DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )");
    $defaultSections = [
        ['hero', 'THE PARTS YOU NEED.<br>THE SERVICE YOU DESERVE.', 'Your trusted source for premium heavy-duty semi truck and trailer parts. With 3 locations and over 10,000+ parts in stock, we keep your fleet moving with fast turnaround and expert fitment.', ''],
        ['support', '24/7 Dedicated Fleet Support', 'Downtime costs you money. Our expert fitment and support team is dedicated to getting your fleet back on the road as quickly as possible. Whether you need a simple filter or a complete engine rebuild kit, we have you covered.', 'https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&w=1000&q=80'],
        ['cta', 'CAN\'T FIND WHAT YOU NEED?', 'Our team can source any part for any make and model. Give us a call and we\'ll track it down for you instantly with our nationwide network.', '']
    ];
    $stmt = $pdo->prepare("INSERT INTO homepage_sections (section_key, title, content, image) VALUES (?, ?, ?, ?)");
    foreach($defaultSections as $sec) { $stmt->execute($sec); }

    // 5. Testimonials
    $pdo->exec("CREATE TABLE testimonials (
        id INT AUTO_INCREMENT PRIMARY KEY,
        author_name VARCHAR(100),
        author_role VARCHAR(100),
        content TEXT,
        avatar VARCHAR(255),
        stars INT DEFAULT 5,
        is_active BOOLEAN DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    $pdo->exec("INSERT INTO testimonials (author_name, author_role, content, avatar, stars) VALUES 
        ('Jaspreet Singh', 'Owner Operator', 'The truck zone, best shop in Montreal. The manager helped me get all the parts for my truck.', 'https://images.unsplash.com/photo-1599566150163-29194dcaad36?auto=format&fit=crop&w=150&q=80', 5),
        ('Umer Javed', 'Fleet Manager', 'Excellent fast and efficient service. Great wide inventory and very competitive pricing.', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=150&q=80', 5)");

    // 6. FAQs
    $pdo->exec("CREATE TABLE faqs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        question VARCHAR(255),
        answer TEXT,
        is_active BOOLEAN DEFAULT 1,
        display_order INT DEFAULT 0
    )");
    $pdo->exec("INSERT INTO faqs (question, answer, display_order) VALUES 
        ('Do you carry both OEM and aftermarket parts?', 'Yes, we offer both OEM-grade and high-quality aftermarket options to accommodate your budget and fleet requirements.', 1),
        ('How quickly can I get my parts?', 'With over 10,000 items in stock across our 3 locations, many parts are available for same-day local pickup.', 2)");

    // 7. Parts Categories
    $pdo->exec("CREATE TABLE parts_categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(100),
        description TEXT,
        image VARCHAR(255),
        display_order INT DEFAULT 0,
        is_active BOOLEAN DEFAULT 1
    )");
    $pdo->exec("INSERT INTO parts_categories (title, description, image, display_order) VALUES 
        ('Engine & Emissions', 'Gaskets, filters, sensors, exhaust components, and complete engine rebuild kits.', 'https://images.unsplash.com/photo-1580273916550-e323be2ae537?auto=format&fit=crop&w=1000&q=80', 1),
        ('Air Brakes & Drums', 'Air brake components, drums, rotors, wheels, chambers, slack adjusters, and complete brake kits.', 'https://images.unsplash.com/photo-1542323565-d0c0f91bb816?auto=format&fit=crop&w=1000&q=80', 2)");

    // 8. Services
    $pdo->exec("CREATE TABLE services (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        description TEXT NOT NULL,
        image VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // 9. Contacts
    $pdo->exec("CREATE TABLE contact_messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        subject VARCHAR(255),
        message TEXT NOT NULL,
        is_read BOOLEAN DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    echo "\nDatabase successfully rebuilt with completely fresh, dynamic schema!\n";

} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
