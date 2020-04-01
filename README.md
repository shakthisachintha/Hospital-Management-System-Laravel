# Smart Hospitals (Hospital Management System)
This is a complete hospital managemnt system written in php(Laravel)

## This has the following features
* Patient Management
    * Patinet Registration (IN/OUT)
    * Get Patient Registration Card (Barcode Included)
    * Search Patient
    * Edit Pateint Details
    * Patient Profile
    * Treatment History
    * Mark as Inactive (Soft Delete)
* Create Appointments
* Check Patient
    * Write Diagnosis
    * Prescribe Medicines
    * Add Medical Data
* Issue Medicines To Prescriptions
    * Keeps track of issued medicines
* Multi Language Support
* User Role Based Access Control
    * Admin
    * Doctor
    * Pharmacist
    * General Staff
 * Attendance Recording Of Users
    * Finger Print Attendance Recording System
 * Report Generation
    * Patient Report
    * Medicine Report
    * Attendance Report
    

# Installation Guide
    1)Install Composer In Your PC
    
    2)Clone Or Download The Repository
    
    3)Goto The Repository and Open a Terminal Enter Following Commands 
        composer install
    
    4)Add the .env File(You Can Find It In The Internet)
    
    5)Set the .env File with the relevant configuration
    
    6)Execute the Following Command
        php artisan generate:key
        php artisan migrate
        php artisan serve
        php artisan db:seed
    
    7)There are some accounts already created 
        pw    : 12345678
    
    8)Enjoy !!!

# Note
Every Time You Pull The Repo Perform 
    composer update (There will be added new dependencies to the project)

Every Time You Make A Change To The Database Do The Change In The Migrations(Not Directly To The Real Database)


