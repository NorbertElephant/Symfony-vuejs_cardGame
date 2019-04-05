------ Insertion De Donnees  ---------------- 
/***************************************************************************************************** */
                                           /* DUMP USER */ 
/***************************************************************************************************** */

SET NAMES utf8mb4 COLLATE utf8mb4_general_ci;

/** contenu de la table RANK */ 
INSERT INTO `RANK` (`name`,`power`) VALUES 
("SuperAdmin", "0"),
("Admin", "10"),
("Designer", "100"),
("Membres","500");


/** contenu de la table USER */ 
INSERT INTO `USER` (`email` , `username`, `password`, `valid`, `name`, `firstname`,`rank_id`,`connect` ,`num_game_played`, `num_game_win` ) VALUES 
("admin@duelofgiant.fr", "Superman", "azerty", True, "Kent", "Clark", 1, FALSE ,0 ,0 ) ,
("membres1@duelofgiant.fr", "Billy", "azerty", True, "Billy", "Jhones", 4, FALSE ,0 ,0 ),
("membres2@duelofgiant.fr", "Tugudu", "azerty", True, "Tugudu", "Tagada", 4, FALSE ,0 ,0 ) ; 


/***************************************************************************************************** */
                                           /* DUMP HERO */ 
/***************************************************************************************************** */

/** contenu de la table FACTION */ 
INSERT INTO `FACTION` (`name`) VALUES 
("Cuisine"), /**   ID : 1 */ 
("Cinéma"); /**   ID : 2 */ 

/** contenu de la table HERO_MODEL */ 
INSERT INTO `HERO_MODEL` (`name`, `picture`,`pion`, `hp`, `turn`, `swap`, `mana`, `mana_max`, `faction_id` ) VALUES 
("Gordon Ramsay", "./Uploads/heros/cuisine/gordon_grand.png", "./Uploads/heros/cuisine/gordon_pion.png", 20, 0, 0, 1, 1, 1), /** ID : 1 */ 
("Steven Spielberg", "./Uploads/heros/cinema/spielberg_grand.png", "./Uploads/heros/cinema/spielberg_pion.png", 20, 0, 0, 1, 1, 2);/** ID : 2 */ 



/***************************************************************************************************** */
                                           /* DUMP BOARD */ 
/***************************************************************************************************** */
INSERT INTO `BOARD_MODEL` (`url_board`) VALUES 
("./images/board.png");

/***************************************************************************************************** */
                                           /* DUMP CARD_MODEL */ 
/***************************************************************************************************** */
INSERT INTO `TYPE_OF_CARD` (`name`, `url_background_card`,`url_background_pion`) VALUES 
("Créature", "./Uploads/type_cards/back_crea.png", "./Uploads/type_cards/back_crea_pion.png"), /**   ID : 1 */ 
("Sort", "./Uploads/type_cards/back_sort.png", "./Uploads/type_cards/back_crea_pion.png"), /**   ID : 2 */ 
("Spécial", "./Uploads/type_cards/back_special.png", "./Uploads/type_cards/back_special_pion.png"), /**   ID : 3 */ 
("Bouclier", "./Uploads/type_cards/back_bouclier.png", "./Uploads/type_cards/back_bouclier_pion.png"); /**   ID : 4 */ 

INSERT INTO `CARD_MODEL` (`name`, `description`, `background_card`, `picture`, `mana`,`pa`, `hp`, `position`, `quote`, `hero_model_id`,`copy_max`) VALUES 

