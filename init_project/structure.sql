--/***************************************************************************************/
-- TABLE RANK
--/***************************************************************************************/
CREATE TABLE IF NOT EXISTS `RANK`(
    `RAN_id` INT(11) NOT NULL AUTO_INCREMENT,
    `RAN_name` VARCHAR(50) NOT NULL,
    `RAN_power` int(4) NOT NULL,
    PRIMARY KEY (`RAN_id`)
)ENGINE=InnoDB CHARSET=utf8mb4;

--/***************************************************************************************/
-- TABLE USER
--/***************************************************************************************/
CREATE TABLE IF NOT EXISTS `USER`(
    `USE_id` INT(11) NOT NULL AUTO_INCREMENT,
    `USE_name` VARCHAR(75) NOT NULL,
    `USE_firstname` VARCHAR(75) NOT NULL,
    `USE_pseudo` VARCHAR(75) NOT NULL,
    `USE_email` VARCHAR(75) NOT NULL,
    `USE_psw` VARCHAR(10) NOT NULL,
    `USE_valid` BOOL NOT NULL DEFAULT 0,
    `USE_connect` BOOL NOT NULL DEFAULT 0 ,
    `USE_NumGamePlayed_player` INT(11) NOT NULL DEFAULT 0,
    `USE_NumGameWin_player` INT(11) NOT NULL DEFAULT 0,
    `USE_rank_fk` INT(11) NOT NULL,
    PRIMARY KEY (`USE_id`),
    CONSTRAINT UC_pseudo UNIQUE(`USE_pseudo`),
    CONSTRAINT UC_email UNIQUE(`USE_email`),
	CONSTRAINT `USE_rank_fk` FOREIGN KEY (`USE_rank_fk`) REFERENCES `RANK`(`RAN_id`) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDB CHARSET=utf8mb4;

--/***************************************************************************************/
-- TABLE FACTION
--/***************************************************************************************/
CREATE TABLE IF NOT EXISTS `FACTION`(
    `FAC_id` INT(11) NOT NULL AUTO_INCREMENT,
    `FAC_name` VARCHAR(50) NOT NULL,
	PRIMARY KEY (`FAC_id`)
)ENGINE=InnoDB CHARSET=utf8mb4;

--/***************************************************************************************/
-- TABLE HERO_MODEL
--/***************************************************************************************/
CREATE TABLE IF NOT EXISTS `HERO_MODEL`(
    `HER_id` INT(11) NOT NULL AUTO_INCREMENT,
    `HER_name` VARCHAR(50) NOT NULL,
    `HER_picture` Text NOT NULL,
    `HER_pion` Text NOT NULL,
    `HER_hp` INT NOT NULL,
    `HER_turn` BOOL NOT NULL DEFAULT 0 ,
    `HER_swap` BOOL NOT NULL DEFAULT 0 ,
    `HER_mana` INT(2) NOT NULL,
    `HER_mana_max` INT(2) NOT NULL,
    `HER_faction_fk` INT(11) NOT NULL,
	PRIMARY KEY (`HER_id`),
	CONSTRAINT `HER_faction_fk` FOREIGN KEY (`HER_faction_fk`) REFERENCES `FACTION`(`FAC_id`) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDB CHARSET=utf8mb4;

--/***************************************************************************************/
-- TABLE CARD_MODEL
--/***************************************************************************************/
CREATE TABLE IF NOT EXISTS `CARD_MODEL`(
    `CAR_id` INT(11) NOT NULL AUTO_INCREMENT,
    `CAR_name` VARCHAR(50) NOT NULL,
    `CAR_description` VARCHAR(256) NOT NULL,
    `CAR_background_card` VARCHAR(256) NOT NULL,
    `CAR_picture`  VARCHAR(256) NOT NULL,
    `CAR_mana` INT(2) NOT NULL,
    `CAR_pa` INT(2) NOT NULL,
    `CAR_hp` INT(2) NOT NULL,
    `CAR_position` TINYINT(1) NOT NULL COMMENT "0 :Deck   1 :Main   2 :Board   3 :Cimetière",
    `CAR_quote` VARCHAR(256) NOT NULL,
    `CAR_hero_model_fk` INT(11) NOT NULL,
    `CAR_copy_max`INT(1) NOT NULL,
	PRIMARY KEY (`CAR_id`),
	CONSTRAINT `CAR_hero_model_fk` FOREIGN KEY (`CAR_hero_model_fk`) REFERENCES `HERO_MODEL`(`HER_id`) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDB CHARSET=utf8mb4;

--/***************************************************************************************/
-- TABLE BOARD_MODEL
--/***************************************************************************************/
CREATE TABLE `BOARD_MODEL`(
    `BOA_id` INT(11) NOT NULL AUTO_INCREMENT,
    `BOA_player_url` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`BOA_id`)
)ENGINE=InnoDB CHARSET=utf8mb4;

--/***************************************************************************************/
-- TABLE TYPE_OF_CARD
--/***************************************************************************************/
CREATE TABLE IF NOT EXISTS `TYPE_OF_CARD`(
    `TYP_card` INT(11) NOT NULL AUTO_INCREMENT,
    `TYP_name` VARCHAR(255) NOT NULL,
    `TYP_url_background_card` VARCHAR(255) NOT NULL,
    `TYP_url_background_pion` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`TYP_card`)
)ENGINE=InnoDB CHARSET=utf8mb4;

--/***************************************************************************************/
-- TABLE HERO_GAME Ou HERO_COPY
--/***************************************************************************************/
CREATE TABLE IF NOT EXISTS  `HERO_GAME`(
    `HEG_player` INT(11) NOT NULL AUTO_INCREMENT,
    `HEG_hp` INT(2) NOT NULL,
    `HEG_mana` INT(2) NOT NULL,
    `HEG_mana_max` INT(2) NOT NULL,
    `HEG_turn` BOOL NOT NULL ,
    `HEG_swap` BOOL NOT NULL ,
    `HEG_num_turn`INT(2) NOT NULL DEFAULT 0, 
    `HEG_copy_hero_player` DATETIME NOT NULL,
    `HEG_hero_model_fk` INT(11) NOT NULL,
	PRIMARY KEY (`HEG_player`),
	CONSTRAINT `HEG_hero_model_fk` FOREIGN KEY (`HEG_hero_model_fk`) REFERENCES `HERO_MODEL`(`HER_id`) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDB CHARSET=utf8mb4;

--/***************************************************************************************/
-- TABLE DECK_MODEL
--/***************************************************************************************/
CREATE TABLE IF NOT EXISTS `DECK_MODEL`(
    `DEC_id` INT(11) NOT NULL AUTO_INCREMENT,
    `DEC_name` VARCHAR(50) NOT NULL,
    `DEC_creation` DATETIME NOT NULL,
    `DEC_user_fk` INT(11) NOT NULL,
	PRIMARY KEY (`DEC_id`),
    CONSTRAINT `DEC_user_fk` FOREIGN KEY (`DEC_user_fk`) REFERENCES `USER`(`USE_id`) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDB CHARSET=utf8mb4;


--/***************************************************************************************/
-- TABLE PLAYER
--/***************************************************************************************/
CREATE TABLE IF NOT EXISTS `PLAYER`(
    `PLA_id` INT(11) NOT NULL AUTO_INCREMENT,
    `PLA_NumGamePlayed` INT(11) NOT NULL,
    `PLA_NumGameWin` INT(11) NOT NULL,
    `PLA_user_id` INT(11) NOT NULL,
    `PLA_deck_model_id` INT(11) NOT NULL,
    `PLA_hero_game_id` INT(11) NULL,
	PRIMARY KEY (`PLA_id`),
	CONSTRAINT `PLA_user_id` FOREIGN KEY (`PLA_user_id`) REFERENCES `USER`(`USE_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT `PLA_deck_model_id` FOREIGN KEY (`PLA_deck_model_id`) REFERENCES `DECK_MODEL`(`DEC_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT `PLA_hero_game_id` FOREIGN KEY (`PLA_hero_game_id`) REFERENCES `HERO_GAME`(`HEG_player`) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDB CHARSET=utf8mb4;

--/***************************************************************************************/
-- TABLE CARD_GAME Ou CARD_COPY
--/***************************************************************************************/
CREATE TABLE IF NOT EXISTS `CARD_GAME`(
    `CAG_id` INT(11) NOT NULL AUTO_INCREMENT,
    `CAG_hp` INT(2) NOT NULL,
    `CAG_pa` INT(2) NOT NULL,
    `CAG_position` TINYINT(1) NOT NULL COMMENT "0 :Deck   1 :Main   2 :Board   3 :Cimetière"  ,
    `CAG_etat` BOOL NOT NULL COMMENT "0 :en sommeil   1 :reveil",
    `CAG_card_player` DATETIME NOT NULL,
    `CAG_card_model_id` INT(11) NOT NULL,
    `CAG_player_id` INT(11) NOT NULL,
    PRIMARY KEY (`CAG_id`),
	CONSTRAINT `CAG_card_model_id` FOREIGN KEY (`CAG_card_model_id`) REFERENCES `CARD_MODEL`(`CAR_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT `CAG_player_id` FOREIGN KEY (`CAG_player_id`) REFERENCES `PLAYER`(`PLA_id`) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDB CHARSET=utf8mb4;

--/***************************************************************************************/
-- TABLE GAME
--/***************************************************************************************/
CREATE TABLE IF NOT EXISTS `GAME`(
    `GAM_id` INT(11) NOT NULL AUTO_INCREMENT,
    `GAM_created_at` DATETIME NOT NULL,
    `GAM_finish_at`   DATETIME DEFAULT NULL,
    `GAM_board_model_id` INT(11) NOT NULL,
    `GAM_player_id` INT(11) NOT NULL,
    `GAM_rejoin_id` INT(11) NOT NULL,
	PRIMARY KEY (`GAM_id`),
	CONSTRAINT `GAM_board_model_id` FOREIGN KEY (`GAM_board_model_id`) REFERENCES `BOARD_MODEL`(`BOA_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT `GAM_player_id` FOREIGN KEY (`GAM_player_id`) REFERENCES `PLAYER`(`PLA_id`) ON UPDATE CASCADE ON DELETE RESTRICT
    CONSTRAINT `GAM_rejoin_id` FOREIGN KEY (`GAM_rejoin_id`) REFERENCES `PLAYER`(`PLA_id`) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDB CHARSET=utf8mb4;

--/***************************************************************************************/
-- TABLE CORRESPOND
--/***************************************************************************************/
CREATE TABLE IF NOT EXISTS `CORRESPOND`(
    `COR_type_of_card_id` INT(11) NOT NULL,
    `COR_card_model_id` INT(11) NOT NULL,
	PRIMARY KEY (`COR_type_of_card_id`,`COR_card_model_id`),
	CONSTRAINT `COR_type__card_id` FOREIGN KEY (`COR_type_of_card_id`) REFERENCES `TYPE_OF_CARD`(`TYP_card`) ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT `COR_cardmodel_id` FOREIGN KEY (`COR_card_model_id`) REFERENCES `CARD_MODEL`(`CAR_id`)  ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDB CHARSET=utf8mb4;


--/***************************************************************************************/
-- TABLE DRAW
--/***************************************************************************************/
CREATE TABLE IF NOT EXISTS `DRAW`(
    `DRA_hero_game_fk` INT(11) NOT NULL,
    `DRA_card_game_fk` INT(11) NOT NULL,
    `PIO_draw_at` DATETIME NOT NULL,
	PRIMARY KEY (`DRA_hero_game_fk`, `DRA_card_game_fk`),
	CONSTRAINT `DRA_hero_game_fk` FOREIGN KEY (`DRA_hero_game_fk`) REFERENCES `HERO_GAME`(`HEG_player`) ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT `DRA_card_game_fk` FOREIGN KEY (`DRA_card_game_fk`) REFERENCES `CARD_GAME`(`CAG_id`) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDB CHARSET=utf8mb4;

--/***************************************************************************************/
-- TABLE CONSIST_OF
--/***************************************************************************************/
CREATE TABLE IF NOT EXISTS `CONSIST_OF`(
    `CON_card_model_fk` INT(11) NOT NULL,
    `CON_deck_model_fk` INT(11) NOT NULL,
    `CON_card_copy`INT(1) NOT NULL,
	PRIMARY KEY (`CON_card_model_fk`, `CON_deck_model_fk`),
	CONSTRAINT `CON_cardmodel_fk` FOREIGN KEY (`CON_card_model_fk`) REFERENCES `CARD_MODEL`(`CAR_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT `CON_deckmodel_fk` FOREIGN KEY (`CON_deck_model_fk`) REFERENCES `DECK_MODEL`(`DEC_id`) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDB CHARSET=utf8mb4;

--/***************************************************************************************/
-- TABLE ATTACK_PV
--/***************************************************************************************/
CREATE TABLE IF NOT EXISTS `ATTACK_HP`(
    `ATT_hero_game_fk` INT(11) NOT NULL,
    `ATT_card_game_fk` INT(11) NOT NULL,
    `ATT_attack_at`   DATETIME NOT NULL ,
    `ATT_damage` INT(11) NOT NULL,
	PRIMARY KEY (`ATT_hero_game_fk`, `ATT_card_game_fk`),
	CONSTRAINT `ATT_herogame_fk` FOREIGN KEY (`ATT_hero_game_fk`) REFERENCES `HERO_GAME`(`HEG_player`) ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT `ATT_cardgame_fk` FOREIGN KEY (`ATT_card_game_fk`) REFERENCES `CARD_GAME`(`CAG_id`) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDB CHARSET=utf8mb4;

--/***************************************************************************************/
-- TABLE ATTACK_CARD
--/***************************************************************************************/
CREATE TABLE `ATTACK_CARD`(
    `ATT_attack_card_fk` INT(11) NOT NULL,
    `ATT_defense_card_fk` INT(11) NOT NULL,
    `ATT_attack_at` DATETIME NOT NULL,
    `ATT_damage` INT(11) NOT NULL,
	PRIMARY KEY (`ATT_attack_card_fk`, `ATT_defense_card_fk`),
	CONSTRAINT `ATT_attackcard_fk` FOREIGN KEY (`ATT_attack_card_fk`) REFERENCES `CARD_GAME`(`CAG_id`) ON UPDATE CASCADE ON DELETE RESTRICT,
	CONSTRAINT `ATT_defensecard_fk` FOREIGN KEY (`ATT_defense_card_fk`) REFERENCES `CARD_GAME`(`CAG_id`) ON UPDATE CASCADE ON DELETE RESTRICT
)ENGINE=InnoDB CHARSET=utf8mb4;

