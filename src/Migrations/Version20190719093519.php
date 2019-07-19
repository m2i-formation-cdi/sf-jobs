<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190719093519 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE applicants (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(80) NOT NULL, resume VARCHAR(80) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE applicant_skill (applicant_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_B3051E7497139001 (applicant_id), INDEX IDX_B3051E745585C142 (skill_id), PRIMARY KEY(applicant_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE jobs (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE job_skill (job_id INT NOT NULL, skill_id INT NOT NULL, INDEX IDX_5F615907BE04EA9 (job_id), INDEX IDX_5F6159075585C142 (skill_id), PRIMARY KEY(job_id, skill_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skills (id INT AUTO_INCREMENT NOT NULL, skill_name VARCHAR(80) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE applicant_skill ADD CONSTRAINT FK_B3051E7497139001 FOREIGN KEY (applicant_id) REFERENCES applicants (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE applicant_skill ADD CONSTRAINT FK_B3051E745585C142 FOREIGN KEY (skill_id) REFERENCES skills (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_skill ADD CONSTRAINT FK_5F615907BE04EA9 FOREIGN KEY (job_id) REFERENCES jobs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE job_skill ADD CONSTRAINT FK_5F6159075585C142 FOREIGN KEY (skill_id) REFERENCES skills (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE applicant_skill DROP FOREIGN KEY FK_B3051E7497139001');
        $this->addSql('ALTER TABLE job_skill DROP FOREIGN KEY FK_5F615907BE04EA9');
        $this->addSql('ALTER TABLE applicant_skill DROP FOREIGN KEY FK_B3051E745585C142');
        $this->addSql('ALTER TABLE job_skill DROP FOREIGN KEY FK_5F6159075585C142');
        $this->addSql('DROP TABLE applicants');
        $this->addSql('DROP TABLE applicant_skill');
        $this->addSql('DROP TABLE jobs');
        $this->addSql('DROP TABLE job_skill');
        $this->addSql('DROP TABLE skills');
    }
}
