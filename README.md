# Template de projet PHP
Environnement de développement sous docker pour des projets web PHP conçu de manière à ce que le code source de l'application soit totalement indépendant de l'environnement de développement, ce qui permet de le déployer tel quel en adaptant le fichier d'environnement.

## Sommaire
- [Template de projet PHP](#template-de-projet-php)
  - [Sommaire](#sommaire)
  - [Spécifications des services](#spécifications-des-services)
    - [database](#database)
    - [www](#www)
  - [Utilisation](#utilisation)

## Spécifications des services
### database
Service de base de données.
| Caractéristique | Description |
| :--- | :--- |
| **Container** | _nom\_projet_\_db |
| **Type** | MariaDB (dernière version) |
| **Port Interne** | 3306 |
| **Port Externe** | 3307 |
| **Nom du Volume** | _nom\_projet_\_data |
[Retour au sommaire](#sommaire)

### www
Service web.
| Caractéristique | Description |
| :--- | :--- |
| **Container** | _nom\_projet_\_www |
| **Système** | Linux Alpine AMD64 |
| **Serveur Web** | Apache 2 |
| **Version PHP** | 8.3 FPM/FastCGI |
| **Port HTTP Interne -> Externe** | 80 -> 80 |
| **Port HTTPS Interne -> Externe** | 443 -> 443 |
| **Port Socket PHP Interne -> Externe** | 9000 -> 9001 |
| **Document Root** | /public |
| **Debug** | Xdebug 3 |
| **Packager** | Composer (dernière version) |
[Retour au sommaire](#sommaire)


## Utilisation
- Lancer le script `init.sh`
  - S'il n'est pas exécutable :
    - `chmod +x ./init.sh`
    - Retenter l'éxécution
- Démarrer l'environnement : `docker compose up`