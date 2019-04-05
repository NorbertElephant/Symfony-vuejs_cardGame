<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190402090011 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE attack_card (card_game_source INT NOT NULL, card_game_target INT NOT NULL, attack_at DATETIME NOT NULL, damage INT NOT NULL, INDEX IDX_51A798BBC56B8D21 (card_game_source), INDEX IDX_51A798BBDC8EDDAE (card_game_target), PRIMARY KEY(card_game_source, card_game_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consist_of (card_model_id INT NOT NULL, deck_model_id INT NOT NULL, card_copy INT NOT NULL, INDEX IDX_EC905B23C0447964 (card_model_id), INDEX IDX_EC905B23204204C5 (deck_model_id), PRIMARY KEY(card_model_id, deck_model_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hero_game_card_game (hero_game_id INT NOT NULL, card_game_id INT NOT NULL, INDEX IDX_AA23FF2CF08B1A22 (hero_game_id), INDEX IDX_AA23FF2CB3955373 (card_game_id), PRIMARY KEY(hero_game_id, card_game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attack_hp (hero_game_id INT NOT NULL, card_game_id INT NOT NULL, attack_at DATETIME NOT NULL, damage INT NOT NULL, INDEX IDX_F6F0B265F08B1A22 (hero_game_id), INDEX IDX_F6F0B265B3955373 (card_game_id), PRIMARY KEY(hero_game_id, card_game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attack_card ADD CONSTRAINT FK_51A798BBC56B8D21 FOREIGN KEY (card_game_source) REFERENCES card_game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attack_card ADD CONSTRAINT FK_51A798BBDC8EDDAE FOREIGN KEY (card_game_target) REFERENCES card_game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consist_of ADD CONSTRAINT FK_EC905B23C0447964 FOREIGN KEY (card_model_id) REFERENCES card_model (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE consist_of ADD CONSTRAINT FK_EC905B23204204C5 FOREIGN KEY (deck_model_id) REFERENCES deck_model (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hero_game_card_game ADD CONSTRAINT FK_AA23FF2CF08B1A22 FOREIGN KEY (hero_game_id) REFERENCES hero_game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hero_game_card_game ADD CONSTRAINT FK_AA23FF2CB3955373 FOREIGN KEY (card_game_id) REFERENCES card_game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attack_hp ADD CONSTRAINT FK_F6F0B265F08B1A22 FOREIGN KEY (hero_game_id) REFERENCES hero_game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE attack_hp ADD CONSTRAINT FK_F6F0B265B3955373 FOREIGN KEY (card_game_id) REFERENCES card_game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE game ADD rejoin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CA0E87628 FOREIGN KEY (rejoin_id) REFERENCES player (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_232B318CA0E87628 ON game (rejoin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE attack_card');
        $this->addSql('DROP TABLE consist_of');
        $this->addSql('DROP TABLE hero_game_card_game');
        $this->addSql('DROP TABLE attack_hp');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CA0E87628');
        $this->addSql('DROP INDEX UNIQ_232B318CA0E87628 ON game');
        $this->addSql('ALTER TABLE game DROP rejoin_id');
    }
}
