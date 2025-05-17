<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">
  </a>
</p>

<p align="center">
  <strong>Karawang Regency Tourism Information System</strong><br>
  A Laravel-based web project developed in collaboration with the Karawang Tourism Office, also serving as an undergraduate thesis.
</p>

---

## 📌 Project Overview

This project is a web-based information system designed to present data about tourist destinations, events, local culture, and supporting facilities within Karawang Regency. Built with the **Laravel** framework, the system aims to help tourists and locals easily access tourism-related information in a fast, accurate, and interactive manner.

---

## 🚀 Key Features

-   Detailed information about tourist spots (name, location, description, gallery)
-   Search and filter by category
-   Calendar of local events and activities
-   Admin panel for content management
-   Responsive and user-friendly interface

---

## 🧰 Tech Stack

-   **Laravel** – Backend framework and routing
-   **Blade Template** – Templating engine
-   **MySQL** – Relational database
-   **Bootstrap / Tailwind CSS** – UI design (based on implementation)
-   **Leaflet.js** _(optional)_ – Map integration

---

## 🏛️ Collaboration

This project was developed in collaboration with the **Karawang Tourism Office** to support the digital transformation of regional tourism services.

---

## 🎓 Thesis Information

-   **Title**: Tourism Information System of Karawang Regency Using the Prototype Method
-   **Author**: Tisna Hidayat
-   **Study Program**: Informatics Engineering
-   **University**: Universitas Ahmad Dahlan

---

## ⚙️ Local Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/yourusername/your-repo-name.git
    cd your-repo-name
    ```
2. Install dependecy with composer
    ```bash
    composer install
    ```
3. Copy environment file and generate app key

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. Set configurate database

    ```bash
    DB_DATABASE={your_db} (soon db dummy)
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. Run migrate database
    ````bash
    php artisan migrate --seed
     ```
6. Run local server
    ```bash
    php artisan serve
    ```
