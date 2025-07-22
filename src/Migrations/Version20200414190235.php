<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200414190235 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE omnifund_applications ADD refund_policy VARCHAR(50) DEFAULT NULL, ADD refund_policy_other VARCHAR(50) DEFAULT NULL, ADD location_type VARCHAR(50) DEFAULT NULL, ADD tx_at_restaurant INT DEFAULT NULL, ADD tx_at_internet INT DEFAULT NULL, ADD fulfillment_contact VARCHAR(100) DEFAULT NULL, ADD fulfillment_pci VARCHAR(1) DEFAULT NULL, ADD fulfillment_percent INT DEFAULT NULL, ADD active_months VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE omnifund_applications DROP refund_policy, DROP refund_policy_other, DROP location_type, DROP tx_at_restaurant, DROP tx_at_internet, DROP fulfillment_contact, DROP fulfillment_pci, DROP fulfillment_percent, DROP active_months');
    }
}
