# AYMARD Thomas **INFI2-A**  
CROCHET Thomas  
MESSAGER Romain  
MIQUEL Adrien  
PERES Thomas

# **Documentation – Plateforme de gestion de parc informatique**

![Logo](images/logo.jpg)

# Sommaire
- [Informations préalables](#informations-préalables)
  - [Raspberry PI](#raspberry-pi)
  - [Page d'accueil du site Web](#page-daccueil-du-site-web)
  - [MariaDB](#mariadb)
  - [Page PhpMyAdmin](#page-phpmyadmin)
- [Utilisation](#utilisation)
  - [Fail2Ban](#fail2ban)
  - [MariaDB - Utilisation](#mariadb-utilisation)
  - [PhpMyAdmin](#phpmyadmin-utilisation)
- [Technique](#technique)
  - [Raspberry PI](#raspberry-pi-technique)
  - [Fail2Ban](#fail2ban-technique)
  - [Apache](#apache)
  - [MariaDB - Installation & Configuration](#mariadb-technique)
  - [PhpMyAdmin](#phpmyadmin-technique)

---

# Informations préalables

## Raspberry PI
Connexion au RPI :  
```
ssh sae2025@192.168.25.10
```
Fingerprints → yes  
Mot de passe : **!sae2025!**

## Page d’accueil du site Web
Adresse : [http://rpi10/main](http://rpi10/main)

Pages disponibles :
- Accueil (statique)  
- Inventaire technicien (statique)  
- Connexion (préliminaire)

Identifiants :
- **Administrateur web** : adminweb / adminweb  
- **Administrateur système** : sysadmin / sysadmin  
- **Technicien** : tech1 / *tech1*

## MariaDB
Connexion :  
```
mariadb -u root -p
```
Mot de passe : **root**

Les détails supplémentaires se trouvent dans la section *MariaDB – Utilisation*.

## Page PhpMyAdmin
Adresse : [http://rpi10/phpmyadmin](http://rpi10/phpmyadmin)

Identifiants :
- Login : **admin**
- Mot de passe : **adminetu**

---

# Utilisation

## Fail2Ban
Vérifier les prisons actives :  
```
sudo fail2ban-client status
```
Informations détaillées sur la prison SSH :  
```
sudo fail2ban-client status sshd
```
Débannir une IP :  
```
sudo fail2ban-client set sshd unbanip [IP]
```
Vider entièrement la prison :  
```
sudo fail2ban-client unban --all sshd
```
Log Fail2ban : `/var/log/fail2ban.log`

## MariaDB - Utilisation
Connexion :  
```
mariadb -u root -p
```
Afficher les bases de données :  
```
SHOW DATABASES;
```
Utiliser la base *vines* :  
```
USE vines;
```
Afficher les tables :  
```
SHOW TABLES;
```
Afficher le contenu d’une table :  
```
SELECT * FROM nom_table;
```

## PhpMyAdmin - Utilisation
Se rendre sur [http://rpi10/phpmyadmin](http://rpi10/phpmyadmin)

Login : admin  
Mot de passe : adminetu

Sélectionner la base puis les tables via le menu de gauche.

---

# Technique

## Raspberry PI (Technique)
Flash de la carte SD : Raspberry Pi Imager + Raspberry Pi OS.

Paramètres modifiés avant flash :
- Utilisateur  
- Paramètres régionaux / date / heure  
- Clavier  
- Activation SSH

## Fail2Ban (Technique)
Mise à jour :
```
sudo apt update
sudo apt upgrade
```
Installation :
```
sudo apt install fail2ban
```
Démarrage et activation au boot :
```
sudo systemctl start fail2ban
sudo systemctl enable fail2ban
```
Vérification :
```
sudo systemctl status fail2ban
```
Configuration SSH :  
```
sudo nano /etc/fail2ban/jail.d/sshd.conf
```
Contenu :
```
[sshd]
enabled = true
port = ssh
filter = sshd
logpath = /var/log/auth.log
maxretry = 3
bantime = 10m
findtime = 10m
```
Redémarrage :
```
sudo systemctl restart fail2ban
```

## Apache
Installation :
```
sudo apt install apache2
```
Vérification + activation :
```
sudo systemctl status apache2
sudo systemctl enable apache2
```
Modification du DocumentRoot :
```
sudo nano /etc/apache2/sites-available/000-default.conf
```
Remplacer :
```
DocumentRoot /var/www/html
```
par :
```
DocumentRoot /var/www/html/main
```
Redémarrage d’Apache :
```
sudo systemctl restart apache2
```

## MariaDB - Installation & Configuration
Mise à jour :  
```
sudo apt update
```
Installation :  
```
sudo apt install mariadb-server
```
Configuration :  
```
sudo mysql_secure_installation
```
Créer la base :  
```
CREATE DATABASE vines;
```
Créer les tables :
```
CREATE TABLE users(login VARCHAR(50),password VARCHAR(50),role VARCHAR(50));
CREATE TABLE devices(name VARCHAR(50), serial VARCHAR(50), manufacturer VARCHAR(50), model VARCHAR(50), type VARCHAR(50), cpu VARCHAR(50), ram_mb INT, disk_gb INT, os VARCHAR(50), domain VARCHAR(50), location VARCHAR(50), building VARCHAR(50), room VARCHAR(50), macaddr VARCHAR(50), purchase_date DATE, warranty_end DATE);
CREATE TABLE monitors(serial VARCHAR(50), manufacturer VARCHAR(50), model VARCHAR(50), size_inch VARCHAR(50), resolution VARCHAR(50), connector VARCHAR(50), attached_to VARCHAR(50));
CREATE TABLE connexions(login VARCHAR(50),ip_address VARCHAR(50),duration_seconds INT);
```
Ajout utilisateurs :
```
INSERT INTO users VALUES ('adminweb',MD5('adminweb'),'administrateur_web');
INSERT INTO users VALUES ('sysadmin',MD5('sysadmin'),'administrateur_systeme');
INSERT INTO users VALUES ('tech1',MD5('*tech1*'),'technicien');
```
Import CSV via phpmyadmin (supprimer headers si nécessaire).

## PhpMyAdmin - Technique
Installation :
```
sudo apt install phpmyadmin
```
Configuration manuelle :
```
sudo mariadb
CREATE DATABASE phpmyadmin;
sudo mysql phpmyadmin < /usr/share/phpmyadmin/sql/create_tables.sql
```
Lien Apache ↔ phpMyAdmin :
```
sudo ln -s /etc/phpmyadmin/apache.conf /etc/apache2/conf-enabled/phpmyadmin.conf
sudo systemctl reload apache2
```
Créer un utilisateur :
```
CREATE USER 'admin'@'%' IDENTIFIED BY 'adminetu';
GRANT ALL PRIVILEGES ON *.* TO 'admin'@'%';
FLUSH PRIVILEGES;
```
Connexion possible depuis n'importe quel PC.
