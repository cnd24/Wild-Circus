# Wild-Circus

Mission du dernier Checkpoint de la Wild Code School : réaliser en 48h un site sur le thème du Wild Circus en développant les fonctionalités souhaitées.

J'ai donc réalisé un site avec la possibilité d'administrer : 
- les spectacles présentés
- les représentations avec les dates et lieux des spectacles
- les artistes qui sont présents sur différents spectacles


Pour installer le projet : 
  - composer install
  - yarn install 
  - configurer le fichier .env.local (copie non versionnée du fichier .env), en renseignant les éléments nécessaires à la connexion à la BDD : l'identifiant *bd_user*, le mot de passe *db_password*, le nom de la BDD à créer *bd_name*
  - créer la BDD avec mysql
  - lancer la structuration de la BDD en dev (doctrine:schema:update --force)
  - lancer les fixtures (doctrine:fixture:load)
  - lancer le serveur Symfony ainsi que *Yarn encore dev --watch*
  
La partie administrable se trouve en lien dans le footer pour le moment ;-)
