# 🐧 Ansible LAMP Stack Deployment with Docker Compose v2

This project automates the deployment of a **LAMP stack (Linux, Apache, MySQL/MariaDB, PHP)** using **Ansible** and **Docker Compose v2** on a remote Linux host.

It is designed for clean infrastructure-as-code practices and public sharing — all secrets and real inventory details are excluded.

---

## 📦 Stack Components

This Ansible playbook provisions:

- **Docker CE** (Community Edition)
- **Docker Compose v2 plugin**
- A LAMP stack using official Docker images:
  - `php:8.2-apache`
  - `mariadb:10.6`
- Secrets (MySQL credentials) managed via **Ansible Vault**
- Config templating with **Jinja2**

---

## 📁 Project Structure


