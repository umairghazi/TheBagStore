CREATE DATABASE  IF NOT EXISTS `ecom` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `ecom`;
-- MySQL dump 10.13  Distrib 5.6.24, for osx10.8 (x86_64)
--
-- Host: 127.0.0.1    Database: ecom
-- ------------------------------------------------------
-- Server version	5.5.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cart` (
  `user_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `quantity` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`prod_id`),
  UNIQUE KEY `user_id` (`user_id`,`prod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (24,2,1);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `prod_id` int(2) NOT NULL AUTO_INCREMENT,
  `prod_quantity` int(2) NOT NULL DEFAULT '0',
  `prod_model` varchar(11) NOT NULL DEFAULT '0',
  `prod_image` varchar(72) NOT NULL DEFAULT 'others/none.jpg',
  `prod_price` decimal(5,2) NOT NULL,
  `prod_discount` double NOT NULL DEFAULT '0',
  `prod_ordered` int(1) NOT NULL DEFAULT '0',
  `prod_name` varchar(52) NOT NULL,
  `prod_description` varchar(1280) NOT NULL DEFAULT '',
  `prod_url` varchar(60) DEFAULT NULL,
  `prod_viewed` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`prod_id`),
  KEY `products_id` (`prod_id`),
  KEY `products_id_2` (`prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'Fossil','img/fossil_bennet_ew_city.jpeg',228.00,20,0,'Bennett EW City','As functional and stylish as your day is long - and somedays that\'s really long - the Bennett is guaranteed to be a new constant companion. Now with richly decorative leather that stands up to travel and inside compartments that make finding what you need a (warm spring) breeze. Get tech smart - this bag is large enough to hold an iPad® 2, 3, 4, iPad® Air, and iPad® Air 2. ','https://www.fossil.com/us/en/search/bennett-ew-city-sku-mbg9',1),(2,6,'Fossil','img/fossil_carson_travel_brief.jpeg',268.00,10,0,'Carson Travel Brief','Fits your paperwork and securely stows your laptop, with a large outside pocket to easy keep your phone, electrical cord (because who doesn\'t hate digging for those) and looks just as good en route as it does in the board (or class)room.\n\nGet tech smart—this bag is large enough to hold laptops up to 15\", Macbook® Pro and similar sized models.','https://www.fossil.com/us/en/men/bags/view-all/carson-travel',0),(3,0,'Fossil','img/fossil_wyatt_work_bag.jpeg',298.00,0,0,'Wyaat Work Bag','A bag that works as hard as you do, and makes it look easy? The Wyatt work bag takes it all in stride with Fossil\'s classic style and functionality around every curve—like deep outside pockets that quickly store essentials when time is of the essence.','https://www.fossil.com/us/en/search/wyatt-work-bag-sku-mbg92',1),(4,0,'Frye','img/frye_oliver_leather_messenger_bag.jpg',578.00,0,0,'\'Oliver\' Leather Messenger Bag','Beautifully tanned and aged with a distinctive vintage patina, this timeless leather messenger bag from Frye holds the character to wow in the office or a business meeting. The flap-top two-compartment design with an exterior slip pocket and under-flap pockets allow for easy organization of paper documents and electronics.\nFlap-top buckle with magnetic-button closure.\nAdjustable shoulder strap.\nInterior organizational wall pockets.\nFully lined.\nLeather.','http://shop.nordstrom.com/s/frye-oliver-leather-messenger-ba',0),(5,20,'Burberry','img/burberry_new_london_leather_messenger_bag.jpg',999.99,30,0,'\'New London\' Leather Messenger Bag','Textured calfskin leather and an understated logo distinguish a handsome, structured messenger bag from Burberry. A sturdy adjustable webbed strap tops the sleek, spacious look.\nHidden magnetic closures.\nAdjustable strap.\nExterior zip pocket.\nInterior zip and wall pockets.\nCheck-print lining.\nCalfskin leather.\nBy Burberry; made in Italy.\nMen\'s Furnishings.','http://shop.nordstrom.com/s/new-london-leather-messenger/421',0),(6,20,'Bosca','img/bosca_stringer_leather_briefcase.jpg',560.00,10,0,'\'Stringer\' Leather Briefcase','Smooth, lustrous leather enriches a compact briefcase made for lightweight convenience and fitted with sleek nickel hardware for a crisp shine.\nTwo-way zip closure.\nTop carry handles; adjustable shoulder strap.\nExterior zip pockets.\nInterior zip and wall pockets.\nLeather.\nBy Bosca; imported.\nMen\'s Furnishings.','http://shop.nordstrom.com/s/old-lthr-stringer-bag/4287900?or',0),(7,20,'Aldo','img/aldo_unelan.jpg',55.00,0,0,'UNELAN','Material: Synthetic\nThis laptop bag is ideal for the busy commuter. It\'s the perfect size and shape for storing both your office/school and leisure essentials. \n- Laptop Bag \n- Flap Closure\n- Decorative buckle \n- Shoulder strap\n- Width: 15.4 in.\n- Depth: 5.6 in.\n- Height: 13.8 in.','http://www.aldoshoes.com/us/en_US/men/bags-%26-wallets/c/250',0),(8,29,'Aldo','img/aldo_windland.jpg',55.00,0,0,'WINDLAND','Material: Synthetic\n- Laptop Bag.\n- Flap Closure. \n- Decorative zipper.\n- Textile lining.\n- Width: 15.4 in.\n- Depth: 5.6 in.\n- Height: 13.8 in.','http://www.aldoshoes.com/us/en_US/men/bags-%26-wallets/c/250',0),(9,20,'Aldo','img/aldo_madill.jpg',60.00,0,0,'MADILL','Material: Synthetic\nDesigned for the man on the move, this slouchy backpack is perfect for every day use.\n- Barrel Bags\n- Decorative buckle\n- Width: 15.4 in.\n- Depth: 0.8 in.\n- Height: 15.8 in.','http://www.aldoshoes.com/us/en_US/men/bags-%26-wallets/c/250',0),(10,20,'Paul Smith','img/paulsmith_mens_black_city_embossed_leather_weekend_bag.jpg',995.00,0,0,'Men\'s Black \'City Embossed\' Leather Weekend Bag','Paul Smith men\'s \'City Embossed\' weekend bag made from black Palmelato embossed Italian calf leather with two carry handles in smooth black calf leather and an Italian-made zip fastening main compartment.\n\nThe Palmelato emboss in the leather replicates the traditional English method of working the leather, rolling wooden rollers over the leather to create the subtle ripple design.\n\nThis weekend bag features a large internal zip fastening pocket with \'Mainline Rainbow Stripe\' print lining and a padded laptop compartment designed for Apple Macbook and Macbook Pro 13\".\n\nFinished with gold hardware, a black Paul Smith dust bag is included.','http://www.paulsmith.co.uk/us-en/shop/mens/accessories/bags/',0),(11,20,'Paul Smith','img/paulsmith_mens_black_leather_city_webbin_holdall.jpg',999.99,0,0,'Men\'s Black Leather \'City Webbing\' Holdall','Paul Smith men\'s black pebble embossed leather \'City Webbing\' holdall with a stud protected base and a Paul Smith signature embossed leather patch on the front.\n\nThis holdall features a large zip fastening main compartment and internally the bag contains a large zip fastening compartment, a slip pocket and a larger padded slip pocket designed to fit the Macbook 13\".',NULL,0),(12,20,'Paul Smith','img/paulsmith_mens_black_leather_city_webbing_business_folio.jpg',895.00,0,0,'Men\'s Black Leather \'City Webbing\' Business Folio','Paul Smith men\'s \'City Webbing\' business folio made from black pebble embossed leather with two handles, a removable adjustable shoulder strap, stud protected base, multi-stripe webbing and a zip fastening compartment.\n\nThis business folio features a concealed external slip pocket, internal slip and zip fastening pockets, a padded laptop compartment designed for Apple Macbook and Macbook Pro 13\" and a Paul Smith signature embossed leather patch.\n\nFinished with Paul Smith signature embossed hardware, a black Paul Smith dust bag is included.',NULL,0),(13,20,'Louis Vuitt','img/lv_porte_documents_voyage_pm.jpg',999.99,0,0,'PORTE-DOCUMENTS VOYAGE PM','The Porte-Documents Voyage PM in Monogram Macassar canvas is a modern take on Louis Vuitton\'s iconic design. Perfect for a businessman looking for a visible and silhouette-oriented bag, it is very functional.','http://us.louisvuitton.com/eng-us/products/porte-documents-v',0),(14,20,'Louis Vuitt','img/lv_christopher_messenger.jpg',999.99,0,0,'CHRISTOPHER MESSENGER','Elegance and practicality are the hallmarks of the Christopher Messenger. Crafted of the historical Damier Graphite canvas, this supple bag gives a touch of coolness to each look and offers a generous inside space. Smart buckles and fittings keep valuable belongings secure.','http://us.louisvuitton.com/eng-us/products/christopher-messe',0);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `userEmail` (`user_email`),
  UNIQUE KEY `user_id_UNIQUE` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (24,'Umair','Ghazi','admin@admin.com','d033e22ae348aeb5660fc2140aec35850c4da997','admin'),(25,'Best','User','user@user.com','12dea96fec20593566ab75692c9949596833adc9','user'),(23,'Umair','Ghazi','umairghazi@gmail.com','7110eda4d09e062aa5e4a390b0a572ac0d2c0220','user');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-16 11:30:55
