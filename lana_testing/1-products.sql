-- (A) PRODUCTS TABLE
CREATE TABLE `products` (
  `product_id` bigint(20) NOT NULL,
  `product_name` varchar(128) NOT NULL,
  `product_description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_name` (`product_name`);

ALTER TABLE `products`
  MODIFY `product_id` bigint(20) NOT NULL AUTO_INCREMENT;

-- (B) DUMMY PRODUCTS
INSERT INTO `products` (`product_id`, `product_name`, `product_description`) VALUES
  (1, 'Vulture Of Fortune', 'A sweated bump consents across the here separator.'),
  (2, 'Guardian Without Duty', 'Does a table migrate inside an excessive paranoid?'),
  (3, 'Enemies Without Hope', 'A cured parameter fears behind the phenomenon.'),
  (4, 'Lords Of The Void', 'The diary scores around the generalized lie.'),
  (5, 'Doctors And Aliens', 'The diary scores around the generalized lie.'),
  (6, 'Blacksmiths And Criminals', 'A considerable snail works into a purchase.');