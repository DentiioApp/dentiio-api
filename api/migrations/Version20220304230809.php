<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220304230809 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avatar CHANGE top_type top_type VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE accessories_type accessories_type VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE hair_color hair_color VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE facial_hair_type facial_hair_type VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE facial_hair_color facial_hair_color VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE clothe_type clothe_type VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE clothe_color clothe_color VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE eye_type eye_type VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE eyebrow_type eyebrow_type VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mouth_type mouth_type VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE skin_color skin_color VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE categorie_pathologie CHANGE name name VARCHAR(45) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE clinical_case CHANGE presentation presentation LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE treatment_plan treatment_plan LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE observation observation LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE evolution evolution LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE conclusion conclusion LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE slug slug VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reason_consult reason_consult VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE scanner scanner VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE biopsy biopsy VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE diagnostic diagnostic VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE clinical_case_omnipratique CHANGE title title VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE exam_description exam_description LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE pathologie pathologie LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE treatment_description treatment_description LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE commentaire CHANGE comment comment LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE image_clinical_case CHANGE path path VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE image_clinical_case_type CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE img_clinical_case_omnipratique CHANGE type type VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE path path VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image64 image64 LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE jobs CHANGE name name VARCHAR(30) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE ident ident VARCHAR(3) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE keyword CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE message_notification CHANGE message message VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE pathologie CHANGE name name VARCHAR(45) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE patient CHANGE gender gender VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE problem_health problem_health LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE in_treatment in_treatment LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE reason_consult reason_consult LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE allergie allergie LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE speciality CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE symptome CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE treatment CHANGE name name VARCHAR(45) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nom nom VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE pseudo pseudo VARCHAR(191) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE licence_doc licence_doc VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image64 image64 LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
