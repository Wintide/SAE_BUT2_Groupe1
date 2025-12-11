AYMARD Thomas								**INFI2-A**  
CROCHET Thomas  
MESSAGER Romain  
MIQUEL Adrien  
PERES Thomas

**Documentation** Plateforme de gestion de parc informatique

![Logo](images/logo.jpg)

**Sommaire**

- [Information préalables](#informations-préalables-:)  
  - [Raspberry PI](#raspberry-pi-:)  
  - [Page d'accueil du site Web](#page-d’accueil-du-site-web-:-http://rpi10)  
  - [MariaDB](#mariadb-:)  
  - [Page PhpMyAdmin](#page-phpmyadmin-:-http://rpi10/phpmyadmin)  
- [Utilisation](#utilisation-:)  
  - [Fail2Ban](#fail2ban-:)  
  - [MariaDB](#mariadb-:-1)  
  - [PhpMyAdmin](#phpmyadmin-:)  
- [Technique](#technique-:)  
  - [Raspberry PI](#raspberry-pi-:-1)  
  - [Fail2Ban](#fail2ban-:-1)  
  - [Apache](#apache:)  
  - [MariaDB](#mariadb:)  
  - [PhpMyAdmin](#phpmyadmin:)

## 

## **Informations préalables :**  {#informations-préalables-:}

- ### Raspberry PI : {#raspberry-pi-:}

→ Connexion au RPI:   
$ssh sae2025@192.168.25.10

fingerprints —\> yes

Mot de passe: \!sae2025\!

- ### Page d’accueil du site web : [http://rpi10](http://rpi10/main) {#page-d’accueil-du-site-web-:-http://rpi10}

Pages disponibles:   
   → Accueil (statique)  
   → Inventaire technicien (statique)  
   → Connexion (Connexion disponible mais uniquement préliminaire)

Administrateur web:  
Login: adminweb   
Mot de passe: adminweb

Administrateur Système:  
Login: sysadmin
Mot de passe: sysadmin

Technicien(s):  
Login: tech1   
Mot de passe: \*tech1\*

- ### MariaDB : {#mariadb-:}

→ Connexion : $mariadb \-u root \-p   
Mot de passe : root

Les détails d’utilisations de mariaDB seront précisés plus bas dans la rubrique dédiée à MariaDB.

- ### Page phpmyadmin : [http://rpi10/phpmyadmin](http://rpi10/phpmyadmin) {#page-phpmyadmin-:-http://rpi10/phpmyadmin}

Login : admin  
Mot de passe : adminetu

## **Utilisation :** {#utilisation-:}

- ### Fail2Ban : {#fail2ban-:}

Pour vérifier l’état général de fail2ban et connaître les prisons actuellement actives, nous avons dû exécuter la commande suivante, qui nous a permis de voir si la prison SSH est bien activée et si d’autres prisons sont chargées :  
$sudo fail2ban-client status

Pour obtenir des informations détaillées sur la prison SSH en particulier :  
$sudo fail2ban-client status sshd  
Avec, on obtient notamment le nombre d’échecs de connexion recensés et la liste des adresses IP qui sont bannies.

Aussi, il peut être intéressant de pouvoir débannir certaines adresses IP. Pour retirer une IP spécifique de la liste de bannissement, nous avons utilisé la commande suivante :  
$sudo fail2ban-client set sshd unbanip \[IP\]

On a parfois utilisé cette commande pour vider la prison entièrement :  
$sudo fail2ban-client unban \--all sshd

Fail2ban enregistre en fait des logs afin de suivre ses actions, comme les bannissements ou débannissements, dans /var/log/fail2ban.log

- ### MariaDB : {#mariadb-:-1}

Première méthode pour administrer les bases de données

Une fois connecté au RPI:

→ Se connecter à mariadb en ligne de commande :   
$mariadb \-u root \-p   
Mot de passe : root

→ Afficher les bases de données disponibles :   
$SHOW DATABASES;

→ Sélectionner la base de donnée que l’on veut utiliser, dans notre cas la base de donnée dédié à la plateforme web (vines) :   
$USE vines;

→ Afficher la liste des tables de la base de données :   
$SHOW TABLES;

→ Afficher le contenu d’une table :   
$SELECT \* FROM nom\_table;

### 

- ### PhpMyAdmin : {#phpmyadmin-:}

Deuxième méthode pour administrer les bases de données

Se rendre sur : [http://rpi10/phpmyadmin](http://rpi10/phpmyadmin)

→ Se connecter au site :   
Login : admin  
Mot de passe : adminetu

→ Sur le petit menu à gauche sélectionner la base de donnée souhaitée, afficher en dessous de cette base de données les tables en cliquant sur \+.

## **Technique :** {#technique-:}

- ### Raspberry PI : {#raspberry-pi-:-1}


Flash la carte SD:  
Utilisation de Raspberry Pi Imager, avec Raspberry Pi OS pour les Raspberry Pi 4\.

Avant de formater le disque avec l’OS, on a modifier quelques paramètres tel que l’utilisateur, les paramètres de lieu, date et heure, clavier mais aussi on a activé ssh.

- ### Fail2Ban : {#fail2ban-:-1}

Nous avons installé et configuré Fail2ban sur notre Raspberry Pi afin de renforcer la sécurité du service SSH, qu’on utilise pour manipuler le RPI à distance.  
Nous avons commencé par mettre à jour l’ensemble des paquets du Raspberry Pi afin de garantir un environnement à jour avec :   
$sudo apt update  
$sudo apt upgrade

Nous avons ensuite installé fail2ban depuis le dépôt officiel de Raspberry Pi OS :  
$sudo apt install fail2ban  
Cela crée les fichiers de configuration dans /etc/fail2ban/.

On démarre le service et on l’active au démarrage avec:  
$sudo systemctl start fail2ban  
$sudo systemctl enable fail2ban

Nous avons vérifié que le service Fail2ban fonctionnait correctement avec :   
$sudo systemctl status fail2ban

Ensuite, nous avons choisi de créer une configuration dédiée à SSH dans le répertoire prévu pour les configurations individuelles, /etc/fail2ban/jail.d/ :  
$sudo nano /etc/fail2ban/jail.d/sshd.conf

Ce fichier est de cette forme :   
*\[sshd\]*  
*enabled \= true*  
*port \= ssh*  
*filter \= sshd*  
*logpath \= /var/log/auth.log*  
*maxretry \= 3*  
*bantime \= 10m*  
*findtime \= 10m*

Après avoir enregistré le fichier, nous avons redémarré fail2ban pour appliquer les changements comme suit :  
$sudo systemctl restart fail2ban

- ### Apache: {#apache:}


Nous avons également installé un serveur web Apache afin d’héberger des pages web de notre site de gestion de parc. Cette section décrit l’installation, la vérification et la mise en route du service Apache.

Nous avons donc installé le serveur web avec la commande suivante :  
$sudo apt install apache2

Les fichiers de configuration se trouvent dans /etc/apache2/, et le répertoire du site web par défaut est /var/www/html/.

Nous avons d'abord vérifié que le service était actif :   
$sudo systemctl status apache2  
Puis nous avons activé Apache pour qu’il démarre automatiquement en même temps que le système :  
$sudo systemctl enable apache2

Nous avons, plus tard, modifié le configuration du site par défaut pour changer le répertoire racine, depuis /var/www/html vers /var/www/html/main :   
$sudo nano /etc/apache2/sites-available/000-default.conf  
Ce fichier contenant la configuration du site par défaut, nous avons remplacé la ligne :  
DocumentRoot /var/www/html  
par  
DocumentRoot /var/www/html/main, les fichiers de notre site ayant été placés dans ce dossier.

Un redémarrage d’Apache est nécessaire pour que les changements prennent effet. Ainsi, notre site est accessible en tapant directement http://rpi10.

- ### MariaDB: {#mariadb:}

Vérifier que tous les paquets sont à jours :   
$sudo apt update

Installation de MariaDB :   
$sudo apt install mariadb-server

Configuration de MariaDB :   
$sudo mysql\_secure\_installation

Prompt 1 → Mot de passe actuel de root : aucun (appuyer sur entrer)  
Prompt 2 → UNIX socket authentification : non (appuyer sur n puis entrer)  
Prompt 3 → Changer le mot de passe de root : oui (Y puis entrer)  
Entrer le nouveau mot de passe et confirmer en le re-saisissant  
Prompt 4 → Retirer les utilisateurs anonymes : oui (Y puis entrer)  
Prompt 5 → Désactiver la connexion à distance de root : oui (Y puis entrer)  
Prompt 6 → Retirer les base de donnée test : au choix (Y ou n)  
Prompt 7 → Recharger les tables de privilèges maintenant : oui (Y puis entrer)

Connexion à mariaDB :   
$mariadb \-u root \-p  
Entrer le mot de passe : (root dans notre cas)

Afficher les bases de données disponibles :   
$SHOW DATABASES;

Créer une base de donnée pour notre plateforme web :   
$CREATE DATABASE vines;

Création des tables :   
$CREATE TABLE users(login VARCHAR(50),password VARCHAR(50),role VARCHAR(50));  
$CREATE TABLE devices(name VARCHAR(50), serial VARCHAR(50), manufacturer VARCHAR(50), model VARCHAR(50), type VARCHAR(50), cpu VARCHAR(50), ram\_mb INT, disk\_gb INT, os VARCHAR(50), domain VARCHAR(50), location VARCHAR(50), building VARCHAR(50), room VARCHAR(50), macaddr VARCHAR(50), purchase\_date DATE, warranty\_end DATE);  
$CREATE TABLE monitors(serial VARCHAR(50), manufacturer VARCHAR(50), model VARCHAR(50), size\_inch VARCHAR(50), resolution VARCHAR(50), connector VARCHAR(50), attached\_to VARCHAR(50));  
$CREATE TABLE connexions(login VARCHAR(50),ip\_address VARCHAR(50),duration\_seconds INT);

Remplissage des tables:

$INSERT INTO users(login,password,role) VALUES (‘adminweb’,MD5(‘adminweb’),’administrateur\_web’);  
$INSERT INTO users(login,password,role) VALUES (‘sysadmin’,MD5(‘sysadmin’),’administrateur\_systeme’);  
$INSERT INTO users(login,password,role) VALUES (‘tech1’,MD5(‘\*tech1\*’),’technicien’);

Pour les tables connexions, devices et monitors qui contiennent les données des fichiers csv, utilisation de l’import csv via phpmyadmin et suppression manuel de la ligne de header de chaque:  
Si refus d’insertion avec header il faut retirer les header dans le csv.  
Sinon si insertion dans les tables des headers utiliser :   
$DELETE \* FROM devices WHERE name=’name’;  
$DELETE \* FROM monitorsWHERE serial=’serial’;  
$DELETE \* FROM connexions WHERE login=’login’;

- ### PhpMyAdmin: {#phpmyadmin:}

Pour nous faciliter le développement de la base de données, nous avons installé phpmyadmin, permettant d’avoir une interface graphique sur un site web, accessible via un moteur de recherche.   
Cette section décrit son installation.

$apt install phpmyadmin 

À la fin de l’installation, il nous propose de le configurer pour MySQL ou MariaDB si l’un des deux ne sont pas installés. L’installation ayant été faite après l’installation de MariaDB, une installation manuelle doit être effectuée.

$sudo mariadb  
mariadb $\> CREATE DATABASE phpmyadmin  
$sudo mysql phpmyadmin \< /usr/share/phpmyadmin/sql/create\_tables.sql

À partir de ce moment, phpmyadmin est synchronisé avec MariaDB. Nous créons ensuite le lien entre apache et phpmyadmin avec une configuration donnée.  
$sudo ln \-s /etc/phpmyadmin/apache.conf /etc/apache2/conf-enabled/phpmyadmin.conf  
$sudo systemctl reload apache2

Nous avons maintenant accès au site web, il nous faut maintenant un utilisateur à qui nous pouvons nous connecter via n’importe quel pc.  
$sudo mariadb  
mariadb $\> CREATE USER 'admin'@'%' IDENTIFIED BY 'adminetu';  
mariadb $\> GRANT ALL PRIVILEGES ON users.\* TO 'admin'@'%';  
mariadb ?\> FLUSH PRIVILEGES;

Nous avons donc créé un utilisateur avec le login ‘admin’, avec n’importe quel ip (‘%’) et avec le mot de passe ‘adminetu’.   
Nous pouvons maintenant nous connecter avec ces identifiants.

QIECQckhBQoUKFCgQFBySIECBQoUKBCUHFKgQIECBQoEJYcUKFCgQIECQckhBQoUKFCgQFBySIECBQoUKBCUHFKgQIECBQoEJYcUKFCgQIECQckhBQoUKFCgAPi/MLz1MqwTT4cAAAAASUVORK5CYII=>
