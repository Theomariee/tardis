# notesesir

# Projet de consultation centralisée des notes d'un élève-ingénieur de l'ESIR

```
Cette application n'est pas en partenariat avec l'ESIR 
et relève d'une initiative personnelle
```

## Quoi ?
Le but de cette application Web est de fournir un espace de consultation global des notes publiées sur l'espace d'apprentissage _Moodle_.

## Pourquoi ?
Elle répond à un constat simple : il n'existe aucun service permettant à chaque étudiant de pouvoir consulter simplement et efficacement les notes qu'il a obtenu dans un module suivi. De plus, l’hétérogénéité des principes de mise en ligne des résultats (extensions de fichier différentes, présentations des contenus différentes, ...) rend la tâche d'autant plus difficile et empêche alors un aperçu simple et rapide de ses résultats.

## Comment ?
Afin de palier à ces problèmes, il s'agira de permettre un aperçu global des notes d'un étudiant à l'aide de l'alimentation de la base de données par un import des fichiers déposés dans les espaces _Moodle_. Cet outil proposera également un moyen, pour tout élève, d'être notifié par mail de l'ajout d'une ou plusieurs notes dans un module le concernant.

## Technologies utilisées
L'application, en cours de développement, repose sur le framework [PHP/Symfony 4](https://symfony.com/) pour le côté Backend et sur l'utilisation de [Bootstrap 4](https://getbootstrap.com/), jQuery, JavaScript et Ajax pour le Frontend.

## Avancement du projet
- [x] Initialisation du framework
- [x] Modélisation de la base de données
- [x] Création des entités/relations
- [x] Templating du squelette de l'application
- [ ] Templating du dashboard (statistiques et notifications) **(en cours)**
- [ ] Templating page de connexion 
- [ ] ...
