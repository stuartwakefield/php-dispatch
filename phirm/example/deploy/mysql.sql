CREATE TABLE `products` (
	`product_id` BIGINT NOT NULL auto_increment KEY,
	`product_name` VARCHAR(255) NOT NULL,
	`product_description` LONGTEXT,
	`product_price` DECIMAL(8, 2) NOT NULL
);

CREATE TABLE `product_options` (
	`product_option_id` BIGINT NOT NULL auto_increment KEY,
	`product_option_name` VARCHAR(255),
	`product_option_multiple` TINYINT(1) DEFAULT 0,
	`product` BIGINT NOT NULL
		REFERENCES `products` (`product_id`)
			ON DELETE CASCADE
			ON UPDATE CASCADE
);

CREATE TABLE `product_option_values` (
	`product_option_value_id` BIGINT NOT NULL auto_increment KEY,
	`product_option_value_name` VARCHAR(255) NOT NULL,
	`product_option_value_price` DECIMAL(8, 2),
	`product_option` BIGINT NOT NULL
		REFERENCES `products_options` (`product_option_id`)
			ON DELETE CASCADE
			ON UPDATE CASCADE
);

CREATE TABLE `product_pictures` (
	`product_picture_id` BIGINT NOT NULL auto_increment KEY,
	`product_picture_caption` TEXT,
	`product_picture_alt` VARCHAR(255),
	`product` BIGINT NOT NULL
		REFERENCES `products` (`product_id`)
			ON DELETE CASCADE
			ON UPDATE CASCADE
);

INSERT INTO `products` (`product_name`, `product_description`, `product_price`)
	VALUES ('T-Shirt', 'Some description', 9.99);

INSERT INTO `product_options` (`product_option_name`, `product_option_multiple`, `product`)
	VALUES 
		('Size', 0, 1), 
		('Shape', 1, 1);

INSERT INTO `product_option_values` (`product_option_value_name`, `product_option_value_price`, `product_option`)
	VALUES 
		('Small', 0.00, 1),
		('Medium', 0.00, 1),
		('Large', 0.00, 1),
		('Long sleeve', 5.00, 2),
		('V-neck', 2.00, 2);
		
INSERT INTO `product_pictures` (`product_picture_caption`, `product_picture_alt`, `product`)
	VALUES 
		('Front of the t-shirt', 'Front of the t-shirt', 1), 
		('Back of the t-shirt', 'Back of the t-shirt', 1);

CREATE TABLE `baskets` (
	`basket_id`
		BIGINT NOT NULL auto_increment KEY
);

CREATE TABLE `basket_items` (
	`basket_item_id` 
		BIGINT NOT NULL auto_increment KEY,
	`basket` 
		BIGINT NOT NULL 
		REFERENCES `baskets` (`basket_id`)
			ON DELETE CASCADE
			ON UPDATE CASCADE
);