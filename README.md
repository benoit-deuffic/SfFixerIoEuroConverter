# Portage du Test technique JavaScript sur Symfony


## Spécifications

Le but est de consommer l'api de ​http://fixer.io​ (l'obtention d'un API KEY est gratuite), pour
construire un convertisseur de devise en temps réel.
Cette fois l'interrogation de l'api sera déportée sur un serveur Symfony.

## Résultat attendu

```
● Une application permettant de renseigner dans un champ de saisie une somme en
euros, et d'avoir la conversion dans une autre devise. Une liste déroulante permet de
sélectionner la devise dans laquelle la somme en euros doit être convertie.
● Le calcul doit être instantané : dès que le montant en euros change ou que la devise
sélectionnée change, le montant converti doit changer.
● L'utilisation de libraries (React, jQuery...) et autres modules de l'écosystème est
autorisée.
● L'utilisation de libraries standard de Node.js doit être suffisante.

● Pas de charte graphique imposée, mais c'est l'occasion de montrer que tu es
capable de développer un truc propre :)
```

## Livraison

Le code doit être pushé sur un repo public sur GitHub.

## Implémentation

Un controleur baseController associé à un service iOFixerEuroConverter gère la consommation du service fixer.io et ouvre sa consommation en tant que serveur.

Une page index.html établie une connection en ajax (Jquery) avec le serveur et l'ensemble communique par WebServices REST.

Il y a 3 événements à l'origine du client qui donnent les ordres à exécuter au serveur:
```
● connect: conenction d'un client au serveur
● init: consomme la fonction "symbols" de fixer.io. le serveur récupére la liste des devis, la retourne au client qui alimente le select.
● convert: consomme la fonction "latest" pour récupérer le dernier taux de change connu de la devise demandée et applique le calcul de la conversion

Le serveur déclenche 3 événements que le client doit écouter:
● code http 200, traitement avec succès de l'interrogation de fixer.io
● code http 5xx, 4xx, traitement en erreur avec un message générique
```

Il y a 1 fonction génériques qui gère l'affichage des résultats.

Le tout s'appuie sur Jquery 3.4.1 et Symfony 5 . 

La page index.html appelle l'objet.

Le service est consommé à l'initialisation une fois page complètement chargée, au moment de changer ou lorsqu'une touche du clavier est relâchée sur le champ de saisie du montant
et lorsqu'une autre valeur de la liste des devises est choisie. 
Dans notre exemple on génère l'événement convert pour que le serveur trouve le taux de conversion, calcule le montant en euros dans la devise demandé et retourne le résultat.

## Installation:

Avoir docker et docker-compose.

Une fois le dépot cloné:
```
$ make
```
Ouvrir un navigateur sur http://localhost:8081
