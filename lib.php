<?php

class Logger {
    private $db;
    private $log_table;

    // Constructor to initialize the database connection and log table
    public function __construct($db, $log_table = 'custom_logs') {
        $this->db = $db;  // Accepts a PDO database connection object
        $this->log_table = $log_table;
    }

    // Function to insert a log with customizable parameters
    public function logAction($user_id, $action_type, $action_description, $extra_info = []) {
        // Prepare log data
        $log_data = [
            'user_id' => $user_id,
            'action_type' => $action_type,
            'action_description' => $action_description,
            'ip_address' => $this->getIPAddress(),
            'user_agent' => $this->getUserAgent(),
            'extra_info' => json_encode($extra_info),
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Insert into log table
        $this->insertLog($log_data);
    }

    // Function to insert log data into the database
    private function insertLog($log_data) {
        $sql = "INSERT INTO " . $this->log_table . " (user_id, action_type, action_description, ip_address, user_agent, extra_info, created_at) 
                VALUES (:user_id, :action_type, :action_description, :ip_address, :user_agent, :extra_info, :created_at)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($log_data);
    }

    // Function to get the user's IP address
    private function getIPAddress() {
        return $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN';
    }

    // Function to get the user's user agent string
    private function getUserAgent() {
        return $_SERVER['HTTP_USER_AGENT'] ?? 'UNKNOWN';
    }
}
