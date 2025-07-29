# Hostel Repair Work Management System

A web-based system designed to streamline the process of reporting and managing repair requests in a college hostel.

## 🛠️ Tech Stack

* **Frontend**: HTML, CSS, JavaScript
* **Backend**: PHP
* **Database**: phpMyAdmin, MySQLi

## 📌 Features

* **Resident Portal**

  * Residents can register and log in to submit repair requests for their hostel rooms or common areas.
  * Requests include details such as type of issue, location, and urgency.

* **Warden/Hostel Staff Dashboard**

  * View all incoming repair requests.
  * Accept, decline, or mark requests as pending.
  * Track the status of each repair for accountability.

* **Admin Panel**

  * Add or delete hostel occupants.
  * View and oversee all repair requests.
  * Manage user roles and system data.

## 🚀 Getting Started

To run the project locally:

1. **Clone the repository**

   ```bash
   git clone https://github.com/walkingacorn/hostel-repairwork-management-system.git
   ```

2. **Set up a local server**
   Install XAMPP or any local server environment.

3. **Start Apache and MySQL** using the XAMPP control panel.

4. **Set up the database**

   * Open phpMyAdmin at [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   * Create a new database (e.g., `hostel_repair_system`)
   * Import the provided SQL file (`hostel_repair_system.sql`) located in the project folder

5. **Run the project**

   * Place the project folder in the `htdocs` directory (e.g., `C:/xampp/htdocs/`)
   * Open your browser and go to:
     [http://localhost/hostel-repairwork-management-system](http://localhost/hostel-repairwork-management-system)

## 📂 Folder Structure

```
hostel-repairwork-management-system/
├── All project files are provided in this folder
├── hostel_system.sql      # SQL file for database setup
├── login.php              # Login page
└── README.md
```

## 📄 License

This project is for academic and educational use. Feel free to use, modify, or build upon it with proper attribution.
