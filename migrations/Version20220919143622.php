<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220919143622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE class_name (id INT AUTO_INCREMENT NOT NULL, level_id INT NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_EA5E49495FB14BA7 (level_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_type (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT AUTO_INCREMENT NOT NULL, level_id INT NOT NULL, class_name_id INT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, gender VARCHAR(10) NOT NULL, birth_date DATE NOT NULL, birth_place VARCHAR(50) NOT NULL, address VARCHAR(255) NOT NULL, INDEX IDX_B723AF335FB14BA7 (level_id), INDEX IDX_B723AF33B462FB2A (class_name_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student_tutor (student_id INT NOT NULL, tutor_id INT NOT NULL, INDEX IDX_11303FD5CB944F1A (student_id), INDEX IDX_11303FD5208F64F1 (tutor_id), PRIMARY KEY(student_id, tutor_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tutor (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(50) NOT NULL, last_name VARCHAR(50) NOT NULL, telephone INT NOT NULL, email VARCHAR(100) NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE class_name ADD CONSTRAINT FK_EA5E49495FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF335FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id)');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33B462FB2A FOREIGN KEY (class_name_id) REFERENCES class_name (id)');
        $this->addSql('ALTER TABLE student_tutor ADD CONSTRAINT FK_11303FD5CB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE student_tutor ADD CONSTRAINT FK_11303FD5208F64F1 FOREIGN KEY (tutor_id) REFERENCES tutor (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE class_name DROP FOREIGN KEY FK_EA5E49495FB14BA7');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF335FB14BA7');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33B462FB2A');
        $this->addSql('ALTER TABLE student_tutor DROP FOREIGN KEY FK_11303FD5CB944F1A');
        $this->addSql('ALTER TABLE student_tutor DROP FOREIGN KEY FK_11303FD5208F64F1');
        $this->addSql('DROP TABLE class_name');
        $this->addSql('DROP TABLE level');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE payment_type');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE student_tutor');
        $this->addSql('DROP TABLE tutor');
    }
}