("Chef Sushi", "", "./Uploads/background/background.png", "./Uploads/cards/cuisine/picture_chef_sushi.png", 7, 8, 6, 0, "La vengeance n'est jamais une ligne droite. C'est un plat qui se mange froid... comme des sushis ?", 1,2), /** ID :1 */ 
("Chef Italien", "", "./Uploads/background/background.png", "./Uploads/cards/cuisine/picture_chef_italien.png", 5, 7, 5, 0, "Son accent est aussi indigeste que ses boulettes.", 1,2), /** ID :2 */ 
("Tomate Tueuses", "", "./Uploads/background/background.png", "./Uploads/cards/cuisine/picture_tomate_tueuse.png", 4, 2, 4, 0, "Si tu me cherches j'envoie la sauce !", 1,2), /** ID :3 */ 
("Anguille Electrique", "", "./Uploads/background/background.png", "./Uploads/cards/cuisine/picture_anguille_electrique.png", 3, 5, 3, 0, "On dirait que le courant passe bien avec elle...", 1,2), /** ID :4 */ 
("Homard et Fraise", "", "./Uploads/background/background.png", "./Uploads/cards/cuisine/picture_homard_fraise.png", 2, 2, 3, 0, "Bah dis donc ! Tu viens plus aux soirées ?", 1,2), /** ID :5 */ 
("Brocoli Masqué", "", "./Uploads/background/background.png", "./Uploads/cards/cuisine/picture_brocoli_masque.png", 1, 2, 1, 0, "Personne ne l'a jamais vu... Personne ne connait son but... Mais tout le monde sait que c'est un brocoli avec un masque !", 1,2), /** ID :6 */ 
("Attaque Wasabi", "", "./Uploads/background/background.png", "./Uploads/cards/cuisine/picture_attaque_wasabie.png", 5, 6, 0, 0, "Cette attaque piquante retire 6 points de vie aux créatures adverses.", 1,1), /** ID :7 */ 
("Intoxication Alimentaire", "", "./Uploads/background/background.png", "./Uploads/cards/cuisine/picture_intox_alimentaire.png", 3, 4, 0, 0, "L'intoxication est lente et destructrice. Des suites d'une diarrhée aigüe, les créatures adverses perdent 4 points de vie.", 1,1), /** ID :8 */ 
("Intolérance au Gluten", "", "./Uploads/background/background.png", "./Uploads/cards/cuisine/picture_into_gluten.png", 1, 1, 0, 0, "Le céréal-killer n'en a pas fini avec votre adversaire ! Une bouchée de plus et les créatures adverses perdent 1 point de vie.", 1,1), /** ID :9 */ 
("Chef Etchebest", "", "./Uploads/background/background.png", "./Uploads/cards/cuisine/picture_etchebest.png", 9, 9, 9, 0, "Bien plus qu'un Chef Etoilé impressionant, c'est aussi un boxeur et un rugbyman dans le sang. ", 1,1), /** ID :10 */ 
("Robot de Cuisine", "", "./Uploads/background/background.png", "./Uploads/cards/cuisine/picture_robot_cuisine.png", 3, 3, 6, 0, "Ces robots enragés prennent les coups à ta place !", 1,2), /** ID :11 */ 
("Smoothie Detox", "", "./Uploads/background/background.png", "./Uploads/cards/cuisine/picture_smoothie_detox.png", 1, 1, 3, 0, "Cette cure d'antioxydants te préservera des attaques ennemies.", 1,2), /** ID :12 */ 
("Indiana Jones", "", "./Uploads/background/background.png", "./Uploads/cards/cinema/picture_indiana_jones.png", 7, 8, 6, 0, "Je suis comme la poisse, j'arrive là où on ne m'attend pas.", 2,2), /** ID :13 */ 
("Dents de la Mer", "", "./Uploads/background/background.png", "./Uploads/cards/cinema/picture_requin_dents_mer.png", 5, 7, 5, 0, "On va avoir besoin d'un plus gros bateau...", 2,2), /** ID : 14*/ 
("Capitaine Crochet", "", "./Uploads/background/background.png", "./Uploads/cards/cinema/picture_capitaine_crochet.png", 4, 2, 4, 0, "Mentir, moi ? Jamais ! La vérité est bien trop amusante !", 2,2), /** ID :15 */ 
("T-rex", "", "./Uploads/background/background.png", "./Uploads/cards/cinema/picture_t-rex.png", 3, 5, 3, 0, "RrrroooooAAAAAAAAArrrrrrrr !", 2,2), /** ID :16 */ 
("Guerre des mondes", "", "./Uploads/background/background.png", "./Uploads/cards/cinema/picture_alien.png", 2, 2, 3, 0, "Ne restez pas là, allez-vous en ! Dégagez le carrefour, allez-vous en !", 2,2), /** ID :17 */ 
("E.T.", "", "./Uploads/background/background.png", "./Uploads/cards/cinema/picture_et.png", 1, 2, 1, 0, "Téléphone Maiiiison !", 2,2), /** ID :18 */ 
("Poltergeist", "", "./Uploads/background/background.png", "./Uploads/cards/cinema/picture_aspiration.png", 5, 6, 0, 0, "Ils sont ici... ils ne te laisseront plus partir. L'étouffement provoquera 6 points de dégats aux créatures adverses.", 2,1), /** ID :19 */ 
("Quatrième dimension", "", "./Uploads/background/background.png", "./Uploads/cards/cinema/picture_envoi_4.png", 3, 4, 0, 0, "Happées dans un univers dimensionnel, il ne reste plus aucune issue pour les créatures adverses qui se retrouvent privées de 4 points de vie.", 2,1), /** ID :20*/ 
("Attaque du Doigt d'E.T.", "", "./Uploads/background/background.png", "./Uploads/cards/cinema/picture_attaque_doigt.png", 1, 1, 0, 0, "E.T. utilise son précieux téléphone pour démolir la maison du joueur adverse et inflige 1 point de dégat.", 2,1), /** ID :21 */ 
("Georges Lucas", "", "./Uploads/background/background.png", "./Uploads/cards/cinema/picture_lucas.png", 9, 9, 9, 0, "La taille importe peu ... Regarde moi : est-ce par la taille que tu peux me juger ? Et bien tu ne le dois pas. ", 2,1), /** ID :22 */ 
("Géant de Fer", "", "./Uploads/background/background.png", "./Uploads/cards/cinema/picture_geant_fer.png", 3, 3, 6, 0, "Redoutable, fort et résolu, contre les mauvais sorts le Géant de Fer te protègera.", 2,2), /** ID :23 */ 
("Voyage dans le Temps", "", "./Uploads/background/background.png", "./Uploads/cards/cinema/picture_voyage_temps.png", 1, 1, 3, 0, "Nom de Zeus Marty ! Monte dans la Delorean pour éviter les attaques !", 2,2); /** ID :24 */ 

