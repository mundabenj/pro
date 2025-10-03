<?php
// define database constants
require_once '../ClassAutoLoad.php';

// Seeders for roles
$roles = [
    'admin', 
    'editor', 
    'viewer',
    'student',
    'instructor',
    'guest',
    'moderator'
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
    'Go',
    'Swift',
    'Kotlin',
    'SQL',
    'NoSQL',
    'Django',
    'Flask',
    'React',
    'Angular',
    'Vue.js',
    'Node.js',
    'Laravel',
    'Symfony',
    'Spring',
    'ASP.NET',
    'Rails',
    'Docker',
    'Kubernetes',
    'AWS',
    'Azure'
];

foreach ($skills as $skill) {
    $SQL->insert('skills', ['skillName' => $skill]);
}

echo "Database seeding completed. | " . date('Y-m-d H:i:s');