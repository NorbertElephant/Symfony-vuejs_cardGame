<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190402092040 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE draw (hero_game_id INT NOT NULL, card_game_id INT NOT NULL, draw_at DATETIME NOT NULL, INDEX IDX_70F2BD0FF08B1A22 (hero_game_id), INDEX IDX_70F2BD0FB3955373 (card_game_id), PRIMARY KEY(hero_game_id, card_game_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE draw ADD CONSTRAINT FK_70F2BD0FF08B1A22 FOREIGN KEY (hero_game_id) REFERENCES hero_game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE draw ADD CONSTRAINT FK_70F2BD0FB3955373 FOREIGN KEY (card_game_id) REFERENCES card_game (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE hero_game_card_game');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE hero_game_card_game (hero_game_id INT NOT NULL, card_game_id INT NOT NULL, draw_at DATETIME NOT NULL, INDEX IDX_AA23FF2CF08B1A22 (hero_game_id), INDEX IDX_AA23FF2CB3955373 (card_game_id), PRIMARY KEY(hero_game_id, card_game_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE hero_game_card_game ADD CONSTRAINT FK_AA23FF2CB3955373 FOREIGN KEY (card_game_id) REFERENCES card_game (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hero_game_card_game ADD CONSTRAINT FK_AA23FF2CF08B1A22 FOREIGN KEY (hero_game_id) REFERENCES hero_game (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE draw');
    }
}
