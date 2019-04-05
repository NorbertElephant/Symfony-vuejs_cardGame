<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190402083335 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE board_model (id INT AUTO_INCREMENT NOT NULL, url_board LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE card_game (id INT AUTO_INCREMENT NOT NULL, card_model_id INT NOT NULL, player_id INT NOT NULL, hp INT NOT NULL, pa INT NOT NULL, position SMALLINT NOT NULL, etat TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_CF18332EC0447964 (card_model_id), INDEX IDX_CF18332E99E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE card_model (id INT AUTO_INCREMENT NOT NULL, hero_model_id INT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT NOT NULL, background_card LONGTEXT NOT NULL, picture LONGTEXT NOT NULL, mana INT NOT NULL, pa INT NOT NULL, hp INT NOT NULL, position SMALLINT NOT NULL, quote LONGTEXT NOT NULL, copy_max SMALLINT NOT NULL, INDEX IDX_EFA1831FDC6B064F (hero_model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deck_model (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE deck_model_user (deck_model_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_551E078F204204C5 (deck_model_id), INDEX IDX_551E078FA76ED395 (user_id), PRIMARY KEY(deck_model_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE faction (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, board_model_id INT NOT NULL, player_id INT NOT NULL, created_at DATETIME NOT NULL, finish_at DATETIME NOT NULL, INDEX IDX_232B318CE982B45E (board_model_id), UNIQUE INDEX UNIQ_232B318C99E6F5DF (player_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero_game (id INT AUTO_INCREMENT NOT NULL, hero_model_id INT NOT NULL, hp INT NOT NULL, mana INT NOT NULL, mana_max INT NOT NULL, turn TINYINT(1) NOT NULL, swap TINYINT(1) NOT NULL, num_turn INT NOT NULL, copy_hero_player DATETIME NOT NULL, INDEX IDX_A3C053CADC6B064F (hero_model_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero_model (id INT AUTO_INCREMENT NOT NULL, faction_id INT NOT NULL, name VARCHAR(50) NOT NULL, picture LONGTEXT NOT NULL, pion LONGTEXT NOT NULL, hp INT NOT NULL, turn TINYINT(1) NOT NULL, swap TINYINT(1) NOT NULL, mana INT NOT NULL, mana_max INT NOT NULL, INDEX IDX_48AA7D1E4448F8DA (faction_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, deck_model_id INT DEFAULT NULL, hero_game_id INT DEFAULT NULL, num_game_played INT NOT NULL, num_game_win INT NOT NULL, UNIQUE INDEX UNIQ_98197A65A76ED395 (user_id), UNIQUE INDEX UNIQ_98197A65204204C5 (deck_model_id), UNIQUE INDEX UNIQ_98197A65F08B1A22 (hero_game_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rank (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, power INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_of_card (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, url_background_card LONGTEXT NOT NULL, url_background_pion LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE correspond (type_of_card_id INT NOT NULL, card_model_id INT NOT NULL,  INDEX IDX_D7AC8A0BAABABDB4 (type_of_card_id), INDEX IDX_D7AC8A0BC0447964 (card_model_id), PRIMARY KEY(type_of_card_id, card_model_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, rank_id INT NOT NULL, name VARCHAR(75) NOT NULL, firstname VARCHAR(75) NOT NULL, username VARCHAR(75) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, valid TINYINT(1) NOT NULL, connect TINYINT(1) NOT NULL, num_game_played INT NOT NULL, num_game_win INT NOT NULL, INDEX IDX_8D93D6497616678F (rank_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE card_game ADD CONSTRAINT FK_CF18332EC0447964 FOREIGN KEY (card_model_id) REFERENCES card_model (id)');
        $this->addSql('ALTER TABLE card_game ADD CONSTRAINT FK_CF18332E99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE card_model ADD CONSTRAINT FK_EFA1831FDC6B064F FOREIGN KEY (hero_model_id) REFERENCES hero_model (id)');
        $this->addSql('ALTER TABLE deck_model_user ADD CONSTRAINT FK_551E078F204204C5 FOREIGN KEY (deck_model_id) REFERENCES deck_model (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE deck_model_user ADD CONSTRAINT FK_551E078FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CE982B45E FOREIGN KEY (board_model_id) REFERENCES board_model (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C99E6F5DF FOREIGN KEY (player_id) REFERENCES player (id)');
        $this->addSql('ALTER TABLE hero_game ADD CONSTRAINT FK_A3C053CADC6B064F FOREIGN KEY (hero_model_id) REFERENCES hero_model (id)');
        $this->addSql('ALTER TABLE hero_model ADD CONSTRAINT FK_48AA7D1E4448F8DA FOREIGN KEY (faction_id) REFERENCES faction (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65204204C5 FOREIGN KEY (deck_model_id) REFERENCES deck_model (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65F08B1A22 FOREIGN KEY (hero_game_id) REFERENCES hero_game (id)');
        $this->addSql('ALTER TABLE correspond ADD CONSTRAINT FK_D7AC8A0BAABABDB4 FOREIGN KEY (type_of_card_id) REFERENCES type_of_card (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE correspond ADD CONSTRAINT FK_D7AC8A0BC0447964 FOREIGN KEY (card_model_id) REFERENCES card_model (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6497616678F FOREIGN KEY (rank_id) REFERENCES rank (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CE982B45E');
        $this->addSql('ALTER TABLE card_game DROP FOREIGN KEY FK_CF18332EC0447964');
        $this->addSql('ALTER TABLE correspond DROP FOREIGN KEY FK_D7AC8A0BC0447964');
        $this->addSql('ALTER TABLE deck_model_user DROP FOREIGN KEY FK_551E078F204204C5');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65204204C5');
        $this->addSql('ALTER TABLE hero_model DROP FOREIGN KEY FK_48AA7D1E4448F8DA');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65F08B1A22');
        $this->addSql('ALTER TABLE card_model DROP FOREIGN KEY FK_EFA1831FDC6B064F');
        $this->addSql('ALTER TABLE hero_game DROP FOREIGN KEY FK_A3C053CADC6B064F');
        $this->addSql('ALTER TABLE card_game DROP FOREIGN KEY FK_CF18332E99E6F5DF');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C99E6F5DF');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6497616678F');
        $this->addSql('ALTER TABLE correspond DROP FOREIGN KEY FK_D7AC8A0BAABABDB4');
        $this->addSql('ALTER TABLE deck_model_user DROP FOREIGN KEY FK_551E078FA76ED395');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65A76ED395');
        $this->addSql('DROP TABLE board_model');
        $this->addSql('DROP TABLE card_game');
        $this->addSql('DROP TABLE card_model');
        $this->addSql('DROP TABLE deck_model');
        $this->addSql('DROP TABLE deck_model_user');
        $this->addSql('DROP TABLE faction');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE hero_game');
        $this->addSql('DROP TABLE hero_model');
        $this->addSql('DROP TABLE player');
        $this->addSql('DROP TABLE rank');
        $this->addSql('DROP TABLE type_of_card');
        $this->addSql('DROP TABLE correspond');
        $this->addSql('DROP TABLE user');
    }
}
