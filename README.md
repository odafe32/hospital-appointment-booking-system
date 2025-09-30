# 🏥 eDoc eChanneling – Online Doctor Appointment System

![Screenshot](https://github.com/hshnudr/edoc-echanneling/blob/main/Screenshots/Screenshot%20(1).png)

**eDoc eChanneling** is a simple yet powerful web-based doctor appointment system designed for clinics, hospitals, and medical establishments. It allows patients to request appointments online, doctors to manage their schedules, and administrators to oversee the entire system.

The system has  **three user roles** :

* **Admin** – manages doctors, sessions, and patient records.
* **Doctor** – manages appointments, patient details, and account settings.
* **Patient** – books appointments online, manages bookings, and edits their profile.

---

## ✨ Features

### 🔹 Admin

* Add, edit, and delete doctor records
* Schedule or remove doctor sessions
* View patient details
* View and manage appointment bookings

![Admin Screenshot](https://github.com/hshnudr/edoc-echanneling/blob/main/Screenshots/Screenshot%20(3).png)

### 🔹 Doctor

* View appointment requests and schedules
* Access patient details
* Manage account settings (edit or delete account)

![Doctor Screenshot](https://github.com/hshnudr/edoc-echanneling/blob/main/Screenshots/Screenshot%20(9).png)

### 🔹 Patient

* Create an account and book appointments online
* View old bookings
* Edit or delete account

![Patient Screenshot](https://github.com/hshnudr/edoc-echanneling/blob/main/Screenshots/Screenshot%20(6).png)

⚠️ **Note:** All users (Admin, Doctor, Patient) share a  **single login page** .

---

## 🚀 Getting Started

### Step 1 – Environment Setup

1. Install [XAMPP](https://www.apachefriends.org/download.html) or any PHP server stack.
2. Ensure you are using:
   * **Apache 2.4+**
   * **PHP 8.2+** (recommended for latest features & security)
   * **MySQL 8.0+**

### Step 2 – Project Setup

1. Start **Apache** and **MySQL** in XAMPP.
2. Extract the downloaded project folder.
3. Copy it into your XAMPP `htdocs` directory.
4. Open **phpMyAdmin** in a browser: [http://localhost/phpmyadmin](http://localhost/phpmyadmin).
5. Create a new database named `edoc`.
6. Import the SQL file: `DATABASE/edoc.sql`.
7. Run the project in your browser:
   ```
   http://localhost/edoc-echanneling-main/
   ```

---

## 🔑 Default User Accounts

| Role              | Email                                    | Password |
| ----------------- | ---------------------------------------- | -------- |
| **Admin**   | [admin@edoc.com](mailto:admin@edoc.com)     | 123      |
| **Doctor**  | [doctor@edoc.com](mailto:doctor@edoc.com)   | 123      |
| **Patient** | [patient@edoc.com](mailto:patient@edoc.com) | 123      |

---

## 🛠️ Tech Stack

* **Frontend:** HTML5, CSS3, JavaScript
* **Backend:** PHP 8.2+
* **Database:** MySQL 8.0+
* **Server:** Apache 2.4+


## 📧 Author

**Maintainer:** Godfrey J. Sule

📩 Email: [godfreyj.sule@gmail.com](mailto:godfreyj.sule@gmail.com)

---
