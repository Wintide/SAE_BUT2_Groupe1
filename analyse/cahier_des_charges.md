<p align="left">
AYMARD Thomas								  
CROCHET Thomas  
MESSAGER Romain  
MIQUEL Adrien  
PERES Thomas
**INFI2-A**
</p>

**Cahier des charges** Plateforme de gestion de parc informatique

![Logo](logo.jpg)

# SOMMAIRE

- [Introduction](#introduction)  
    
- [Enoncé](#enoncé)  
  - [Description du problème à résoudre](#description-du-problème-à-résoudre)  
  - [Contexte](#contexte)  
  - [Objectifs](#objectifs)

- [Pré-requis](#pré-requis)  
  - [Connaissances requises](#connaissances-requises)  
  - [Ressources matérielles](#ressources-matérielles)  
  - [Ressources logicielles](#ressources-logicielles)  
  - [Identifiants obligatoires](#identifiants-obligatoires)

# Introduction

Ce document constitue le cahier des charges pour le projet SAE IN3SA01.

L’objectif est de définir précisément les besoins exprimés dans le sujet officiel, de cadrer le travail du groupe en détaillant les fonctionnalités attendues, de fixer les contraintes techniques, ainsi que de servir de référence commune entre la maîtrise d'œuvre et la maîtrise d’ouvrage.

La structure de ce cahier des charges est comme suit : une introduction, posant le cadre et les objectifs de celui-ci; un énoncé, décrivant le problème à résoudre, le contexte et les objectifs de la solution; les pré-requis au projet, étant les compétences et ressources matérielles nécessaires; et enfin les priorités, définissant le hiérarchisation des développements selon leur importance.

Les documents référencés sont les suivant : 

- Énoncé de la SAE IN3SA01 (PDF en ligne et version papier)  
- Supports de cours (Analyse, Développement Web)  
- Sujet de communication (PDF en ligne et version papier)  
- Fichier csv des Unités Centrales  
- Le fichier csv des Écrans

# Enoncé

### **Description du problème à résoudre**

La gestion de parc informatique est un enjeu stratégique pour les entreprises de toutes tailles. Cependant, elle peut rapidement devenir complexe avec l’augmentation du nombre de machines. L’information sur les équipements peut être peu accessible et non centralisée, ce qui rend sa mise à jour difficile.  
Aussi, le suivi du cycle de vie du matériel peut générer des erreurs et manquer de traçabilité.

Pour y remédier, il est essentiel de développer un plateforme web de gestion de parc informatique, permettant à différents utilisateurs d’accéder à des fonctionnalités adaptées à leur rôle, et ce en assurant la centralisation, la fiabilité et la sécurité des données.

### **Contexte**

Le projet SAE IN3SA01, réparti sur les semestres 3 et 4, consiste à développer une plateforme web de gestion de parc informatique. Ce projet regroupe plusieurs compétences issues de différentes unités d’enseignement (développement web, bases de données, communication, anglais, sécurité, etc.).

Les technologies principales imposées sont : PHP pour le développement côté serveur, MySQL ou autre pour la gestion des données, et l’utilisation d’un serveur Web comme Apache.

Il faut également utiliser un dépôt GitHub partagé avec les enseignants, contenant le code et la documentation.

### **Objectifs**

La plateforme a pour objectif de centraliser la gestion du parc informatique au sein d’une application unique et collaborative. Elle doit permettre de distinguer plusieurs profils d’utilisateurs (administrateur système, administrateur web, technicien et visiteur), chacun disposant de droits spécifiques, afin de garantir un usage adapté et sécurisé.

L’application doit offrir la possibilité de maintenir un inventaire complet, consultable et modifiable, avec une fonctionnalité d’export au format CSV. La traçabilité des actions doit être assurée par un système de journaux d’activité consultables, tandis que l’ajout de machines doit pouvoir se faire de manière individuelle via un formulaire ou en masse grâce à l’import de fichiers CSV.

De plus, la plateforme devra intégrer la gestion d’une liste de rebut afin d’identifier le matériel hors service, tout en permettant sa réactivation en cas de remise en état. Enfin, une interface claire, intuitive et pédagogique sera mise en place, comprenant une page d’accueil avec un texte explicatif ainsi qu’une vidéo de présentation des fonctionnalités.

# Pré-requis

### **Connaissances requises**

- Développement web : **HTML, CSS, PHP, JavaScript**.  
- Gestion de base de données : **SQL (MySQL/MariaDB)**.  
- Administration système de base sous Linux.  
- Sécurisation des accès et gestion des utilisateurs.  
- Outils de gestion de version (**GitHub/GitLab**).  
- Communication écrite et orale

### **Ressources matérielles**

- **Raspberry Pi 4** avec carte SD (système \+ serveur).  
- Postes de développement pour le code (IDE recommandé : VS Code, PHPStorm, etc.).  
- Réseau local pour accès SSH.

### **Ressources logicielles**

- OS Linux (Raspberry Pi OS).  
- MySQL via phpMyAdmin  
- Client Git (GitHub/GitLab).  
- IDE (PHPStorm)  
- XAMPP 

#### **Identifiants obligatoires**

- Admin web : adminweb / adminweb  
- Admin système : sysadmin / sysadmin  
- Technicien de base : tech1 / tech1  
- Système RPi : sae2025 / \!sae2025\!

# Priorités


