<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201201192020 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE zinute ADD vartotojas_id INT NOT NULL');
        $this->addSql('ALTER TABLE zinute ADD CONSTRAINT FK_70119996C4F787EE FOREIGN KEY (vartotojas_id) REFERENCES vartotojas (id)');
        $this->addSql('CREATE INDEX IDX_70119996C4F787EE ON zinute (vartotojas_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE zinute DROP FOREIGN KEY FK_70119996C4F787EE');
        $this->addSql('DROP INDEX IDX_70119996C4F787EE ON zinute');
        $this->addSql('ALTER TABLE zinute DROP vartotojas_id');
    }
}
