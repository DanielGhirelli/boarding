<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181107203753 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE omnifund_applications (application_id INT AUTO_INCREMENT NOT NULL, application_hash VARCHAR(32) NOT NULL, business_contact_first VARCHAR(50) DEFAULT NULL, business_contact_last VARCHAR(50) DEFAULT NULL, business_name VARCHAR(100) DEFAULT NULL, business_address1 VARCHAR(150) DEFAULT NULL, business_city VARCHAR(50) DEFAULT NULL, business_state VARCHAR(20) DEFAULT NULL, business_zip VARCHAR(10) DEFAULT NULL, business_phone VARCHAR(14) DEFAULT NULL, business_email VARCHAR(150) DEFAULT NULL, business_taxid VARCHAR(20) DEFAULT NULL, business_dba VARCHAR(100) DEFAULT NULL, business_dba_address1 VARCHAR(150) DEFAULT NULL, business_dba_city VARCHAR(50) DEFAULT NULL, business_dba_state VARCHAR(20) DEFAULT NULL, business_dba_zip VARCHAR(10) DEFAULT NULL, business_dba_phone VARCHAR(14) DEFAULT NULL, business_fax VARCHAR(14) DEFAULT NULL, business_num_locations VARCHAR(5) DEFAULT NULL, business_website VARCHAR(100) DEFAULT NULL, ownership_type VARCHAR(30) DEFAULT NULL, business_open_date DATE DEFAULT NULL, currently_processing_cc VARCHAR(1) DEFAULT NULL, swipe_f2f_percent INT DEFAULT NULL, swipe_moto_percent INT DEFAULT NULL, swipe_internet_percent INT DEFAULT NULL, tx_at_store INT DEFAULT NULL, tx_at_residence INT DEFAULT NULL, tx_at_warehouse INT DEFAULT NULL, tx_at_mobile INT DEFAULT NULL, owner_first VARCHAR(50) DEFAULT NULL, owner_last VARCHAR(50) DEFAULT NULL, owner_dob DATE DEFAULT NULL, owner_percent INT DEFAULT NULL, owner_dl VARCHAR(20) DEFAULT NULL, owner_dl_state VARCHAR(20) DEFAULT NULL, owner_ssn VARCHAR(11) DEFAULT NULL, owner_address1 VARCHAR(150) DEFAULT NULL, owner_city VARCHAR(50) DEFAULT NULL, owner_state VARCHAR(20) DEFAULT NULL, owner_zip VARCHAR(10) DEFAULT NULL, owner_phone VARCHAR(14) DEFAULT NULL, owner_email VARCHAR(255) DEFAULT NULL, owner_lessthan_51pct VARCHAR(1) DEFAULT NULL, owner2_first VARCHAR(50) DEFAULT NULL, owner2_last VARCHAR(50) DEFAULT NULL, owner2_dob DATE DEFAULT NULL, owner2_percent INT DEFAULT NULL, owner2_dl VARCHAR(20) DEFAULT NULL, owner2_dl_state VARCHAR(20) DEFAULT NULL, owner2_ssn VARCHAR(11) DEFAULT NULL, owner2_address1 VARCHAR(150) DEFAULT NULL, owner2_city VARCHAR(50) DEFAULT NULL, owner2_state VARCHAR(20) DEFAULT NULL, owner2_zip VARCHAR(10) DEFAULT NULL, owner2_phone VARCHAR(14) DEFAULT NULL, owner2_email VARCHAR(255) DEFAULT NULL, bank_name_on_account VARCHAR(50) DEFAULT NULL, bank_name VARCHAR(50) DEFAULT NULL, bank_phone VARCHAR(14) DEFAULT NULL, bank_city VARCHAR(50) DEFAULT NULL, bank_state VARCHAR(20) DEFAULT NULL, bank_routing VARCHAR(20) DEFAULT NULL, bank_account VARCHAR(20) DEFAULT NULL, avg_monthly_volume NUMERIC(13, 2) DEFAULT NULL, high_monthly_volume NUMERIC(13, 2) DEFAULT NULL, avg_ticket NUMERIC(13, 2) DEFAULT NULL, high_ticket NUMERIC(13, 2) DEFAULT NULL, business_description VARCHAR(500) DEFAULT NULL, accept_advance VARCHAR(1) DEFAULT NULL, advance_deposits TINYINT(1) NOT NULL, advance_payment TINYINT(1) NOT NULL, advance_membership TINYINT(1) NOT NULL, advance_avg_deposits INT DEFAULT NULL, advance_days_deposit_paid INT DEFAULT NULL, advance_avg_service INT DEFAULT NULL, advance_pct_volume INT DEFAULT NULL, seasonal VARCHAR(1) DEFAULT NULL, months_open VARCHAR(100) DEFAULT NULL, months_closed VARCHAR(100) DEFAULT NULL, fulfillment_performed_by VARCHAR(100) DEFAULT NULL, fulfillment_vendor VARCHAR(100) DEFAULT NULL, accept_amex VARCHAR(1) DEFAULT NULL, amex_number VARCHAR(30) DEFAULT NULL, amex_cap VARCHAR(30) DEFAULT NULL, amex_volume NUMERIC(13, 2) DEFAULT NULL, amex_avg_ticket NUMERIC(13, 2) DEFAULT NULL, accept_ach VARCHAR(1) DEFAULT NULL, debit_max_single_amount NUMERIC(13, 2) DEFAULT NULL, debit_max_daily_amount NUMERIC(13, 2) DEFAULT NULL, debit_max_daily_count INT DEFAULT NULL, debit_max_amount_14days NUMERIC(13, 2) DEFAULT NULL, debit_max_count_14days INT DEFAULT NULL, credit_max_single_amount NUMERIC(13, 2) DEFAULT NULL, credit_max_daily_amount NUMERIC(13, 2) DEFAULT NULL, credit_max_daily_count INT DEFAULT NULL, credit_max_amount_14days NUMERIC(13, 2) DEFAULT NULL, credit_max_count_14days INT DEFAULT NULL, sectype_ppd TINYINT(1) NOT NULL, sectype_ccd TINYINT(1) NOT NULL, sectype_tel TINYINT(1) NOT NULL, sectype_web TINYINT(1) NOT NULL, sectype_pop TINYINT(1) NOT NULL, sectype_check21 TINYINT(1) NOT NULL, iso_id VARCHAR(50) DEFAULT NULL, created_at DATETIME NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', PRIMARY KEY(application_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE omnifund_applications');
    }
}
