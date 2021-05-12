/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     29/04/2021 16:48:57                          */
/*==============================================================*/


drop table if exists Address;

drop table if exists Category;

drop table if exists `Order`;

drop table if exists OrderItem;

drop table if exists OrderPerson;

drop table if exists PersonAddress;

drop table if exists Product;

drop table if exists Tag;

drop table if exists `User`;

drop table if exists product_tags;

/*==============================================================*/
/* Table: Address                                               */
/*==============================================================*/
create table Address
(
   AddressID            int not null,
   AddressStreet        varchar(255) not null,
   AddressCity          varchar(255) not null,
   AddressPostCode      varchar(255) not null,
   AddressCountry       varchar(255) not null,
   primary key (AddressID)
);

/*==============================================================*/
/* Table: Category                                              */
/*==============================================================*/
create table Category
(
   CategoryID           int not null,
   CategoryName         varchar(255) not null,
   CategoryDescription  text not null,
   CategoryImgPath      varchar(255) not null,
   primary key (CategoryID)
);

/*==============================================================*/
/* Table: `Order`                                               */
/*==============================================================*/
create table `Order`
(
   OrderID              int not null,
   OrderPersonID        int not null,
   OrderDate            datetime not null,
   primary key (OrderID)
);

/*==============================================================*/
/* Table: OrderItem                                             */
/*==============================================================*/
create table OrderItem
(
   ProductID            int not null,
   OrderID              int not null,
   OrderItemQuantity    int not null,
   primary key (ProductID, OrderID)
);

/*==============================================================*/
/* Table: OrderPerson                                           */
/*==============================================================*/
create table OrderPerson
(
   OrderPersonID        int not null,
   OrderPersonEmail     varchar(255) not null,
   OrderPersonFirstname varchar(30) not null,
   OrderPersonLastname  varchar(30) not null,
   primary key (OrderPersonID)
);

/*==============================================================*/
/* Table: PersonAddress                                         */
/*==============================================================*/
create table PersonAddress
(
   OrderPersonID        int not null,
   AddressID            int not null,
   primary key (OrderPersonID, AddressID)
);

/*==============================================================*/
/* Table: Product                                               */
/*==============================================================*/
create table Product
(
   ProductID            int not null,
   CategoryID           int not null,
   ProductName          varchar(255) not null,
   ProductDescription   text not null,
   ProductPrice         int not null,
   ProductImgPath       varchar(255) not null,
   primary key (ProductID)
);

/*==============================================================*/
/* Table: Tag                                                   */
/*==============================================================*/
create table Tag
(
   TagID                int not null,
   TagName              varchar(255) not null,
   primary key (TagID)
);

/*==============================================================*/
/* Table: User                                                  */
/*==============================================================*/
create table `User`
(
   OrderPersonID        int not null,
   UserID               int not null,
   OrderPersonEmail     varchar(255) not null,
   OrderPersonFirstname varchar(30) not null,
   OrderPersonLastname  varchar(30) not null,
   UserPassword         varchar(255) not null,
   UserRole             varchar(255) not null,
   primary key (OrderPersonID, UserID)
);

/*==============================================================*/
/* Table: "product tags"                                        */
/*==============================================================*/
create table product_tags
(
   TagID                int not null,
   ProductID            int not null,
   primary key (TagID, ProductID)
);

alter table `Order` add constraint FK_person_places_order foreign key (OrderPersonID)
      references OrderPerson (OrderPersonID) on delete restrict on update restrict;

alter table OrderItem add constraint FK_OrderItem foreign key (ProductID)
      references Product (ProductID) on delete restrict on update restrict;

alter table OrderItem add constraint FK_OrderItem2 foreign key (OrderID)
      references `Order` (OrderID) on delete restrict on update restrict;

alter table PersonAddress add constraint FK_PersonAddress foreign key (OrderPersonID)
      references OrderPerson (OrderPersonID) on delete restrict on update restrict;

alter table PersonAddress add constraint FK_PersonAddress2 foreign key (AddressID)
      references Address (AddressID) on delete restrict on update restrict;

alter table Product add constraint FK_product_category foreign key (CategoryID)
      references Category (CategoryID) on delete restrict on update restrict;

alter table `User` add constraint FK_Inheritance foreign key (OrderPersonID)
      references OrderPerson (OrderPersonID) on delete restrict on update restrict;

alter table product_tags add constraint FK_product_tags foreign key (TagID)
      references Tag (TagID) on delete restrict on update restrict;

alter table product_tags add constraint FK_product_tags2 foreign key (ProductID)
      references Product (ProductID) on delete restrict on update restrict;

