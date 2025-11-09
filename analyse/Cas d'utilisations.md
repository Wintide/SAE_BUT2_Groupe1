AYMARD Thomas								**INFI2-A**  
CROCHET Thomas  
MESSAGER Romain  
MIQUEL Adrien  
PERES Thomas

**Cas d’utilisation**  
 Plateforme de gestion de parc informatique

![Logo](logo.jpg)

**SOMMAIRE** 

**[Utilisateur](#utilisateur)**

[Consulter inventaire](#consulter-inventaire)

[**Technicien**](#technicien)

[Connection platerforme](#connection-platerforme)

[Consulter parc](#consulter-parc)

[Modifier information](#modifier-information)

[Ajouter machine formulaire](#ajouter-machine-formulaire)

[Ajouter machine CSV](#ajouter-machine-csv)

[Supprimer machine](#supprimer-machine)

[Exportation CSV](#exportation-csv)

[Consulter rebut](#consulter-rebut)

[Changer statut matériel](#changer-statut-matériel)

[**Administrateur web**](#administrateur-web)

[Ajouter technicien](#ajouter-technicien)

[Bloquer liste rebut](#bloquer-liste-rebut)

[**Administrateur système**](#administrateur-système)

[Consultation des logs](#consultation-des-logs)

# Utilisateur

## Consulter inventaire

**Nom :** Consulter une partie de l’inventaire  
**Description :** Il permet de visualiser certaines informations sur les éléments disponibles (catégorie, description, numéro), sans pouvoir les modifier ni accéder aux sections réservées.  
**Acteur :** Utilisateur non inscrit (visiteur)  
**Portée :** boîte noire  
**Niveau :** Utilisateur  

### Scénarios

| Nominal | Alternatif | Exception |
|----------|-------------|------------|
| **1)** L’utilisateur accède à la page d’accueil  <br> **2)** Il sélectionne l’option consulter l’inventaire  <br> **3)** Le système affiche la liste des éléments visibles publiquement  <br> **4)** L’utilisateur filtre/trie  <br> **5)** Mise à jour de l’affichage  <br> **6)** L’utilisateur consulte le détail d’un élément | **I) Accès via une catégorie**  <br> 1) L’utilisateur clique directement sur une catégorie publique  <br> 2) Le système affiche les éléments correspondants  <br> 3) L’utilisateur consulte le détail d’un élément  <br><br> **II) Utilisation de la barre de recherche**  <br> 1) L’utilisateur saisit un mot-clé dans la barre de recherche  <br> 2) Le système affiche les résultats correspondants  <br> 3) L’utilisateur consulte le détail d’un élément | **I) Inventaire vide ou aucun résultat**  <br> 1) Le système affiche “Aucun élément disponible/trouvé”  <br><br> **II) Erreur technique**  <br> 1) Le système ne parvient pas à récupérer les données  <br> 2) Message du système “Erreur de connexion” |

---

# Technicien 

## Connection platerforme 

**Nom :** Se connecter à la plateforme  
**Description :** La connexion permet au technicien d’accéder aux fonctionnalités protégées et de gérer ou consulter l’inventaire selon ses droits.  
**Acteur :** Technicien  
**Portée :** Boîte noire  
**Niveau :** Utilisateur  

## Scénarios

| **Nominal** | **Alternatif** | **Exception** |
|--------------|----------------|----------------|
| 1) Le technicien accède à la page de connexion de la plateforme  <br> 2) Il saisit son identifiant et son mot de passe  <br> 3) Le système vérifie les informations  <br> 4) Le système valide l’identité du technicien  <br> 5) Le système redirige le technicien vers la page d’accueil / tableau de bord | *(Aucun scénario alternatif spécifié)* | **I) Identifiants incorrects**  <br> 1) Le système affiche le message « Identifiant ou mot de passe incorrect »  <br> 2) Le technicien peut réessayer  <br><br> **II) Erreur technique / réseau**  <br> 1) Le système ne parvient pas à vérifier les identifiants  <br> 2) Message du système « Erreur de connexion » |

## Consulter parc 

**Nom :** Consulter la liste complète du parc  
**Description :** Le technicien peut visualiser toutes les informations pertinentes pour la gestion ou le suivi, mais sans modifier les éléments à moins que d’autres cas d’utilisation spécifiques ne le permettent.  
**Acteur :** Technicien  
**Portée :** Boîte noire  
**Niveau :** Utilisateur  

