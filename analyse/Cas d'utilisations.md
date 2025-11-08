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

| Nom : Consulter une partie de l’inventaire<br> Description : Il permet de visualiser certaines informations sur les éléments disponibles (catégorie, description, numéro), sans pouvoir les modifier ni accéder aux sections réservées.<br> Acteur : Utilisateur non inscrit (visiteur)<br> Portée : boîte noire<br> Niveau : Utilisateur |
| :---- |
| Scénarios Nominal:  1\) L’utilisateur accède à la page d’accueil 2\) Il sélectionne l’option consulter l’inventaire 3\) Le système affiche la liste des éléments visibles publiquements 4\) L’utilisateur filtre/trie 5\) Mise à jour de l’affichage 6\) L’utilisateur consulte le détail d’un élément Alternatif: I) Accès via une catégorie 1\) L’utilisateur clique directement sur une catégorie publique 2\) Le système affiche les éléments correspondants 3\) L’utilisateur consulte le détail d’un élément II) Utilisation de la barre de recherche 1\) L’utilisateur saisit un mot-clé dans la barre de recherche 2\) Le système affiche les résultats correspondants 3\) L’utilisateur consulte le détail d’un élément Exception: I) Inventaire vide ou aucun résultat 1\) Le système affiche “Aucun élément disponible/trouvé” II) Erreur technique 1\) Le système ne parvient pas à récupérer les donné 2\) Message du système “Erreur de connexion”  |

# Technicien 

## Connection platerforme 

| Nom : Se connecter à la plateforme<br> Description : La connexion permet au technicien d’accéder aux fonctionnalités protégées et de gérer ou consulter l’inventaire selon ses droits.<br> Acteur : Technicienv Portée : boîte noire<br> Niveau : Utilisateur |
| :---- |
| Scénarios Nominal: 1\) Le technicien accède à la page de connexion de la plateforme 2\) Il saisit son identifiant et mot de passe 3\) Le système vérifie les informations 4\) Le système valide l'identité du technicien 5\) Le système redirige le technicien vers la page d’accueil/ tableau de bord Alternatif: Exception: I) Identifiants incorrects 1\) Le système affiche un message “Identifiant ou mot de passe incorrect” 2\) Le technicien peut réessayer II) Erreur technique/réseau 1\) Le système ne parvient pas à vérifier les identifiants 2\) Message du système “Erreur de connexion”  |

## Consulter parc 

| Nom : Consulter la liste complète du parc<br> Description : Le technicien peut visualiser toutes les informations pertinentes pour la gestion ou le suivi, mais sans modifier les éléments à moins que d’autres cas d’utilisation spécifiques ne le permettent.<br> Acteur : Technicien<br> Portée : boîte noire<br> Niveau : Utilisateur |
| :---- |
| Scénarios Nominal: 1\) Le technicien accède à la section “Inventaire” 2\) Le système affiche la liste complète des équipements 3\) Le technicien peut filtrer,trier ou rechercher 4\) Le système met à jour l’affichage selon les critères 5\) Le technicien consulte le détail des éléments Alternatif: Exception: I) Inventaire vide ou aucun résultat 1\) Le système affiche “Aucun élément disponible/trouvé” II) Erreur technique/réseau 1\) Le système ne parvient pas à charger les données 2\) Message du système “Erreur de connexion”  |

## 

## 

## 

## 

## Modifier information

| Nom : Modifier une information d’un matériel existant<br> Description : Les modifications peuvent concerner, par exemple, l’état, la localisation, la description ou toute information administrative liée au matériel.<br> Acteur : Technicien<br> Portée : boîte noire<br> Niveau : Utilisateur |
| :---- |
| Scénarios Nominal: 1\) Le technicien accède à la fiche/au détail d’un élément 2\) Il sélectionne “Editer” 3\) Le système affiche la fenêtre de modification 4\) Le technicien modifie les champs nécessaire 5\) Il valide les modifications 6\) Le système enregistre les changements et affiche un message de confirmation Alternatif: Exception: II) Erreur technique/réseau 1\) Le système ne parvient pas à enregistrer les modifications 2\) Envoie un message “Erreur lors de l’enregistrement”  |

## Ajouter machine formulaire

