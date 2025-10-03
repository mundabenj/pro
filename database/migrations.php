 <?php
require_once '../ClassAutoLoad.php'; // Include the autoloader

// Method to disable foreign key checks
$disable_fk_checks = $SQL->disableForeignKeyChecks();
if ($disable_fk_checks === TRUE) {
  echo "Foreign key checks disabled successfully | ";
} else {
  echo "Error disabling foreign key checks: " . $disable_fk_checks;
}

// Method to drop users table if exists
$drop_users = $SQL->dropTable('users');

// Method to create users table
$create_users = $SQL->createTable('users', [
    'userId' => 'bigint(10) AUTO_INCREMENT PRIMARY KEY',
    'fullname' => 'VARCHAR(50) default NULL',
    'email' => 'VARCHAR(100) default NULL unique',
    'password' => 'VARCHAR(60) NOT NULL',
    'verify_code' => 'VARCHAR(10) NOT NULL',
    'code_expiry_time' => 'DATETIME NULL',
    'mustchange' => 'tinyint(1) not null default 0',
    'status' => "ENUM('Active', 'Inactive', 'Suspended', 'Pending', 'Deleted') DEFAULT 'Pending'",
    'created' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
    'updated' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
    'roleId' => 'tinyint(1) not null default 1',
    'genderId' => 'tinyint(1) not null default 1'
]);

if ($create_users === TRUE) {
  echo "Table users created successfully | ";
} else {
  echo "Error creating table: " . $create_users;
}

// Method to drop roles table if exists
$drop_roles = $SQL->dropTable('roles');

// Method to create roles table
$create_roles = $SQL->createTable('roles', [
    'roleId' => 'tinyint(1) AUTO_INCREMENT PRIMARY KEY',
    'roleName' => 'VARCHAR(50) NOT NULL unique',
    'created' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
    'updated' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
]);

if ($create_roles === TRUE) {
  echo "Table roles created successfully | ";
} else {
  echo "Error creating table: " . $create_roles;
}

// Method to drop genders table if exists
$drop_genders = $SQL->dropTable('genders');

// Method to create genders table
$create_genders = $SQL->createTable('genders', [
    'genderId' => 'tinyint(1) AUTO_INCREMENT PRIMARY KEY',
    'genderName' => 'VARCHAR(50) NOT NULL unique',
    'created' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
    'updated' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
]);

if ($create_genders === TRUE) {
  echo "Table genders created successfully | ";
} else {
  echo "Error creating table: " . $create_genders;
}

// Method to drop skills table if exists
$drop_skills = $SQL->dropTable('skills');

// Method to create skills table
$create_skills = $SQL->createTable('skills', [
    'skillId' => 'bigint(10) AUTO_INCREMENT PRIMARY KEY',
    'skillName' => 'VARCHAR(50) NOT NULL unique',
    'created' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
    'updated' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
]);

// Method to drop user_skills table if exists
$drop_user_skills = $SQL->dropTable('user_skills');

// Method to create user_skills table
$create_user_skills = $SQL->createTable('user_skills', [
    'user_skillId' => 'bigint(10) AUTO_INCREMENT PRIMARY KEY',
    'userId' => 'bigint(10) NOT NULL',
    'skillId' => 'bigint(10) NOT NULL',
    'proficiency' => "ENUM('Beginner', 'Intermediate', 'Advanced', 'Expert') DEFAULT 'Beginner'",
    'created' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
    'updated' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'
]);

if ($create_user_skills === TRUE) {
  echo "Table user_skills created successfully | ";
} else {
  echo "Error creating table: " . $create_user_skills;
}

// Method to add constraints to users table
$alter_users_table = $SQL->addConstraint('users', 'roles', 'roleId', 'CASCADE', 'CASCADE');
$alter_users_table = $SQL->addConstraint('users', 'genders', 'genderId', 'CASCADE', 'CASCADE');
if ($alter_users_table === TRUE) {
  echo "Foreign key constraints added to users table successfully | ";
} else {
  echo "Error adding foreign key constraints: " . $alter_users_table;
}

// Method to add constraints to user_skills table
$alter_user_skills_table = $SQL->addConstraint('user_skills', 'users', 'userId', 'CASCADE', 'CASCADE');
$alter_user_skills_table = $SQL->addConstraint('user_skills', 'skills', 'skillId', 'CASCADE', 'CASCADE');
if ($alter_user_skills_table === TRUE) {
  echo "Foreign key constraints added to user_skills table successfully | ";
} else {
  echo "Error adding foreign key constraints: " . $alter_user_skills_table;
}

// Method to enable foreign key checks
$enable_fk_checks = $SQL->enableForeignKeyChecks();
if ($enable_fk_checks === TRUE) {
  echo "Foreign key checks enabled successfully | ";
} else {
  echo "Error enabling foreign key checks: " . $enable_fk_checks;
}

// Method to close the database connection
$SQL->closeConnection();