## Scénarios

| **Nominal** | **Alternatif** | **Exception** |
|--------------|----------------|----------------|
| 1) Le technicien accède à la section « Inventaire »  <br> 2) Le système affiche la liste complète des équipements  <br> 3) Le technicien peut filtrer, trier ou rechercher  <br> 4) Le système met à jour l’affichage selon les critères  <br> 5) Le technicien consulte le détail des éléments | *(Aucun scénario alternatif spécifié)* | **I) Inventaire vide ou aucun résultat**  <br> 1) Le système affiche « Aucun élément disponible/trouvé »  <br><br> **II) Erreur technique / réseau**  <br> 1) Le système ne parvient pas à charger les données  <br> 2) Message du système « Erreur de connexion » |

## Modifier information

**Nom :** Modifier une information d’un matériel existant  
**Description :** Les modifications peuvent concerner, par exemple, l’état, la localisation, la description ou toute information administrative liée au matériel.  
**Acteur :** Technicien  
**Portée :** Boîte noire  
**Niveau :** Utilisateur  

## Scénarios

| **Nominal** | **Alternatif** | **Exception** |
|--------------|----------------|----------------|
| 1) Le technicien accède à la fiche ou au détail d’un élément  <br> 2) Il sélectionne « Éditer »  <br> 3) Le système affiche la fenêtre de modification  <br> 4) Le technicien modifie les champs nécessaires  <br> 5) Il valide les modifications  <br> 6) Le système enregistre les changements et affiche un message de confirmation | *(Aucun scénario alternatif spécifié)* | **II) Erreur technique / réseau**  <br> 1) Le système ne parvient pas à enregistrer les modifications  <br> 2) Message du système « Erreur lors de l’enregistrement » |

## Ajouter machine formulaire

**Nom :** Ajouter une machine via un formulaire  
**Description :** Les informations saisies permettent d’enregistrer le matériel avec toutes ses caractéristiques (type, localisation, état, description, etc.) pour qu’il soit consultable et gérable par le système.  
**Acteur :** Technicien  
**Portée :** Boîte noire  
**Niveau :** Utilisateur  

## Scénarios

| **Nominal** | **Alternatif** | **Exception** |
|--------------|----------------|----------------|
| 1) Le technicien accède à la section « Ajouter un élément »  <br> 2) Le système affiche le formulaire d’ajout avec les champs requis  <br> 3) Le technicien saisit les informations de tous les champs  <br> 4) Il valide le formulaire en cliquant sur enregistrer / valider  <br> 5) Le système enregistre l’élément dans l’inventaire et affiche un message de confirmation | **I) Saisie partielle**  <br> 1) Le technicien remplit uniquement les champs obligatoires  <br> 2) Il valide le formulaire en cliquant sur enregistrer / valider  <br> 3) Le système enregistre l’élément dans l’inventaire et affiche un message de confirmation | **I) Formulaire incomplet**  <br> 1) Le technicien soumet un formulaire avec un champ obligatoire manquant  <br> 2) Le système affiche un message d’erreur et indique le champ à remplir  <br><br> **II) Erreur technique / réseau**  <br> 1) Le système ne parvient pas à enregistrer l’élément  <br> 2) Message du système « Erreur lors de l’enregistrement » |

## Ajouter machine CSV

**Nom :** Ajouter plusieurs machines via un fichier CSV  
**Description :** Chaque ligne du fichier correspond à un matériel avec ses caractéristiques (type, localisation, état, description, etc.). Le système valide et enregistre les données pour que les machines soient consultables et gérables.  
**Acteur :** Technicien  
**Portée :** Boîte noire  
**Niveau :** Utilisateur  

## Scénarios

