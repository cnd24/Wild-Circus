# Wild-Circus

Ce projet a été développé dans le cadre d'une évaluation lors de ma formation à la Wild Code School. J'ai donc décidé de continuer à développer ce projet afin de confirmer mes compétences sur Symfony.

J'ai donc réalisé un site avec la possibilité d'administrer : 
- les spectacles présentés
- les représentations avec les dates et lieux des spectacles
- les artistes qui sont présents sur différents spectacles


## Installer le projet : 
```sh
  $ composer install
  $ yarn install 
```
  - configurer le fichier .env.local (copie non versionnée du fichier .env), en renseignant les éléments nécessaires à la connexion à la BDD : l'identifiant *bd_user*, le mot de passe *db_password*, le nom de la BDD à créer *bd_name*
  - créer la BDD avec doctrine ```doctrine:database:create ```
  - lancer la structuration de la BDD en environnement dev ```doctrine:schema:update --force```
  - lancer les fixtures ```doctrine:fixture:load```
  - lancer le serveur Symfony ```symfony server:start```ainsi que ```yarn encore dev --watch```
  - pour se connecter à l'adminitration, les identifiants se trouvent dans UserFixtures
