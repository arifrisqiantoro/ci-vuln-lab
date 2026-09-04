-- Skema database untuk CI Vuln Lab
-- Jalankan di database `ci_vuln_lab` (buat dulu database-nya)

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(50) NOT NULL,  -- sengaja plaintext untuk lab
  role VARCHAR(20) NOT NULL DEFAULT 'user'
);

-- Data contoh (password plaintext, sengaja untuk lab)
INSERT INTO users (username, password, role) VALUES
('admin', 'SuperSecret123', 'admin'),
('budi', 'password1', 'user'),
('siti', 'qwerty123', 'user');
