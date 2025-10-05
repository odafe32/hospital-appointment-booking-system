# 🏥 eDoc Doctor Appointment System with Session Management

![Hospital Management System](https://github.com/odafe32/Hospital-appointment-system-/blob/main/Screenshots/Screenshot%20(1).png)

**Advanced Hospital Management System** - A comprehensive web-based doctor appointment and session management system designed for modern healthcare facilities. Features robust session cancellation, audit trails, and professional UI.

## 👥 User Roles & Access

The system supports **three distinct user roles** with specialized interfaces:

* **👨‍💼 Administrator** – Complete system oversight, doctor management, session scheduling, patient records, and cancellation management
* **👨‍⚕️ Doctor** – Appointment management, patient interaction, schedule control, and session cancellation capabilities
* **👤 Patient** – Online appointment booking, booking history, and account management

---

## ✨ Advanced Features

### 🔹 Administrator Panel
- **👥 Doctor Management** – Add, edit, remove doctor profiles and credentials
- **📅 Session Scheduling** – Create, modify, and manage doctor appointment sessions
- **📊 Patient Records** – Comprehensive patient data management and history
- **📋 Appointment Oversight** – Monitor all appointments across the system
- **❌ Session Cancellation** – Cancel sessions with audit trail and reason tracking
- **📈 Dashboard Analytics** – Real-time statistics and session metrics
- **🔒 Access Control** – Secure admin-only features and data protection

![Admin Dashboard](https://github.com/odafe32/Hospital-appointment-system-/blob/main/Screenshots/Screenshot%20(3).png)

### 🔹 Doctor Panel
- **📅 Appointment Management** – View, accept, and manage patient appointments
- **👥 Patient Interaction** – Access patient details and medical history
- **⏰ Schedule Control** – Manage personal schedule and availability
- **❌ Session Cancellation** – Cancel sessions with mandatory reason logging
- **📊 Performance Tracking** – Monitor appointment statistics and trends
- **⚙️ Account Settings** – Profile management and system preferences

![Doctor Interface](https://github.com/odafe32/Hospital-appointment-system-/blob/main/Screenshots/Screenshot%20(9).png)

### 🔹 Patient Portal
- **📅 Online Booking** – Easy appointment scheduling with doctor selection
- **📋 Booking History** – Complete record of past and upcoming appointments
- **👤 Profile Management** – Personal information and account settings
- **⏰ Session Awareness** – View available sessions and doctor schedules
- **📱 User-Friendly Interface** – Intuitive design for seamless patient experience

![Patient Portal](https://github.com/odafe32/Hospital-appointment-system-/blob/main/Screenshots/Screenshot%20(6).png)

### 🚀 Advanced Session Management
- **✅ Session Status Tracking** – Active, Cancelled, Completed status management
- **📋 Cancellation Audit Trail** – Complete history of cancellations with reasons
- **👨‍💼 Admin Override** – Administrators can cancel any session with full logging
- **⏱️ Timestamp Tracking** – Automatic recording of cancellation times and dates
- **📊 Cancellation Analytics** – Track patterns and reasons for improvements

---

## 🛠️ Technology Stack

* **Frontend:** HTML5, CSS3, JavaScript, Modern UI/UX Design
* **Backend:** PHP 8.2+ with Object-Oriented Architecture
* **Database:** MySQL 8.0+ with Optimized Schema
* **Server:** Apache 2.4+ Web Server
* **Security:** Input Validation, SQL Injection Prevention, XSS Protection

## 📦 Installation & Setup

### Prerequisites
1. **Web Server**: XAMPP, WAMP, or similar PHP development environment
2. **PHP Version**: 8.2 or higher (recommended for optimal performance)
3. **Database**: MySQL 8.0+
4. **Web Browser**: Modern browser with JavaScript enabled

### Quick Start
1. **Start Services**:
   ```bash
   # Launch XAMPP/WAMP and ensure Apache & MySQL are running
   ```

2. **Database Setup**:
   ```sql
   # Create database
   CREATE DATABASE edoc;

   # Import schema
   # Use phpMyAdmin or command line to import SQL_Database_edoc.sql
   ```

3. **Project Deployment**:
   ```bash
   # Copy project to web server directory
   # Example for XAMPP:
   cp -r project-folder/ /xampp/htdocs/edoc-system/
   ```

4. **Access Application**:
   ```
   http://localhost/edoc-system/
   ```

## 🔑 Default Credentials

| Role | Email | Password | Access Level |
|------|-------|----------|--------------|
| **Administrator** | admin@edoc.com | 123 | Full System Access |
| **Doctor** | doctor@edoc.com | 123 | Medical Staff Access |
| **Patient** | patient@edoc.com | 123 | Patient Portal Access |

## 📁 Project Structure

```
edoc-doctor-appointment-system-main/
├── 📁 admin/           # Administrator panel
│   ├── index.php      # Dashboard
│   ├── doctors.php    # Doctor management
│   ├── schedule.php   # Session management
│   ├── patient.php    # Patient records
│   └── appointment.php # Appointment oversight
├── 📁 doctor/          # Doctor panel
│   ├── index.php      # Doctor dashboard
│   ├── schedule.php   # Session management
│   └── settings.php   # Account settings
├── 📁 patient/         # Patient portal
│   ├── index.php      # Patient dashboard
│   ├── doctors.php    # Doctor directory
│   ├── schedule.php   # Available sessions
│   └── appointment.php # Booking management
├── 📁 css/            # Stylesheets
├── 📁 js/             # JavaScript files
├── 📁 img/            # Images and icons
├── 📁 asa/            # Additional assets
├── connection.php     # Database connection
├── login.php         # Authentication
└── SQL_Database_edoc.sql # Database schema
```

## 🎨 UI/UX Features

- **Modern Design** – Clean, professional medical interface
- **Responsive Layout** – Optimized for desktop and mobile devices
- **Dark Theme Accents** – Professional dark red styling for critical actions
- **Intuitive Navigation** – Role-based menu systems
- **Real-time Updates** – Dynamic content loading and status updates
- **Accessibility** – WCAG compliant interface design

## 🔒 Security Features

- **Authentication** – Secure login system with role validation
- **Authorization** – Role-based access control (RBAC)
- **Data Validation** – Input sanitization and validation
- **SQL Injection Prevention** – Parameterized queries
- **XSS Protection** – Output encoding and validation
- **Session Management** – Secure session handling

## 📊 Database Schema

### Enhanced Tables with Session Management:
- **admin** – System administrators
- **doctor** – Medical practitioners
- **patient** – System users/patients
- **schedule** – Appointment sessions (with status tracking)
- **appointment** – Patient bookings
- **session_cancellations** – Audit trail for cancellations

### Key Features:
- Status tracking (active/cancelled/completed)
- Cancellation reason logging
- Timestamp tracking
- Admin override capabilities

## 🚀 Recent Updates

### Version 2.0 - Session Cancellation System
- ✅ **Complete session cancellation workflow**
- ✅ **Audit trail implementation**
- ✅ **Enhanced UI with professional styling**
- ✅ **Multi-role cancellation permissions**
- ✅ **Database schema optimization**
- ✅ **Security enhancements**

## 👨‍💻 Development

**Project Maintainer:** Odafe32

**Repository:** [Hospital Appointment Booking System](https://github.com/odafe32/Hospital-appointment-system-)

**License:** Open Source (MIT)

---

## 📞 Support & Documentation

For technical support, feature requests, or contributions:
- 📧 **Email**: godfreyj.sule1@gmail.com
- 📖 **Documentation**: [System Guide](docs/)
- 🐛 **Issues**: [GitHub Issues](https://github.com/odafe32/Hospital-appointment-system-/issues)
- 💬 **Discussions**: [GitHub Discussions](https://github.com/odafe32/Hospital-appointment-system-/discussions)

---

**🏥 Built for Healthcare Excellence** – Streamlined appointment management with professional session control and comprehensive audit trails.
