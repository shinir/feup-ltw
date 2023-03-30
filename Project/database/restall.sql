.mode columns
.headers on

drop table if exists User;
drop table if exists Dish;
drop table if exists Restaurant;
drop table if exists Review;
drop table if exists Request;
drop table if exists FavoriteRestaurant;
drop table if exists FavoriteDish;

create table User(

    idUser INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    userName TEXT UNIQUE NOT NULL,
    password TEXT NOT NULL,
    address TEXT NOT NULL,
    email TEXT NOT NULL,
    phoneNumber TEXT UNIQUE NOT NULL,
    photo TEXT NOT NULL,
    option TEXT
);

create table Dish(

    idDish INTEGER PRIMARY KEY,
    name TEXT NOT NULL,
    price REAL NOT NULL,
    photo TEXT NOT NULL,
    descrip TEXT,
    category TEXT NOT NULL,
    restaurant INT REFERENCES Restaurant ON DELETE CASCADE ON UPDATE CASCADE
);

create table Restaurant(

    idRestaurant INTEGER PRIMARY KEY,
    name TEXT UNIQUE NOT NULL,
    address TEXT NOT NULL,
    photo TEXT NOT NULL,
    category TEXT NOT NULL,
    idOwner INT REFERENCES User ON DELETE CASCADE ON UPDATE CASCADE

);

create table Review(

    idReview INTEGER PRIMARY KEY,
    grade INT NOT NULL,
    date TEXT NOT NULL,
    user INT REFERENCES User ON DELETE CASCADE ON UPDATE CASCADE,
    restaurant INT REFERENCES Restaurant ON DELETE CASCADE ON UPDATE CASCADE
);

create table Request(

    idorder INT NOT NULL,
    price REAL NOT NULL,
    quantity INT NOT NULL,
    date TEXT NOT NULL,
    state TEXT NOT NULL,
    user INT REFERENCES User ON DELETE CASCADE ON UPDATE CASCADE,
    restaurant INT REFERENCES Restaurant ON DELETE CASCADE ON UPDATE CASCADE,
    dish INT REFERENCES Dish ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(user, restaurant, dish, idorder)
);

create table FavoriteRestaurant(

    user INT REFERENCES User ON DELETE CASCADE ON UPDATE CASCADE,
    restaurant INT REFERENCES Restaurant ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(user, restaurant)
);

create table FavoriteDish(

    user INT REFERENCES User ON DELETE CASCADE ON UPDATE CASCADE,
    dish INT REFERENCES Dish ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(user, dish)
);

PRAGMA foreign_keys = ON;


/* users */

insert into User values (
    1,
    "Tester",
    "tester",
    "$2y$10$Hv9n9MkalbLeGyFVqKpsDem9wUvn6RqYJYIKcj8Gy4oDpA60DdElK",
    "feup",
    "tester@gmail.com",
    "935768549",
    "/../photos/user/default.jpg",
    "tester"
    
);
/*restaurant*/

insert into Restaurant values(

    1,
    "Pizzaplex",
    "Rua de Santo Antonio",
    "/../photos/restaurant/default.jpg",
    "Italian",
    1
);

insert into Restaurant values(

    2,
    "Sushi place",
    "Rua de Santa Catarina",
    "/../photos/restaurant/default.jpg",
    "Japanese",
    1
);

insert into Restaurant values(

    3,
    "100 Montaditos",
    "Rua de S. João",
    "/../photos/restaurant/default.jpg",
    "Traditional",
    1
);
insert into Restaurant values(

    4,
    "Star bucks",
    "Rua das Estrelas",
    "/../photos/restaurant/starbucks.jpg",
    "Modern",
    1
);
insert into Restaurant values(

    5,
    "Hamburgueria",
    "Rua das Estrelas",
    "/../photos/restaurant/hamburgueria.jpg",
    "Hamburguers",
    1
);
insert into Restaurant values(

    6,
    "Lapa maki",
    "Rua da lapa",
    "/../photos/restaurant/lapamaki.jpg",
    "Japanese",
    1
);
/* pratos */
insert into Dish values(

    1,
    "Limonada",
    3.00,
    "/../photos/dish/limonada.jpg",
    "Refrescante",
    "Bebida",
    4
);
insert into Dish values(

    2,
    "Fruit Punch",
    15.50,
    "/../photos/dish/fruitpunch.jpg",
    "Suave",
    "Bebida",
    4
);
insert into Dish values(

    3,
    "Big boy",
    7.86,
    "/../photos/dish/hamburguer2.jpg",
    "Extremamente delicioso",
    "Hamburguer",
    5
);
insert into Dish values(

    4,
    "Menu big burguer",
    14.21,
    "/../photos/dish/hamburguer.jpg",
    "Acompanhado de batatas",
    "Hamburguer",
    5
);
insert into Dish values(

    5,
    "Lasanha dupla",
    10.30,
    "/../photos/dish/lasanha2.jpg",
    "So para os mais corajosos",
    "Lasanha",
    3
);
insert into Dish values(

    6,
    "Lasanha simples",
    6.70,
    "/../photos/dish/default.jpg",
    "Especialidade",
    "Lasanha",
    3
);
insert into Dish values(

    7,
    "Pizza",
    12.30,
    "/../photos/dish/pizza.jpg",
    "Com bacon e cogumelos",
    "Pizza",
    1
);
insert into Dish values(

    8,
    "Sushi maki",
    11.00,
    "/../photos/dish/sushi.jpg",
    "Melhor sushi de portugal",
    "Sushi",
    6
);
insert into Dish values(

    9,
    "Sushi tun",
    10.30,
    "/../photos/dish/sushi2.jpg",
    "Best sushi",
    "Sushi",
    6
);
insert into Dish values(

    10,
    "Sushi teko",
    13.00,
    "/../photos/dish/sushi.jpg",
    "Just sushi",
    "Sushi",
    2
);

/* review */ 

insert into Review values(
    1,
    4,
    "13-02-2021",
    1,
    1
);