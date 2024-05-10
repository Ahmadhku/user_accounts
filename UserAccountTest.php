<?php
use PHPUnit\Framework\TestCase;

require 'submit_account.php'; // Assuming your form processing logic is here

class UserAccountTest extends TestCase
{
    // Test that passwords are correctly hashed
    public function testPasswordHashing()
    {
        $password = "examplePassword";
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $this->assertTrue(password_verify($password, $hash));
    }


    public function testPasswordMatch()
    {
        ob_start();  // Start output buffering
        // Simulate form submission
        require 'submit_account.php';
        $output = ob_get_clean();  // Get what was echoed and clean buffer
    
        $expected = "New account created successfully!";
        $this->assertStringContainsString($expected, $output);
    }
    
}
