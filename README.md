# 🏆 Guide de la Coupe du Monde au Maroc 2030

An interactive web guide for the FIFA World Cup 2030 co-hosted by Morocco, providing essential information for international visitors, football fans, and local residents.

## 🌟 Features

### For Visitors

*   Browse host cities and their cultural attractions.
*   View stadium details and match schedules.
*   Find accommodation and transportation options.
*   Access visa and cultural information.
*   Save favorite cities, matches, and venues.
*   Read the latest World Cup news and updates.

### For Administrators

*   Manage cities, stadiums, and matches.
*   Update accommodation listings.
*   Publish news and articles.
*   Manage user accounts.

## 🛠 Tech Stack

*   **Back-end:** Laravel (PHP)
*   **Database:** MySQL
*   **Front-end:** HTML, Tailwind CSS, JavaScript
*   **Architecture:** Model-View-Controller (MVC) with Repository Pattern

## 🔒 Security

*   Custom authentication system (built from scratch).
*   CSRF (Cross-Site Request Forgery) protection.
*   XSS (Cross-Site Scripting) prevention.
*   Input validation.
*   Secure password handling.

## 👥 Contributing

1.  Fork the repository.
2.  Create a feature branch.
3.  Commit your changes.
4.  Push to the branch.
5.  Create a Pull Request.

## 📝 License

[MIT License](LICENSE)

## 🤝 Acknowledgements

*   FIFA World Cup 2030 Committee.
*   Moroccan Football Federation.
*   Project Supervisors.

Based on the details of your project, "Guide de la Coupe du Monde au Maroc," here’s a structured and detailed README file for your application:


# Guide de la Coupe du Monde au Maroc

**Un guide web interactif pour la Coupe du Monde FIFA 2030 co-organisée par le Maroc.**

---

## Description

Le "Guide de la Coupe du Monde au Maroc" est une plateforme web conçue pour fournir des informations complètes et accessibles sur l'événement, tout en mettant en valeur la culture et le patrimoine marocains. Cette application interactive est destinée aux visiteurs internationaux, aux fans de football, et à la population locale.

---

## Fonctionnalités

### Fonctionnalités Principales
- **Liste des villes hôtes :**
  - Voir la liste des villes participantes avec des informations détaillées (culture, attractions, etc.).
- **Détails des stades :**
  - Consulter des informations pratiques sur les stades (capacité, adresse, transport).
- **Calendrier des matchs :**
  - Voir les matchs avec date, heure et lieu.
  - Recherche et filtrage par date, lieu ou équipes.
- **Transport et cartes interactives :**
  - Informations sur les moyens de transport locaux.
  - Intégration de cartes pour les itinéraires principaux.
- **Hébergements :**
  - Liste d’hôtels et autres hébergements dans les villes hôtes, filtrable par ville.
- **Informations pratiques :**
  - Pages dédiées sur les visas, la culture et les coutumes marocaines.
- **Articles et actualités :**
  - Une section dédiée aux articles récents et informations liées à l’événement.
- **Favoris :**
  - Enregistrez des villes, stades et matchs comme favoris pour un accès rapide.

### Fonctionnalités Administration
- Gestion des villes hôtes, stades, matchs, articles, actualités et options d’hébergement.
- Administration possible pour les comptes utilisateurs (optionnel).

---

## Technologies Utilisées

- **Back-end :** PHP (Framework Laravel).
- **Base de données :** MySQL.
- **Front-end :** HTML, CSS (avec Tailwind CSS), JavaScript.
- **Architecture du code :** Respect des principes DRY et KISS, utilisation du pattern Repository.

---

## Installation et Lancement

### Prérequis
- PHP 8.x installé.
- MySQL installé et configuré.
- Composer pour la gestion des dépendances PHP.
- Node.js pour la gestion des packages front-end (si applicable).

### Étapes
1. Clonez ce dépôt :
   ```bash
   git clone <URL_du_dépôt>
   ```
2. Accédez au dossier du projet :
   ```bash
   cd nom_du_dossier
   ```
3. Installez les dépendances Laravel :
   ```bash
   composer install
   ```
4. Configurez le fichier `.env` :
   - Dupliquez le fichier `.env.example` et renommez-le `.env`.
   - Mettez à jour les informations de connexion à la base de données.
5. Générez une clé d'application :
   ```bash
   php artisan key:generate
   ```
6. Exécutez les migrations et seeders :
   ```bash
   php artisan migrate --seed
   ```
7. Lancez le serveur de développement :
   ```bash
   php artisan serve
   ```

---

## Modèle de Données

### Structure initiale
- **Villes :** id, nom, description, image, coordonnées.
- **Stades :** id, nom, ville_id, adresse, capacité, image.
- **Matchs :** id, date, heure, stade_id, equipe_1, equipe_2.
- **Articles :** id, titre, contenu, date_publication, image.
- **Hébergements :** id, nom, ville_id, adresse, type, prix.

---

## Roadmap

### Étapes
1. **Phase 1 :** Analyse, définition du modèle de données, création de wireframes.
2. **Phase 2 :** Développement back-end avec Laravel.
3. **Phase 3 :** Développement front-end avec Tailwind CSS.
4. **Phase 4 :** Tests, corrections, documentation.
5. **Phase 5 :** Soutenance et mise en ligne du projet.

---

## Contributeurs

- **Projet développé dans le cadre de la formation en développement web.**
- Contact : [Votre Email ou GitHub]

---

## Licence

Ce projet est sous licence **MIT**. Consultez le fichier `LICENSE` pour plus de détails.

---

## Note

Ce projet est évolutif. De nouvelles fonctionnalités pourront être ajoutées selon les besoins identifiés lors du développement.

---

```

Ce fichier README est adapté pour présenter clairement le projet, ses fonctionnalités, et ses exigences techniques. Qu'en pensez-vous ? Aimeriez-vous que j'ajoute ou modifie quelque chose ?

