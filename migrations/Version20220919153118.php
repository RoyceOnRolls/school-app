<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220919153118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment ADD payment_type_id INT NOT NULL, ADD student_id INT NOT NULL, ADD tutor_id INT NOT NULL, ADD amount DOUBLE PRECISION NOT NULL, ADD month VARCHAR(50) NOT NULL, ADD description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DDC058279 FOREIGN KEY (payment_type_id) REFERENCES payment_type (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DCB944F1A FOREIGN KEY (student_id) REFERENCES student (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D208F64F1 FOREIGN KEY (tutor_id) REFERENCES tutor (id)');
        $this->addSql('CREATE INDEX IDX_6D28840DDC058279 ON payment (payment_type_id)');
        $this->addSql('CREATE INDEX IDX_6D28840DCB944F1A ON payment (student_id)');
        $this->addSql('CREATE INDEX IDX_6D28840D208F64F1 ON payment (tutor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DDC058279');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DCB944F1A');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D208F64F1');
        $this->addSql('DROP INDEX IDX_6D28840DDC058279 ON payment');
        $this->addSql('DROP INDEX IDX_6D28840DCB944F1A ON payment');
        $this->addSql('DROP INDEX IDX_6D28840D208F64F1 ON payment');
        $this->addSql('ALTER TABLE payment DROP payment_type_id, DROP student_id, DROP tutor_id, DROP amount, DROP month, DROP description');
    }
}