| **Nominal** | **Alternatif** | **Exception** |
|--------------|----------------|----------------|
| 1) Le technicien accède à la section « Ajouter un élément »  <br> 2) Il sélectionne l’option d’insertion via CSV  <br> 3) Le système affiche une interface avec les instructions  <br> 4) Le technicien sélectionne et insère le fichier CSV  <br> 5) Le système valide le fichier (format, champs, etc.)  <br> 6) Le système enregistre toutes les machines dans l’inventaire  <br> 7) Le système affiche un message de confirmation et indique le nombre de machines ajoutées | **I) Des lignes sont incorrectes**  <br> 1) Le fichier contient quelques lignes avec des erreurs  <br> 2) Le système ajoute les lignes valides  <br> 3) Il envoie un rapport avec les lignes refusées | **I) Fichier autre que CSV**  <br> 1) Le fichier inséré n’est pas un CSV  <br> 2) Le système envoie un message d’erreur « Le fichier n’est pas un fichier CSV »  <br><br> **II) Fichier incorrect / mauvais format**  <br> 1) Le fichier CSV est invalide (colonnes manquantes, caractères non valides, etc.)  <br> 2) Le système refuse l’import et affiche un message d’erreur  <br><br> **III) Erreur technique / réseau**  <br> 1) Le système ne parvient pas à enregistrer les machines du fichier  <br> 2) Le système affiche un message d’erreur |

## Supprimer machine

**Nom :** Supprimer une machine pour la placer dans la liste du rebut  
**Description :** La suppression ne détruit pas les informations historiques mais déplace le matériel dans la section « Rebut ».  
**Acteur :** Technicien  
**Portée :** Boîte noire  
**Niveau :** Utilisateur  

## Scénarios

| **Nominal** | **Alternatif** | **Exception** |
|--------------|----------------|----------------|
| 1) Le technicien accède au détail d’un matériel  <br> 2) Il sélectionne l’option supprimer  <br> 3) Le système demande une confirmation  <br> 4) Le technicien confirme l’opération  <br> 5) Le système retire le matériel de l’inventaire et le place dans la liste du rebut  <br> 6) Le système affiche un message de confirmation | **I) Suppression multiple**  <br> 1) Le technicien sélectionne plusieurs machines à placer dans le rebut  <br> 2) Le système demande confirmation  <br> 3) Le technicien confirme l’opération  <br> 4) Le système retire les machines de l’inventaire et les place dans la liste du rebut  <br> 5) Le système affiche un message de confirmation | **I) Erreur technique / réseau**  <br> 1) Le système ne parvient pas à placer le matériel dans le rebut  <br> 2) Message du système « Erreur lors du déplacement dans le rebut » |

## Exportation CSV
**Nom :** Exporter la liste du parc au format CSV  
**Description :** Exporter l’inventaire complet du parc informatique dans un fichier CSV.  
**Acteur :** Technicien  
**Portée :** Boîte noire  
**Niveau :** Utilisateur  

## Scénarios

| **Nominal** | **Alternatif** | **Exception** |
|--------------|----------------|----------------|
| 1) Le technicien accède à la section « Export »  <br> 2) Le système génère le fichier CSV contenant toutes les informations du parc  <br> 3) Le système propose le téléchargement du fichier au technicien  <br> 4) Le technicien télécharge le fichier CSV sur son ordinateur | **I) Export avec filtres**  <br> 1) Le technicien applique des filtres  <br> 2) Le système génère un CSV contenant uniquement les éléments correspondants  <br> 3) Le système propose le téléchargement du fichier au technicien  <br> 4) Le technicien télécharge le fichier CSV sur son ordinateur  <br><br> **II) Sélection de colonnes**  <br> 1) Le technicien choisit uniquement certaines colonnes  <br> 2) Le système propose le téléchargement du fichier au technicien  <br> 3) Le technicien télécharge le fichier CSV sur son ordinateur | **I) Inventaire vide**  <br> 1) L’inventaire ne contient aucun élément  <br> 2) Le système affiche le message « Aucun élément à exporter »  <br><br> **II) Erreur technique / réseau**  <br> 1) Le système ne parvient pas à générer le fichier  <br> 2) Le système affiche un message d’erreur |

## Consulter rebut
**Nom :** Consulter la liste du rebut  
**Description :** Un technicien peut accéder à la liste des matériels retirés de l’inventaire actif et placés dans le rebut.  
**Acteur :** Technicien  
**Portée :** Boîte noire  
**Niveau :** Utilisateur  

## Scénarios

