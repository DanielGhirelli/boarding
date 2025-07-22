<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200409181654 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE omnifund_applications ADD compliant_pci VARCHAR(1) DEFAULT NULL, ADD pci_cert_number VARCHAR(255) DEFAULT NULL, ADD pci_cert_date DATE DEFAULT NULL, ADD pci_payment_plan VARCHAR(255) DEFAULT NULL, ADD annual_volume NUMERIC(13, 2) DEFAULT NULL, ADD store_cardholder VARCHAR(1) DEFAULT NULL, ADD good_services_on VARCHAR(100) DEFAULT NULL, ADD good_services_delivered VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE omnifund_applications DROP compliant_pci, DROP pci_cert_number, DROP pci_cert_date, DROP pci_payment_plan, DROP annual_volume, DROP store_cardholder, DROP good_services_on, DROP good_services_delivered');
    }
}