INSERT INTO `CORRESPOND` (`card_model_id`, `type_of_card_id` ) VALUES /** Faire pour tout les cartes */ 
(1,1),
(2,1),
(3,1),
(4,1),
(5,1),
(6,1),
(7,2),
(8,2),
(9,2),
(10,3),
(11,4),
(12,4),
(13,1),
(14,1),
(15,1),
(16,1),
(17,1),
(18,1),
(19,2),
(20,2),
(21,2),
(22,3),
(23,4),
(24,4);





/***************************************************************************************************** */
                                           /* DUMP DECK */ 
/***************************************************************************************************** */

INSERT INTO `DECK_MODEL` (`name`,`created_at`) VALUES 
('Cinemas','2018-09-19 23:59:59'),/**   ID : 1 */ 
('Cuisine','2018-09-19 23:59:59');/**   ID : 2 */ 

INSERT INTO `DECK_MODEL_USER` (`deck_model_id`,`user_id`) VALUES 
(1,1),/**   ID : 1 */ 
(2,1),/**   ID : 2 */ 
(1,2),/**   ID : 3 */ 
(2,2),/**   ID : 4 */ 
(1,3),/**   ID : 5 */ 
(2,3);/**   ID : 6 */ 


INSERT INTO `CONSIST_OF` (`card_model_id`, `deck_model_id`,`card_copy`) VALUES 
(1,2,2),
(2,2,2),
(3,2,2),
(4,2,2),
(5,2,2),
(6,2,2),
(7,2,1),
(8,2,1),
(9,2,1),
(10,2,1),
(11,2,1),
(12,2,2),
(13,1,2),
(14,1,2),
(15,1,2),
(16,1,2),
(17,1,2),
(18,1,2),
(19,1,1),
(20,1,1),
(21,1,1),
(22,1,1),
(23,1,2),
(24,1,2);