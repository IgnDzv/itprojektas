<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201104203700 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skelbimas ADD vartotojas_id INT NOT NULL');
        $this->addSql('ALTER TABLE skelbimas ADD CONSTRAINT FK_54274587C4F787EE FOREIGN KEY (vartotojas_id) REFERENCES vartotojas (id)');
        $this->addSql('CREATE INDEX IDX_54274587C4F787EE ON skelbimas (vartotojas_id)');
        $this->addSql('ALTER TABLE vartotojas CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
        $this->addSql('ALTER TABLE zinute ADD skelbimas_id INT NOT NULL');
        $this->addSql('ALTER TABLE zinute ADD CONSTRAINT FK_70119996AA3FC64A FOREIGN KEY (skelbimas_id) REFERENCES skelbimas (id)');
        $this->addSql('CREATE INDEX IDX_70119996AA3FC64A ON zinute (skelbimas_id)');
        $password = '$argon2id$v=19$m=65536,t=4,p=1$U3gyRkZOWkJTV3lTbzNMQQ$/OUgyS0CdSM+3i5rpVJvG4zrWy5dj6K0034CWyHcak4';
        $this->addSQL("INSERT INTO vartotojas (`slapyvardis`, `roles`, `password`) VALUES ('admin', '[\"ROLE_ADMIN\"]', '$password')");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skelbimas DROP FOREIGN KEY FK_54274587C4F787EE');
        $this->addSql('DROP INDEX IDX_54274587C4F787EE ON skelbimas');
        $this->addSql('ALTER TABLE skelbimas DROP vartotojas_id');
        $this->addSql('ALTER TABLE vartotojas CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
        $this->addSql('ALTER TABLE zinute DROP FOREIGN KEY FK_70119996AA3FC64A');
        $this->addSql('DROP INDEX IDX_70119996AA3FC64A ON zinute');
        $this->addSql('ALTER TABLE zinute DROP skelbimas_id');
    }
}