| Nom : Ajouter une machine via un formulaire<br> Description : Les informations saisies permettent d’enregistrer le matériel avec toutes ses caractéristiques (type, localisation, état, description, etc.) pour qu’il soit consultable et gérable par le système.<br> Acteur : Technicien<br> Portée : boîte noire<br> Niveau : Utilisateur |
| :---- |
| Scénarios Nominal: 1\) Le technicien accède à la section “Ajouter un élément” 2\) Le système affiche le formulaire d’ajout avec les champs requis 3\) Le technicien saisit les informations de tous les champs 4\) Il valide le formulaire en cliquant sur enregistrer/valider 5\) Le système enregistre l’élément dans l’inventaire et affiche un message de confirmation Alternatif: I) Saisie partiels 1\) Le technicien remplit uniquement les champs obligatoires 2\) Il valide le formulaire en cliquant sur enregistrer/valider 3\) Le système enregistre l’élément dans l’inventaire et affiche un message de confirmation Exception: I) Formulaire incomplet 1\) Le technicien soumet un formulaire avec un champ obligatoire manquant 2\) Le système affiche un message d’erreur et indique le champs à remplir II) Erreur technique/réseau 1\) Le système ne parvient pas à enregistrer l’élément 2\) Message d’erreur  |

## Ajouter machine CSV

| Nom : Ajouter plusieurs machines via un fichier CSV<br> Description : Chaque ligne du fichier correspond à un matériel avec ses caractéristiques (type, localisation, état, description, etc.). Le système valide et enregistre les données pour que les machines soient consultables et gérables.<br> Acteur : Technicien <br>Portée : boîte noire<br> Niveau : Utilisateur |
| :---- |
| Scénarios Nominal: 1\) Le technicien accède à la section “Ajouter un élément” 2\) Il sélectionne l’option insertion via CSV 3\) Le système affiche une interface avec les instructions 4\) Le technicien sélectionne et insère le fichier CSV 5\) Le système valide le fichier (format, champ…) 6\) Le système enregistre toute les machines dans l’inventaires 7\) Le système affiche un message de confirmation et indique le nombre machines ajoutés Alternatif: I) Des lignes sont incorrectes 1\) Le fichier contient quelques lignes avec des erreurs 2\) Le système ajoute les lignes valides 3\) Il envoie un rapport avec les lignes qui ont été refusés Exception: I) Fichier autre que CSV 1\) Le fichier insérer n’est pas un CSV 2\) Le système envoie un message d’erreur “le fichier n’est pas un fichier csv” II) Fichier incorrect/mauvais format 1\) Le fichier CSV est invalide (colonnes manquantes/invalide, caractères non valides) 2\) Le système refuse l’import et affiche un message d’erreur III) Erreur technique/réseau 1\) Le système ne parvient pas à enregistrer les machines du fichier 2\) Le système affiche un message d’erreur  |

## Supprimer machine

| Nom : Supprimer une machine pour la placer dans la liste du rebut<br> Description : La suppression ne détruit pas les informations historiques mais déplace le matériel dans la section “Rebut”.<br> Acteur : Technicien<br> Portée : boîte noire<br> Niveau : Utilisateur |
| :---- |
| Scénarios Nominal: 1\) Le technicien accède au détail d’un matériel 2\) Il sélectionne l’option supprimer 3\) Le système demande une confirmation 4\) Le technicien confirme l’opération 5\) Le système retire le matériel de l’inventaire et le place dans la liste du rebut 6\) Le système affiche un message de confirmation Alternatif: I) Suppression multiple 1\) Le technicien sélectionne plusieurs machines à placer dans le rebut 2\) Le système demande confirmation 3\) Le technicien confirme l’opération 4\) Le système retire les machines de l’inventaire et les place dans la liste du rebut 5\) Le système affiche un message de confirmation Exception: I)Erreurs technique/réseau 1\) Le système ne parvient pas à placer le matériel dans le rebut 2\) Message d’erreur  |

## Exportation CSV
| Nom : Exporter la liste du parc au format CSV<br> Description : Exporter l’inventaire complet du parc informatique dans un fichier CSV.<br> Acteur : Technicien <br>Portée : boîte noire<br> Niveau : Utilisateur |
| :---- |
| Scénarios Nominal: 1\) Le technicien accède à la section “Export” 2\) Le système génère le fichier CSV contenant toutes les informations du parc 3\) Le système propose le téléchargement du fichier au technicien 4\) Le technicien télécharge le fichier CSV sur son ordinateur Alternatif: I) Export avec filtres 1\) Le technicien applique des filtres 2\) Le système génère un CSV contenant uniquement les éléments correspondants 3\) Le système propose le téléchargement du fichier au technicien 4\) Le technicien télécharge le fichier CSV sur son ordinateur II) Sélection de colonnes 1)Le technicien choisit uniquement certaines colonnes 2\) Le système propose le téléchargement du fichier au technicien 3\) Le technicien télécharge le fichier CSV sur son ordinateur Exception: I) Inventaire vide 1\) L’inventaire ne contient aucun élément 2\) Message “Aucun élément à exporter” II) Erreur technique/réseau 1\) Le système ne parvient pas à générer le fichier 2\) Message d’erreur  |

