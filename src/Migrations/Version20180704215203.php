<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180704215203 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('ALTER SEQUENCE evenement_id_seq INCREMENT BY 1');
        $this->addSql('CREATE TABLE etudiant (id SERIAL NOT NULL, numero_etudiant VARCHAR(8) NOT NULL, activer_notifications BOOLEAN NOT NULL, adresse_mail VARCHAR(127) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE etudiant_filiere (etudiant_id INT NOT NULL, filiere_id INT NOT NULL, PRIMARY KEY(etudiant_id, filiere_id))');
        $this->addSql('CREATE INDEX IDX_FA7F131ADDEAB1A3 ON etudiant_filiere (etudiant_id)');
        $this->addSql('CREATE INDEX IDX_FA7F131A180AA129 ON etudiant_filiere (filiere_id)');
        $this->addSql('CREATE TABLE evenement (id INT NOT NULL, matiere_id INT NOT NULL, type_cc_id INT NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, commentaire VARCHAR(512) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B26681EF46CD258 ON evenement (matiere_id)');
        $this->addSql('CREATE INDEX IDX_B26681EA62F39B8 ON evenement (type_cc_id)');
        $this->addSql('CREATE TABLE filiere (id SERIAL NOT NULL, code VARCHAR(15) NOT NULL, nom_complet VARCHAR(127) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE matiere (id SERIAL NOT NULL, semestre_id INT NOT NULL, code VARCHAR(15) NOT NULL, nom_complet VARCHAR(127) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_9014574A5577AFDB ON matiere (semestre_id)');
        $this->addSql('CREATE TABLE matiere_filiere (matiere_id INT NOT NULL, filiere_id INT NOT NULL, PRIMARY KEY(matiere_id, filiere_id))');
        $this->addSql('CREATE INDEX IDX_4DF6D262F46CD258 ON matiere_filiere (matiere_id)');
        $this->addSql('CREATE INDEX IDX_4DF6D262180AA129 ON matiere_filiere (filiere_id)');
        $this->addSql('CREATE TABLE note (id SERIAL NOT NULL, matiere_id INT NOT NULL, etudiant_id INT NOT NULL, type_cc_id INT NOT NULL, note DOUBLE PRECISION NOT NULL, date_publication TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CFBDFA14F46CD258 ON note (matiere_id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA14DDEAB1A3 ON note (etudiant_id)');
        $this->addSql('CREATE INDEX IDX_CFBDFA14A62F39B8 ON note (type_cc_id)');
        $this->addSql('CREATE TABLE semestre (id SERIAL NOT NULL, numero_semestre INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type_cc (id SERIAL NOT NULL, libelle VARCHAR(15) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE etudiant_filiere ADD CONSTRAINT FK_FA7F131ADDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE etudiant_filiere ADD CONSTRAINT FK_FA7F131A180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EF46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EA62F39B8 FOREIGN KEY (type_cc_id) REFERENCES type_cc (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE matiere ADD CONSTRAINT FK_9014574A5577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE matiere_filiere ADD CONSTRAINT FK_4DF6D262F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE matiere_filiere ADD CONSTRAINT FK_4DF6D262180AA129 FOREIGN KEY (filiere_id) REFERENCES filiere (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14F46CD258 FOREIGN KEY (matiere_id) REFERENCES matiere (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14DDEAB1A3 FOREIGN KEY (etudiant_id) REFERENCES etudiant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14A62F39B8 FOREIGN KEY (type_cc_id) REFERENCES type_cc (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE etudiant_filiere DROP CONSTRAINT FK_FA7F131ADDEAB1A3');
        $this->addSql('ALTER TABLE note DROP CONSTRAINT FK_CFBDFA14DDEAB1A3');
        $this->addSql('ALTER TABLE etudiant_filiere DROP CONSTRAINT FK_FA7F131A180AA129');
        $this->addSql('ALTER TABLE matiere_filiere DROP CONSTRAINT FK_4DF6D262180AA129');
        $this->addSql('ALTER TABLE evenement DROP CONSTRAINT FK_B26681EF46CD258');
        $this->addSql('ALTER TABLE matiere_filiere DROP CONSTRAINT FK_4DF6D262F46CD258');
        $this->addSql('ALTER TABLE note DROP CONSTRAINT FK_CFBDFA14F46CD258');
        $this->addSql('ALTER TABLE matiere DROP CONSTRAINT FK_9014574A5577AFDB');
        $this->addSql('ALTER TABLE evenement DROP CONSTRAINT FK_B26681EA62F39B8');
        $this->addSql('ALTER TABLE note DROP CONSTRAINT FK_CFBDFA14A62F39B8');
        $this->addSql('ALTER SEQUENCE evenement_id_seq INCREMENT BY 1');
        $this->addSql('DROP TABLE etudiant');
        $this->addSql('DROP TABLE etudiant_filiere');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE filiere');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE matiere_filiere');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE semestre');
        $this->addSql('DROP TABLE type_cc');
    }
}
