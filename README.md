# Dev_Web_INPT_2020_G0 Projet reservation des salles à distance.

Membres collaboratifs:

  - Mr Mohammed AL JADD.
  - Mr Mahmoud ELHAMLAOUI.

Problématique:
 
  - Difficulté à trouver une salle disponible.
  - Le professeur a besoin d'être dans l'institut pour trouver une salle disponible.
  - L'emploi du temps doit être modifié chaque fois qu'il n'y a pas de salle disponible.
  
Lien pour les maquettes :https://app.moqups.com/IVpoM23cPK/view/page/a150bb875 .
  
Description du projet:

    Les langages de programmations : HTML,CSS,JavaScript et PHP.

    Lorsque vous vous connectez en tant qu' un utilisateur normal, la page d'accueil apparaît avec une barre de navigation contenant 
quatre liens: accueil, réservation, compte et contact.
  
    La page d'accueil contient des informations comme les réseaux sociaux d’INPT, les coordonnées de l'administrateur.
La page contact permettra aux utilisateurs d'envoyer leurs messages à administrateur. La page compte leur permettra 
de changer leurs mots de passe. Pour  la page de réservation, un bloc affichera aux utilisateurs le nombre de chambres disponibles 
et en bas il y a des options pour les bâtiments. Après avoir sélectionné un bâtiment une autre page affichera une sélection d'options 
pour les salles qui sont disponibles. Une option est une chaîne concaténée avec la première date de réservation si elle est déjà réservée 
ou avec "pas encore réservé". Après avoir sélectionné une salle, une zone de texte  apparaîtra au milieu 
pour entrer les dates si la salle n'est pas encore réservée ou à droite pour laisser la gauche côté 
pour un tableau qui montrera les dates qui ont déjà été prises par d'autres utilisateurs. Si les dates sont correctes et que l'utilisateur soumet, un tableau apparaîtra qui montrera la date de début et la date de fin 
et un bouton pour annuler la réservation. Une fois que l'utilisateur a réservé, il n'est plus autorisé à entrer 
dans la page de soumission de la réservation. 

    Maintenant, si l'administration se connecte la page d'accueil apparaîtra avec une barre de navigation contenant quatre liens: 
accueil, réservation, compte et modifier users. La page «  modify users »  contiendra deux blocs verticaux, l'un est un tableau qui montre les coordonnées de tous les utilisateurs, 
la seconde est un formulaire pour ajouter ou supprimer un utilisateur. Cette  page contient une autre barre de navigation. 
La différence est qu'elle continent lien 'affectation' .Dans cette dernière, 
un tableau montrera à l'administrateur toutes les réservations qui sont prises. 
    
    Une autre chose est que dans la base de données utilisée, un événement (event : comme trigger) qui supprimera automatiquement 
une réservation qui devient ancienne.

