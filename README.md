
# EsasyFit Api


## Présentation

Cette application est développée dans le cadre de la formation de Graduate Développeur mobile Android chez Studi.

L'api EasyFit est un outil de gestion de salle de sport.

En fonction de l'utilisateur connecté, l’interface permet :
 - à une équipe d’administration de gérer (lister, créer, activer/désactiver, rechercher, supprimer) :
    - des administrateurs,
    - des franchises avec leurs options globales,
    - des structures avec leurs options,
 - à une franchise de lister et rechercher ses structures et ses options globales,
 - à une structure de lister et rechercher ses options.


## Liens

L'application est disponible en ligne [Ici](https://ecf-studi-easyfit.herokuapp.com/)  (identifiants remis par courrier)

La planification du projet (Trello) [Ici](https://trello.com/invite/b/DJiZ8b4A/ATTI313cc7525dbafb7743c76475476ced985E5F3278/ecf-octobre-2022)

Les documents d'élaboration du projet (excalidraw) [Ici](https://ecf-studi-easyfit.herokuapp.com/)

## Prérequis

- PHP 8.1
- Symfony 6
- Composer 2
- WebPack 5

## Installation

- Cloner le repository
- Installer les dépendances symfony : composer instal
- Installer les dépendances webpack et Node.js : yarn instal
- compiler le repertoire Build : yarn build
- copier le fichier .env en .env_local
- configurer le fichier .env_local avec les variables de votre base de donnée.
- création de la base de donnée : Symfony console make:migration
- Executer la migration : symfony console doctrine:migration:migrate
- lancer le serveur : symfony serve



## Manuel d'utilisation

Des identifiants vous ont été remis par courrier. Ils vous serviront à vous connecter à votre interface.

#### Vous êtes administrateur :

 Trois onglets vous permettent de gérer (lister, créer, activer/désactiver, supprimer) :
- des administrateurs,
- des franchises avec leurs options globales,
- des structures avec leurs options,
Nota:
   - Pour créer une structure rendez-vous dans le détail d'une franchise
   - Pour activer/désactiver une option globale d'une franchise, rendez-vous sur le détail d'une franchise
   - Pour activer/désactiver une option d'une structure, rendez-vous sur le détail d'une structure

#### Vous êtes une franchise :

L'application vous permet de lister vos structures et vos options globales.

#### Vous êtes une structure :

L'application vous permet de lister vos options.

Lors de la première utilisation Créer un nouvel administrateur et supprimer les autres données.