| **Nominal** | **Alternatif** | **Exception** |
|--------------|----------------|----------------|
| 1) Le technicien clique sur l’icône « Liste de rebut »  <br> 2) Le système affiche la liste complète  <br> 3) Le technicien consulte le détail d’un élément | *(Aucun scénario alternatif spécifié)* | **I) Liste vide**  <br> 1) La liste de rebut est vide  <br> 2) Le système affiche le message « Aucun matériel mis au rebut »  <br><br> **II) Erreur technique / réseau**  <br> 1) Le système ne peut afficher la liste de rebut  <br> 2) Le système affiche un message d’erreur |

## Changer statut matériel

**Nom :** Changer le statut d’un matériel si remis en service  
**Description :** Le technicien modifie le statut du matériel pour refléter qu’il est à nouveau opérationnel et consultable dans les listes normales du parc.  
**Acteur :** Technicien  
**Portée :** Boîte noire  
**Niveau :** Utilisateur  

## Scénarios

| **Nominal** | **Alternatif** | **Exception** |
|--------------|----------------|----------------|
| 1) Le technicien accède à la liste du rebut  <br> 2) Il sélectionne le matériel  <br> 3) Il clique sur l’option « Restaurer »  <br> 4) Le système demande une confirmation  <br> 5) Le technicien confirme  <br> 6) Le système change le statut du matériel et le réintègre dans l’inventaire  <br> 7) Le système affiche un message de confirmation | **I) Remise en service multiple**  <br> 1) Le technicien sélectionne plusieurs matériels à restaurer  <br> 2) Le système demande confirmation  <br> 3) Le système change le statut des matériels et les réintègre dans l’inventaire  <br> 4) Le système affiche un message de confirmation | **I) Erreur technique / réseau**  <br> 1) Le système ne parvient pas à mettre à jour le statut  <br> 2) Le système affiche un message d’erreur |








---

# Administrateur web 

## Ajouter technicien

**Nom :** Ajouter un technicien  
**Description :** Ajoute un compte « technicien » en renseignant le nom d’utilisateur et son mot de passe.  
**Acteur :** Administrateur web  
**Portée :** Boîte noire  
**Niveau :** Utilisateur  

## Scénarios

| **Nominal** | **Alternatif** | **Exception** |
|--------------|----------------|----------------|
| 1) L’administrateur accède à la liste des techniciens  <br> 2) Il appuie sur le bouton « + »  <br> 3) Il remplit le formulaire d’ajout  <br> 4) Le système ajoute le technicien  <br> 5) Le système affiche un message de confirmation | *(Aucun scénario alternatif spécifié)* | **I) Le système n’ajoute pas le technicien**  <br> 1) Le système renvoie un message d’erreur |

## Bloquer liste rebut

**Nom :** Bloquer la liste de rebut  
**Description :** L’administrateur web modifie l’accès du technicien à la liste de rebut.  
**Acteur :** Administrateur web  
**Portée :** Boîte noire  
**Niveau :** Utilisateur  

## Scénarios

| **Nominal** | **Alternatif** | **Exception** |
|-------------|----------------|----------------|
| 1) L’administrateur accède aux informations de la liste de rebut <br> 2) Il appuie sur le bouton **on/off** <br> 3) Un avertissement s’affiche, il appuie sur **Oui** <br> 4) L’accès à la liste de rebut est bloqué pour le technicien | 3*) Il appuie sur **Non** <br> 4) Aucune option ne change, retour aux informations de la liste de rebut | I) Le système ne modifie pas la permission <br> 1) Le système renvoie un message d’erreur |
---

# Administrateur système

## Consultation des logs

**Nom :** Consulter les logs  
**Description :** Affichage de toutes les actions effectuées avec le nom du technicien ou de l’administrateur.  
**Acteur :** Administrateur système  
**Portée :** Boîte noire  
**Niveau :** Utilisateur  

## Scénarios

| **Nominal** | **Alternatif** | **Exception** |
|-------------|----------------|----------------|
| 1) L’administrateur appuie sur l’onglet **Log** <br> 2) Le système vérifie ses permissions <br> 3) Le système récupère les données des actions en mémoire <br> 4) Transmission et affichage des données | *(Aucun scénario alternatif spécifié)* | I) Le système ne trouve pas les données ou rencontre une erreur lors du traitement <br> 1) Le système renvoie un message d’erreur |



