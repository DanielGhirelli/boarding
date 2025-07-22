<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181221161911 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE omnifund_applications_docs ADD CONSTRAINT FK_23084FD03E030ACD FOREIGN KEY (application_id) REFERENCES omnifund_applications (application_id)');
        $this->addSql('CREATE INDEX IDX_23084FD03E030ACD ON omnifund_applications_docs (application_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE omnifund_applications_docs DROP FOREIGN KEY FK_23084FD03E030ACD');
        $this->addSql('DROP INDEX IDX_23084FD03E030ACD ON omnifund_applications_docs');
    }
}
