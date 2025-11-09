AYMARD Thomas          **INFI2-A**  
CROCHET Thomas  
MESSAGER Romain  
MIQUEL Adrien  
PERES Thomas  

---

**Analyse des besoins**  
Plateforme de gestion de parc informatique

---

# SOMMAIRE

[Objectifs et portée](#objectifs-et-portee)
- [Objectifs généraux](#objectifs-generaux)  
- [Intervenants](#intervenants)  
- [Limites du système](#limites-du-systeme)

[Terminologie employée](#terminologie-employee)
- [Glossaire partagé](#glossaire-partage)  
- [Définitions métier](#definitions-metier)

[Cas d’utilisation](#cas-dutilisation)
- [Acteurs](#acteurs)  
- [Objectifs](#objectifs)  
- [Scénarios](#scenarios)

[Technologie employée](#technologie-employee)
- [Exigences techniques](#exigences-techniques)  
- [Interfaces](#interfaces)

[Autres exigences](#autres-exigences)
- [Processus, règles métier](#processus-regles-metier)  
- [Performances, sécurité](#performances-securite)  
- [Maintenance, portabilité](#maintenance-portabilite)

[Facteurs humains](#facteurs-humains)
- [Ressources humaines](#ressources-humaines)   
- [Aspects juridiques et politiques](#aspects-juridiques-et-politiques)  
- [Conséquences humaines](#consequences-humaines)

---

# Objectifs et portée

## Objectifs généraux

Notre objectif principal est de créer une plateforme web complète pour gérer tout le parc informatique d'une organisation.

Cette solution est conçue pour centraliser absolument toutes les informations concernant le matériel (ordinateurs, périphériques, logiciels, utilisateurs, etc.). En un seul endroit, l'équipe pourra faciliter le suivi, la maintenance et les mises à jour de l'intégralité du parc.

Au final, nous fournirons un outil qui permet une visualisation claire et centralisée, offrant un inventaire des équipements complet et toujours à jour. Tout cela sera accessible via une interface web conviviale qui facilitera une gestion collaborative (ajout, modification, suppression d'éléments).

## Intervenants

D'une part, il y a nous, le groupe projet composé d’étudiants, qui est directement chargé de la réalisation. Concrètement, c'est cette équipe qui gère la conception, le développement de la plateforme, et qui assure la qualité finale à travers les phases de tests rigoureux.

D'autre part, nous avons les professeurs. Leur rôle est fondamental pour assurer le suivi continu de l'avancement, valider les choix techniques stratégiques, et enfin, évaluer et attribuer la notation finale du projet.

## Limites du système

La plateforme est déployée sur un environnement de test (Raspberry Pi) et son accès est limité au réseau local. De plus, le projet ne couvre pas les fonctionnalités avancées, comme la supervision réseau ou la maintenance automatisée.

---

# Terminologie employée

## Glossaire partagé

Un visiteur est une personne non connectée qui a l'autorisation de consulter une partie de l'inventaire. C'est le technicien qui est l'utilisateur connecté ayant les droits pour modifier concrètement le parc informatique. Au-dessus, l'administrateur Web est responsable de la gestion des techniciens, des catégories de matériel et de la liste du rebut. Quant à l'administrateur système, il est chargé de la supervision technique en examinant les journaux d’activité.

## Définitions métier

Sur le plan métier, le parc informatique représente l'ensemble complet des équipements matériels et logiciels d’une organisation. L'inventaire est tout simplement la base de données centralisée qui répertorie tous ces équipements, tandis que le rebut est la liste spécifique du matériel mis définitivement hors service. Enfin, la journalisation (ou log) est le processus d'enregistrement automatique de toutes les actions et événements qui se déroulent sur le système, une fonction cruciale pour l'administrateur système.

---

# Cas d’utilisation

## Acteurs

On distingue le visiteur, le technicien inscrit, l'administrateur Web et l'administrateur système. Ces rôles définissent qui a accès à quelles fonctionnalités de la plateforme de gestion de parc informatique.

## Objectifs

Le visiteur est présent pour la consultation ; son but est d'accéder à la présentation du projet et de visualiser une partie de l'inventaire. Le technicien inscrit est l'acteur opérationnel, son rôle étant de gérer concrètement les machines (ajout, modification, suppression, import/export CSV). Pour les tâches de supervision et de configuration, l'administrateur web s'occupe de la gestion des techniciens, du rebut et des informations structurantes (constructeurs, systèmes d'exploitation, etc.). Enfin, l'administrateur système a pour mission de surveiller le bon fonctionnement général de la plateforme en accédant aux journaux d’activité.

## Scénarios

L'utilisation quotidienne de la plateforme s'articule autour de ces scénarios clés, décrivant les actions principales de nos acteurs :

- Connexion : Chaque acteur doit s'authentifier au système en utilisant un identifiant spécifique (par exemple, *adminweb/adminweb*).  
- Ajout de matériel : Le technicien peut ajouter un ou plusieurs équipements au parc, soit via le formulaire dédié, soit en important une liste complète via un fichier CSV.  
- Mise au rebut : Le technicien transfère un matériel devenu obsolète vers la liste du rebut.  
- Consultation des journaux : L'administrateur système peut accéder à l'historique complet des actions pour surveiller l'activité et le fonctionnement général.  
- Création d’un technicien : L'administrateur web ajoute un nouveau compte utilisateur pour qu'un nouveau technicien puisse opérer sur le système.

---

# Technologie employée

## Exigences techniques

### Connaissances requises

- Développement web : Maîtrise des langages fondamentaux tels que HTML et CSS, ainsi que du langage backend PHP et du langage frontend JavaScript  
- Gestion de base de données : Compétences solides en SQL, notamment avec le système de gestion de bases de données MySQL.  
- Infrastructure et sécurité : Connaissances de base en administration Linux, incluant la configuration d'un serveur et la sécurisation des accès SSH ainsi que la gestion des droits utilisateurs.  
- Collaboration : Utilisation des outils de gestion de versions comme Git, avec une plateforme de collaboration telle que GitHub.  
- Communication écrite et orale

### Ressources matérielles

- Serveur de test : Un Raspberry Pi 4 équipé d'une carte SD, configuré pour héberger l'OS, le serveur web et le SGBD (Système de Gestion de Bases de Données).  
- Environnement de travail : Des postes de développement avec des IDE (Environnements de Développement Intégrés) professionnels comme VS Code ou PHPStorm.  
- La mise en place d'un réseau local est indispensable pour l'accès sécurisé en SSH et pour effectuer les tests de la plateforme.

### Ressources logicielles

- Système d'exploitation : Raspberry Pi OS (basé sur Linux) est l'OS de notre environnement de déploiement.  
- Serveur Web : Apache (souvent installé via un package local comme XAMPP ou configuré de manière native).  
- Base de données : MySQL ou MariaDB pour l'inventaire, avec une interface de gestion comme phpMyAdmin.  
- Outils de développement : Plateformes de gestion de code GitHub ou GitLab, et IDEs comme PHPStorm ou VS Code.

## Interfaces

La plateforme proposera des interfaces distinctes. L'interface utilisateur est conçue pour garantir une navigation web claire et intuitive. Pour les tâches de gestion, l'interface administrateur est plus riche, intégrant des outils avancés tels que des tableaux dynamiques, des formulaires de saisie précis et des fonctionnalités d'exports CSV pour manipuler les données de l'inventaire. Pour finir, une interface d'administration système est dédiée à la supervision technique, permettant spécifiquement à l'administrateur système de consulter l'affichage des journaux d’activité.

---

# Autres exigences

## Processus, règles métier

Chaque matériel doit obligatoirement être rattaché à une catégorie prédéfinie, comme "unité centrale" ou "moniteur". Pour la sécurité des données, les opérations critiques, telles que l'ajout ou la suppression de matériel, sont exclusivement réservées aux utilisateurs connectés. Enfin, toutes les actions effectuées sont systématiquement journalisées dans des logs.

## Performances, sécurité

Les temps de réponse de la plateforme doivent être rapides, et celle-ci doit tout le temps être disponible. Du côté de la sécurité, toutes les connexions sont sécurisées par une authentification obligatoire. La protection des données est assurée par des sauvegardes régulières de la base.

## Maintenance, portabilité

Afin d'assurer la pérennité du projet, le code est entièrement documenté, versionné et stocké avec Git. L'application est conçue pour être portable, ce qui signifie qu'elle est facilement déployable sur tout environnement Linux compatible. Aussi, une documentation complète sera livrée avec le code source pour faciliter la prise en main et la maintenance future.

---

# Facteurs humains

## Ressources humaines

- AYMARD Thomas : Responsable Système et Réseau  
- CROCHET Thomas : Développeur Web  
- MESSAGER Romain : Responsable de la documentation et de l'organisation générale  
- MIQUEL Adrien : Responsable Probabilités et Statistiques  
- PERES Thomas : Développeur Base de données

## Aspects juridiques et politiques

Le projet est soumis au respect de la législation en vigueur. Cela implique d'être en conformité avec le Règlement Général sur la Protection des Données (RGPD), notamment en matière de gestion des cookies et des données personnelles des utilisateurs. Nous devons également respecter les règles d’accessibilité numérique pour garantir l'utilisation par tous. De plus, toute activité de hacking ou de modification non autorisée des serveurs nous est interdite.

## Conséquences humaines

Ce projet est une composante majeure intégrée au cursus de la 2e année. Il représente une charge de travail significative pour le groupe projet, ce qui pourrait impacter notre gestion globale du temps. Cependant, il a pour effet positif de développer le travail collaboratif au sein de l'équipe et de renforcer les compétences techniques pluridisciplinaires.

---

# Hypothèses et dépendances

La progression du projet est soumise à quelques dépendances externes. Nous dépendons entièrement des professeurs encadrants pour la validation des choix, l'obtention des consignes spécifiques et surtout pour les dates de rendu finales. Sur le plan technique, notre travail repose sur l'hypothèse d'un réseau local stable et d'un Raspberry Pi configuré correctement dès le départ.
