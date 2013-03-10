ALTER TABLE`#__jb_records` ADD COLUMN `asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `id_record`;
ALTER TABLE`#__jb_badges` ADD COLUMN `asset_id` INT(10) UNSIGNED NOT NULL DEFAULT '0' AFTER `id_badge`;
