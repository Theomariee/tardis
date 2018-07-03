<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180703221039 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('INSERT INTO type_cc (libelle) VALUES(\'CC1\')');
        $this->addSql('INSERT INTO type_cc (libelle) VALUES(\'CC2\')');
        $this->addSql('INSERT INTO type_cc (libelle) VALUES(\'CC3\')');
        $this->addSql('INSERT INTO type_cc (libelle) VALUES(\'CC4\')');
        $this->addSql('INSERT INTO type_cc (libelle) VALUES(\'CCTP1\')');
        $this->addSql('INSERT INTO type_cc (libelle) VALUES(\'CCTP2\')');
        $this->addSql('INSERT INTO type_cc (libelle) VALUES(\'CCTP3\')');
        $this->addSql('INSERT INTO type_cc (libelle) VALUES(\'CCTP4\')');
        $this->addSql('INSERT INTO type_cc (libelle) VALUES(\'PROJET\')');
    }

    public function down(Schema $schema) : void
    {
    }
}
