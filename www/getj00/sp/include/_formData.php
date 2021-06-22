<?php

// Maybe make a database table with all the codes. May complicate i18n a bit.
$langCodes = [
    'ces','amh','ara','chu','cym','deu','dsb','dut','eng','epo','fas','fin',
    'fra','fry','gla','ell','heb','hrv','hun','hsb','ido','isl','jbo','jpn',
    'kor','lat','mkd','mlt','nav','non','nor','pol','por','roh','ron','rus',
    'san','srp','tlh','slk','slv','spa','swa','swe','tur','tat','ukr','vie',
    'vol','yid','mis','int','zxx'
];
$langNames = [
    'čeština','aramejština','arabština','staroslověnština','welština','němčina',
    'dolnolužická srbština','nizozemština','angličtina','esperanto','perština',
    'finština','francouzština','západofríština','galejština','řečtina',
    'hebrejština','chorvatština','maďarština','hornolužická srbština','ido',
    'islandština','lodžban','japonština','korejština','latina','makedonština',
    'maltština','navažština','staroseverština','norština','polština',
    'portugalština','rétorománština','rumunština','ruština','sanskrt','srbština',
    'klingonština','slovenština','slovinština','španělština','swahilština',
    'švédština','turečtina','tatarština','ukrajinština','vietnamština','volapük',
    'jidiš','*jiný*','*mezinárodní*','*neaplikovatelné*'
];
$ctxCodes = [
    'A','B','C','D','E','F','G','H','I','J','K','L','M',
    'N','O','P','Q','R','S','T','U','V','W','X','Y','Z'
];
$ctxNames = [
    'zkratky','xxx','xxx','indické?','esperantida','xxx','xxx','hashe a CRC',
    'IATA/ICAO kódy','japonské','korejské?','ostatní přejímky','xxx',
    'jména a názvy','onomatopoeia','xxx','telegrafické kódy','solresol',
    'semitské','xxx','uralské?','slovanské','xxx','zkřížené','xxx','xxx'
];
$linkCodes = ['A','S','V'];
$linkNames = ['antonymum','synonymum','varianta'];

// Validation resources
$consRegex = '/^[\'bcdfghj-np-tv-z]{2,8}$/';
$consError = 'Souhlásky se píšou malými nenabodnutými písmeny latinky nebo apostrofem, je jich v kořenu 2 až 8, a nepatří mezi ně: a, e, i, o, u.';

