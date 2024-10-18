<?php 
// Include the logger class (make sure you have autoloading if using frameworks like Laravel)
require_once 'Logger.php';

// Establish a PDO connection (adjust with your database credentials)
$pdo = new PDO('mysql:host=localhost;dbname=my_database', 'username', 'password');

// Initialize the Logger class
$logger = new Logger($pdo);

$logger->logAction($user_id, 'Page Visit', 'Visited the homepage');
$logger->logAction($user_id, 'Button Click', 'Clicked on the Buy Now button');
$logger->logAction($user_id, 'Form Submission', 'Submitted contact form', [
    'form_data' => $_POST  // Optionally pass extra info (form data, etc.)
]);
////////// if you have framework connections
// Load Logger in a controller
require_once(APPPATH . 'libraries/Logger.php');

// Initialize Logger
$logger = new Logger($this->db->conn_id);  // Pass CI database connection

// Log an action
$logger->logAction($this->session->userdata('user_id'), 'Page Visit', 'Visited the About Us page');
