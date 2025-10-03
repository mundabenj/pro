<?php
// define database constants
require_once '../ClassAutoLoad.php';

// Seeders for roles
$roles = [
    'admin', 
    'editor', 
    'viewer'
];
foreach ($roles as $role) {
    $SQL->insert('roles', ['roleName' => $role]);
}

// Seeders for genders
$genders = [
    'female', 
    'male', 
    'prefer not to say'
];
foreach ($genders as $gender) {
    $SQL->insert('genders', ['genderName' => $gender]);
}

// Seeders for skills
$skills = [
    'PHP', 
    'JavaScript', 
    'HTML', 
    'CSS', 
    'MySQL', 
    'Python', 
    'Java', 
    'C#', 
    'Ruby', 
    'Go'
];

foreach ($skills as $skill) {
    $SQL->insert('skills', ['skillName' => $skill]);
}

echo "Database seeding completed. | " . date('Y-m-d H:i:s');