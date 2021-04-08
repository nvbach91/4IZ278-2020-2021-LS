DROP TABLE if exists products;
DROP TABLE if exists categories;
DROP TABLE if exists slides;
-- create product table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY ,
    name VARCHAR(255) NOT NULL ,
    price DOUBLE NOT NULL ,
    img TEXT NOT NULL
);
-- Insert data
INSERT INTO `products` (`name`, `price`, `img`) VALUES
('NATURE BOX Avocado', '109', 'https://www.hitgo.cz/cloud/vvvvv/n/nature-box-avocado-oil-shampoo-385-ml-sampony-a-kondicionery-174244.jpg'),
('Gliss kur oil', '85', 'https://pampik.com/uploads/product/middle/20210115/l6rIc8YX.jpg'),
('Head and Shoulders Classic Clean', '68', 'https://images-na.ssl-images-amazon.com/images/I/71FMlrA8TiL._SL1500_.jpg'),
('Tresemme Botanique', '150', 'https://fair.ua/image/cache/catalog/photo_prod/11012353/0_tresemme-botanique-nourish-replenish-650-1200x1200.jpg'),
('Syoss Full Hair 5', '120', 'https://im9.cz/iR/importprodukt-orig/7ea/7ea16591f20660b9ca8b31cd45144756--mmf250x250.jpg'),
('Dove Hair Therapy', '90', 'https://cdn1.ozone.ru/s3/multimedia-w/6019506632.jpg'),
('Pantene Smooth&Sleek', '100', 'https://www.savers.co.uk/medias/sys_master/front-zoom/front-zoom/h71/h87/9041113415710/PANTENE-SPOO-SMOOTH-SLEEK-360ML-779037.jpg'),
('Kérastase Blond Absolu', '360', 'https://www.bezvavlasy.cz/images/sklady/ku_rastase_blond_absolu_ultra_violet_y_ampon.jpg');


-- create product table
CREATE TABLE categories (
                        category_id INT AUTO_INCREMENT PRIMARY KEY ,
                        number DOUBLE NOT NULL ,
                        name VARCHAR(255) NOT NULL
);
-- Insert data
INSERT INTO `categories` (`number`, `name`) VALUES
(1 , 'Сheap shampoos' ),
(2 , 'Medium-priced shampoos' ),
(3 , 'Expensive shampoos' );


CREATE TABLE slides (
                          slide_id INT AUTO_INCREMENT PRIMARY KEY ,
                          img TEXT NOT NULL,
                          title VARCHAR(255) NOT NULL
);

INSERT INTO `slides` ( `img`, `title`) VALUES
('https://digitalcontent.api.tesco.com/v2/media/ghs/ec3a5bbb-b523-4513-ac3f-99c235b0dab6/snapshotimagehandler_221932841.jpeg?h=540&w=540' , 'AUSSIE MOIST' ),
('https://www.bezvavlasy.cz/images/sklady/colour_goddess_shampoo.jpg' , 'Bed Head TIGI' ),
('https://www.maquibeauty.com/images/productos/garnier-champu-fructis-hair-food-papaya-pelo-danado-1-51468.jpeg' , 'GARNIER FRUCTIS Papaya' );