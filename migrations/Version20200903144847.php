<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200903144847 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bill ADD order_ofit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE bill ADD CONSTRAINT FK_7A2119E3213A98AB FOREIGN KEY (order_ofit_id) REFERENCES `order` (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7A2119E3213A98AB ON bill (order_ofit_id)');
        $this->addSql('ALTER TABLE food ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE food ADD CONSTRAINT FK_D43829F712469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_D43829F712469DE2 ON food (category_id)');
        $this->addSql('ALTER TABLE `order` ADD table_ofit_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398D57370EF FOREIGN KEY (table_ofit_id) REFERENCES `table` (id)');
        $this->addSql('CREATE INDEX IDX_F5299398D57370EF ON `order` (table_ofit_id)');
        $this->addSql('ALTER TABLE order_item ADD parent_order_id INT NOT NULL, ADD food_id INT NOT NULL');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F091252C1E9 FOREIGN KEY (parent_order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE order_item ADD CONSTRAINT FK_52EA1F09BA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id)');
        $this->addSql('CREATE INDEX IDX_52EA1F091252C1E9 ON order_item (parent_order_id)');
        $this->addSql('CREATE INDEX IDX_52EA1F09BA8E87C4 ON order_item (food_id)');
        $this->addSql('ALTER TABLE `table` ADD waiter_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE `table` ADD CONSTRAINT FK_F6298F46E9F3D07E FOREIGN KEY (waiter_id) REFERENCES waiter (id)');
        $this->addSql('CREATE INDEX IDX_F6298F46E9F3D07E ON `table` (waiter_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bill DROP FOREIGN KEY FK_7A2119E3213A98AB');
        $this->addSql('DROP INDEX UNIQ_7A2119E3213A98AB ON bill');
        $this->addSql('ALTER TABLE bill DROP order_ofit_id');
        $this->addSql('ALTER TABLE food DROP FOREIGN KEY FK_D43829F712469DE2');
        $this->addSql('DROP INDEX IDX_D43829F712469DE2 ON food');
        $this->addSql('ALTER TABLE food DROP category_id');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398D57370EF');
        $this->addSql('DROP INDEX IDX_F5299398D57370EF ON `order`');
        $this->addSql('ALTER TABLE `order` DROP table_ofit_id');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F091252C1E9');
        $this->addSql('ALTER TABLE order_item DROP FOREIGN KEY FK_52EA1F09BA8E87C4');
        $this->addSql('DROP INDEX IDX_52EA1F091252C1E9 ON order_item');
        $this->addSql('DROP INDEX IDX_52EA1F09BA8E87C4 ON order_item');
        $this->addSql('ALTER TABLE order_item DROP parent_order_id, DROP food_id');
        $this->addSql('ALTER TABLE `table` DROP FOREIGN KEY FK_F6298F46E9F3D07E');
        $this->addSql('DROP INDEX IDX_F6298F46E9F3D07E ON `table`');
        $this->addSql('ALTER TABLE `table` DROP waiter_id');
    }
}
