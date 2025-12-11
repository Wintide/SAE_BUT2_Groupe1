# Auteurs
AYMARD Thomas **INFI2-A**  
CROCHET Thomas  
MESSAGER Romain  
MIQUEL Adrien  
PERES Thomas

# Documentation – Plateforme de gestion de parc informatique

![Logo](images/logo.jpg)

---
# Sommaire
- [Rappel : Méthode de connexion](#rappel--méthode-de-connexion)
- [Administrateur web](#administrateur-web)
- [Technicien](#technicien)
- [Diagramme des cas d'utilisation (UML)](#diagramme-des-cas-dutilisation-uml)
- [Modèle logique des données](#modèle-logique-des-données)

---

## Rappel : Méthode de connexion
- Accéder au site : [http://rpi10/](http://rpi10/)  
- Cliquer sur **Login**  
- Entrer les informations correspondant à votre compte

---

# Administrateur web
### Nouveau rôle : *administrateur_web*

### Fonctionnalités ajoutées
- Ajout d'un technicien depuis l’interface admin.  
- Ajout d’une information consultable par les techniciens (inventaire).  
- Ajout de deux boutons dans l’interface Admin Web : **Ajouter technicien** et **Ajouter information**.

### Utilisation
1. Connectez‑vous en administrateur web ([voir rappel](#rappel--methode-de-connexion))  
   **Identifiants :** adminweb / adminweb  
2. Cliquez sur le bouton **Admin web** en haut au centre.  
3. Dans l’interface, cliquez sur :  
   - **Ajouter un technicien**  
   - **Ajouter un constructeur / Ajouter une information**  
4. Renseignez les champs requis (login + mot de passe).  
5. Cliquez sur **Créer le technicien** ou **Ajouter une information** selon l’action souhaitée.

---

# Technicien

### Fonctionnalités ajoutées
- Consultation détaillée de l’inventaire  
- Modification des éléments de l’inventaire  
- Ajout d’une machine

### Utilisation
1. Cliquer sur **Inventaire** dans l'entête.  
2. Visualisation de l’ensemble des machines ainsi que l’inventaire Rebus.

### Actions possibles
- **Consulter une machine :** cliquer sur « Consulter ».  
- **Modifier une machine :** cliquer sur « Modifier », remplir les champs puis enregistrer.  
- **Ajouter une machine :** cliquer sur « Ajouter une machine » (en haut à droite), remplir les informations puis valider.

---

# Diagramme des cas d’utilisation (UML)
**Version : Échéance 2 (05/12/2025)**

![Diagramme CU](images/Diagramme_CU_echeance_2_SAE.png)

---

# Modèle logique des données
**Version : Échéance 2 (05/12/2025)**

![MLD](images/MLD_echeance_1.2.png)

*PK : Primary Key*

### Commentaire
Nous avons choisi de créer plusieurs tables contenant les valeurs autorisées pour les champs des tables **Monitors** et **Devices**.  
Cela permet :
- d’obliger l’utilisateur à choisir une valeur valide (ex. lors de la création d’une machine) ;
- de permettre à un administrateur d’« ajouter une information réutilisable » via une simple insertion dans la table concernée.
