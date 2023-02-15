ALTER TABLE `orders` ADD COLUMN `discount` INT DEFAULT 0 AFTER `grand_total`;
ALTER TABLE `orders` ADD COLUMN `advanced` INT DEFAULT 0 AFTER `discount`;

COMMIT;