# 🐧 Ansible LAMP Stack Deployment with Docker Compose v2 + Redis

This project automates the deployment of a **LAMP stack (Linux, Apache, MariaDB, PHP)** with **Redis** support using **Ansible** and **Docker Compose v2**.

Designed for reproducibility, public transparency, and infrastructure-as-code hygiene.

---

## 📦 Stack Components

This Ansible playbook provisions:

- **Docker CE** and **Docker Compose v2**
- A full LAMP stack:
  - `php:8.2-apache`
  - `mariadb:10.6`
- **Redis** (`redis:7.2-alpine`) for caching/session support
- Dynamic secrets via **Ansible Vault**
- Test-ready `index.php` for Redis validation

---

## 📁 Project Structure


