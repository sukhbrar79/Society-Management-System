# Society Management System

**This project is a **comprehensive Society Management System** designed to streamline the management of residential societies by providing an integrated solution for handling complaints, visitor records, parking, flats, users, and much more. ** Laravel ** powers the system for the backend, and provides APIs for seamless integration with mobile applications.
**---

### API Implementation

APIs were built using the **Laravel Passport** package to connect the mobile app with the backend system ([documentation](https://laravel.com/docs/11.x/passport)). Passport was chosen for its full OAuth2 server implementation, ensuring secure API authentication through access tokens. 

For API documentation and testing, a **Postman Workspace** was created, helping to document and test APIs efficiently.

#### API Documentation
[Postman API Documentation](https://documenter.getpostman.com/view/35280422/2sA3duFYNc)

APIs handle the following functionalities:
- Managing complaints
- Visitors
- Parking
- Flats
- User authentication
- Notifications
- Emergency details

---

## Features

### Login Page
- A common login page for all user roles (admin, staff, manager, security guard).
- Users can log in using their registered email ID and password.

---

### Dashboard
- Serves as a central control panel for managing society operations.
- Displays key metrics:
  - Total number of residents.
  - Number of active complaints.
  - Parking details.
  - Pending maintenance tasks.

---

### Block Component
- Manages and maintains detailed information about each block in the residential society.
- Streamlines maintenance for common areas.

---

### Flats Component
- Manages and maintains detailed information about each flat.
- Helps in organizing flat-related data and managing occupancy.

---

### Residents Component
- Maintains detailed profiles for each resident, including:
  - Name
  - Contact information
  - Flat number
- Ensures easy management of resident records.

---

### Residents Complaints/Service Requests
- Provides a structured approach to handle and resolve complaints efficiently.
- Ensures timely resolution and resident satisfaction.

---

### Maintenance Invoices
- Streamlines the process of:
  - Generating invoices.
  - Distributing maintenance bills.
  - Managing payments.
- Ensures accurate billing and transparent financial management.

---

### Emergency Contacts Component
- Provides residents quick access to emergency contacts via the mobile app.
- Allows admin to easily add new contacts for various departments.

---

### Parking Component
- Efficiently manages and allocates parking spaces.
- Simplifies parking management by allowing residents to reserve and manage spaces.

---

### Visitors Component
- Enhances security with a streamlined visitor management system.
- Enables security personnel to register visitors who arrive without prior notice.

---

### Notice Board Component
- Streamlines communication within the society.
- Ensures all important announcements and updates are easily accessible via the mobile app.

---

### Users Component
- Admin can create and manage different user roles, such as:
  - Administrator
  - Manager
  - Executive
  - Resident
  - Security Guard
  - Service Staff
- Permissions can be assigned based on roles and requirements.

---

## Tech Stack

### Backend
- **Laravel**: For backend logic and API development.

### Database
- **MySQL**: For storing all data related to residents, flats, complaints, parking, and more.

---

## Installation

### Prerequisites
- PHP >= 8.1  
- Composer
- MySQL >= 5.7  

### Steps
1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/society-management-system.git
2. Navigate to the project directory:
   ```bash
    cd society-management-system
   
3. Install backend dependencies:
   ```bash
    composer install
   
4. Configure the .env file with your database and application settings.

5. Generate the application key:
    ```bash
    php artisan key:generate
    
6. Run migrations to create the database tables:
    ```bash
    php artisan migrate
7. Start the development server:
    ```bash
    php artisan serve
