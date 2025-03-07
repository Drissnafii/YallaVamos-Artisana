# Suppression en Cascade dans les Relations entre Villes et Hébergements

## Contexte

Dans notre application "Guide de la Coupe du Monde au Maroc", nous gérons deux entités principales :

- **Villes** : Représentant les villes hôtes de la Coupe du Monde, telles que Marrakech, Agadir, Casablanca, etc.
- **Hébergements** : Incluant les hôtels, riads, appartements, et autres lieux où les visiteurs peuvent séjourner, situés dans une ville spécifique.

Ces deux entités sont liées par une relation : **les hébergements sont associés à une ville**. 

Une question cruciale se pose : **Que se passe-t-il lorsqu'une ville est supprimée de notre base de données ?**

## Analyse logique

### Scénario concret

1. Si une ville, comme Agadir, est supprimée, cela signifie que, dans le contexte de notre application, Agadir n'est plus une ville hôte de la Coupe du Monde.
2. Les hébergements liés à Agadir n'ont plus de raison d'être listés dans le guide, car ce dernier est centré uniquement sur les villes hôtes.

### Conséquences

- Les hébergements à Agadir existent toujours dans la réalité, mais dans le cadre de l'application, ils ne sont plus pertinents car ils sont liés à une ville qui n'est plus une ville hôte.
- **Notre objectif :** Maintenir la cohérence des données en supprimant automatiquement les hébergements liés lorsque la ville est supprimée.

## Pourquoi `onDelete('cascade')` ?

L'utilisation de l'action `onDelete('cascade')` dans les relations entre tables reflète cette logique :

- **Suppression logique des données liées :** Si une ville est supprimée, tous les hébergements qui lui sont associés dans le guide sont également supprimés.
- **Simplification de la gestion des données :** La base de données nettoie automatiquement les données liées, évitant ainsi une gestion manuelle fastidieuse.
- **Cohérence des données :** Empêche la création de données "orphelines" (hébergements sans ville associée).

## Conclusion

L'utilisation de `onDelete('cascade')` est une solution logique et pratique pour gérer les relations entre villes et hébergements dans notre application. Elle garantit une gestion efficace des données, tout en maintenant leur cohérence et leur pertinence.
