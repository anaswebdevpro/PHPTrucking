<?php
require_once __DIR__ . '/../app/config/config.php';
try {
    $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS);
    $sql = "CREATE TABLE IF NOT EXISTS homepage_sections (
        id INT AUTO_INCREMENT PRIMARY KEY,
        section_key VARCHAR(50) UNIQUE NOT NULL,
        title VARCHAR(255),
        content TEXT,
        image VARCHAR(255),
        is_active BOOLEAN DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    
    // Insert defaults
    $sql = "INSERT IGNORE INTO homepage_sections (section_key, title, content) VALUES
        ('hero', 'Welcome to Truck Service', 'We provide the best trucking solutions.'),
        ('about', 'About Us', 'We have been in the trucking industry for over 20 years.'),
        ('services', 'Our Services', 'Check out our comprehensive range of services.'),
        ('why_choose_us', 'Why Choose Us', 'Reliability, speed, and safety.'),
        ('cta', 'Ready to ship?', 'Contact us today for a quote.')";
    $pdo->exec($sql);
    
    echo "homepage_sections table created and populated successfully.\n";
} catch(PDOException $e) {
    echo $e->getMessage();
}
