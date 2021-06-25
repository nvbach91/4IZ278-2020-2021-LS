<?php

$LIQUOR_CATEGORY_CHOICE_RUM = 10;
$LIQUOR_CATEGORY_CHOICE_VODKA = 20;
$LIQUOR_CATEGORY_CHOICE_DISTILLATES = 30;


$ADDRESS_COUNTRY_CHOICE_SLOVAK_REPUBLIC = 10;
$ADDRESS_COUNTRY_CHOICE_CZECH_REPUBLIC = 20;

$ORDER_STATE_CHOICE_NEW = 10;
$ORDER_STATE_CHOICE_PENDING = 20;
$ORDER_STATE_CHOICE_FINISHED = 30;

$USER_ROLE_CHOICE_BASIC_USER = 10;
$USER_ROLE_CHOICE_ADMIN = 20;

return [
    'choices' => compact([
            'LIQUOR_CATEGORY_CHOICE_RUM',
            'LIQUOR_CATEGORY_CHOICE_VODKA',
            'LIQUOR_CATEGORY_CHOICE_DISTILLATES',
            'ADDRESS_COUNTRY_CHOICE_SLOVAK_REPUBLIC',
            'ADDRESS_COUNTRY_CHOICE_CZECH_REPUBLIC',
            'ORDER_STATE_CHOICE_NEW',
            'ORDER_STATE_CHOICE_PENDING',
            'ORDER_STATE_CHOICE_FINISHED',
            'USER_ROLE_CHOICE_BASIC_USER',
            'USER_ROLE_CHOICE_ADMIN',
        ]
    ),

    # translate
    'categories' => [
        $LIQUOR_CATEGORY_CHOICE_RUM => "Rum",
        $LIQUOR_CATEGORY_CHOICE_VODKA => "Vodka",
        $LIQUOR_CATEGORY_CHOICE_DISTILLATES => "Destiláty",
    ],
    'countries' => [
        $ADDRESS_COUNTRY_CHOICE_SLOVAK_REPUBLIC => 'Slovenská republika',
        $ADDRESS_COUNTRY_CHOICE_CZECH_REPUBLIC => 'Česká republika',
    ],
    'order_states' => [
        $ORDER_STATE_CHOICE_NEW => "Nová",
        $ORDER_STATE_CHOICE_PENDING => "Prebieha",
        $ORDER_STATE_CHOICE_FINISHED =>  "Dokončená",
    ],

];