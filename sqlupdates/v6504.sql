ALTER TABLE `orders` ADD COLUMN `shipping` INT DEFAULT NULL AFTER `shipping_address`;

COMMIT;