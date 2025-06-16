nsible-Driven Docker LAMP + Redis + HTTPS Stack

This repository automates deployment of a **LAMP** (Linux, Apache, MariaDB, PHP) stack with **Redis caching**, served over **HTTPS** via an NGINX reverse-proxy + Let’s Encrypt, all orchestrated by **Ansible** and **Docker Compose v2**.

---

## 📁 Repository Layout

```text
docker-lamp/
├── README.md
├── playbook.yml
├── inventory/                     # Public example inventory
│   └── hosts
├── inventory-private/             # Private real inventory (ignored)
├── group_vars/
│   ├── all.yml                    # Public example vars (committed)
│   └── local_all.yaml             # Your real domain/email (git-ignored)
├── vault/
│   └── secrets.yml                # Encrypted DB credentials
├── roles/
│   ├── docker/                    # Installs Docker & Compose v2
│   ├── lamp/                      # Builds PHP/Redis image, deploys app
│   └── proxy/                     # Sets up nginx-proxy + ACME companion
└── .gitignore

🔧 Prerequisites

    Control Node (your machine):

        Ansible ≥ 2.14

        docker CLI & docker compose plugin installed (for local testing)

    Target Host (e.g. Ubuntu 22.04 ARM VM):

        SSH access as a sudo-enabled user

        Internet access for Docker Hub & Let’s Encrypt

⚙️ Configuration
1. Inventory

    Public template: inventory/hosts

    Real inventory (ignored): inventory-private/hosts

2. Group-Vars

    Example (group_vars/all.yml, committed):

virtual_host: yourdomain.com
letsencrypt_email: you@example.com

Local override (group_vars/local_all.yaml, git-ignored):

    virtual_host: lamp.micohosting.com
    letsencrypt_email: admin@micohosting.com

        Ansible will load local_all.yaml first when you include it below.

3. Vaulted Secrets

Encrypted DB credentials in vault/secrets.yml:

mysql_root_password: "StrongRootPass"
mysql_user: "lampuser"
mysql_password: "SecurePass123"
mysql_database: "lampdb"

🚀 Deployment

    Clone the repo

git clone git@github.com:yourusername/docker-lamp.git
cd docker-lamp

Fill in your private inventory (inventory-private/hosts):

[lamp]
lamp.micohosting.com ansible_user=root ansible_ssh_private_key_file=~/.ssh/ansible-key

Populate local vars (create or edit group_vars/local_all.yaml):

virtual_host: lamp.micohosting.com
letsencrypt_email: admin@micohosting.com

Edit Vault password file (.vault_pass.txt, already git-ignored) to contain your Vault password.

Run the playbook:

    ansible-playbook \
      -i inventory-private/hosts \
      playbook.yml \
      --vault-password-file .vault_pass.txt

    This will:

        Install Docker & Compose v2

        Build & deploy your PHP+Redis containers under /opt/lamp

        Create & bring up nginx-proxy + ACME companion in /opt/lamp/proxy

        Automatically obtain & renew SSL for your domain

    Verify in your browser:

        http://lamp.micohosting.com → redirects to HTTPS

        https://lamp.micohosting.com → shows Redis test page

🧩 Extending the Stack

    phpMyAdmin: Add a service in roles/lamp/templates/lamp-compose.yml.j2.

    Custom PHP app: Mount your code instead of the test script.

    Multiple domains: Add containers with VIRTUAL_HOST & LETSENCRYPT_HOST labels.

    Backups & Monitoring: Introduce additional Ansible roles or services.

📘 License

This project is released under the MIT License. Feel free to use, adapt, and extend.