## Consulter rebut
| Nom : Consulter la liste du rebut<br> Description Un technicien peut accéder à la liste des matériels retirés de l’inventaire actif et placés dans le rebut.<br> Acteur : Technicien<br> Portée : boîte noire<br> Niveau : Utilisateur |
| :---- |
| Scénarios Nominal: 1\) Le technicien accède clique sur l'icône liste de rebut 2\) Le système affiche la liste complète 3\) Le technicien consulte le détail d’un élément Alternatif: Exception: I) Liste vide 1\) La liste de rebut est vide 2\) Message “Aucun matériel mis au rebut” II) Erreur technique/réseau 1\) Le système ne peut afficher la liste de rebut 2\) Message d’erreur  |

## Changer statut matériel

| Nom : Changer le statut d’un matériel si remis en service<br> Description : Le technicien modifie le statut du matériel pour refléter qu’il est à nouveau opérationnel et consultable dans les listes normales du parc<br>. Acteur : Technicien<br> Portée : boîte noire<br> Niveau : Utilisateur |
| :---- |
| Scénarios Nominal: 1\) Le technicien accède à la liste du rebut 2\) Il sélectionne le matériel 3\) Il clique sur l’option “Restaurer” 4\) Le système demande une confirmation 5\) Le technicien confirme 6\) Le système change le statut du matériel et le réintègre dans l’inventaire 7\) Message de confirmation Alternatif: I) Remise en service multiple 1\) Le technicien sélectionne plusieurs matériels à restaurer 2\) Le système demande confirmation 3\) Le système change le statut des matériels et les réintègre dans l’inventaire 7\) Message de confirmation Exception: I) Erreur technique/réseau 1\) Le système ne parvient pas à mettre à jour le statut 2\) Message d’erreur  |

# Administrateur web 

## Ajouter technicien

| Nom : Ajouter un technicien<br> Description : Ajoute un compte ‘technicien’ en renseignant le nom d’utilisateur et son mot de passe.<br> Acteur : Administrateur web<br> Portée : Boite noire<br> Niveau : Utilisateur |
| :---- |
| Scénarios Nominal:  1)L’admin accède à la liste des techniciens.2\) Il appuie sur un bouton “+” 3\) Un formulaire est rempli 4\) Le technicien est ajouté au système. 5\) Un message de confirmation apparaît.  Alternatif: Exception: I) Le système n’ajoute pas le technicien  1- renvoie un message d’erreur  |

## Bloquer liste rebut

| Nom : Bloquer la liste de rebut<br> Description : L’administrateur web modifie l’accès au technicien d’accéder à la liste de rebut.<br> Acteur : Administrateur web<br>  Portée : Boite noire<br> Niveau : Utilisateur  |
| :---- |
| Scénarios Nominal:  1)L’administrateur accède au information de la liste de rebut 2)Un bouton on/off sera présent, il appuie dessus 3\) Un avertissement s’affiche pour confirmer le changement, il appuie sur “oui” 4\) L’accès à la liste de rebut est bloqué au technicien. Alternatif: 3\*) Il appuie sur “non”   4\) Aucune option ne change, retour au information de la liste de rebut. Exception: I) Le système ne modifie pas la permission : 1- renvoie un message d’erreur  |

## 

# Administrateur système

## Consultation des logs

| Nom : Consulter les logs<br> Description : Affichage de toutes les actions faite avec le nom du technicien ou de l’administrateur.<br> Acteur : Administrateur système<br> Portée : Boite Noire<br> Niveau : Utilisateur  |
| :---- |
| Scénarios Nominal:  1\) Un onglet “Log” est appuyer 2\) Vérifie les permissions de la personne 3\) Récupère les données des actions en mémoire 4\) Transmission et affichage des données Alternatif: Exception: I) Le système ne trouve pas les données/autre erreur lors du traitement: 1- renvoie un message d’erreur  |



