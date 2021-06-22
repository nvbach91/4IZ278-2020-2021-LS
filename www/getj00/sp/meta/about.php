<?php include '../include/_header.php'; ?>

<h1>O GeSeLu a GeSeLátoru</h1>

<p>Toto není vyčerpávající přehled, jen pro ukázku.</p>

<p>
GeSeL nebo také G3S3L znamená <b>G</b>etman's <b>G</b>eneric <b>G</b>enuinely 
<b>S</b>illy <b>S</b>tupid <b>S</b>emitic <b>L</b>anguage, a jak je z názvu 
poznat, jedná se o umělý jazyk se semitskou morfologií inspirovanou esperantem.
Nicméně syntax je jakýsi ad-hoc hybrid mezi němčinou a japonštinou. GeSeL vznikl
z lenosti a nedostatku času se učit arabsky a japonsky najednou. Později se však
ukázalo, že lze přirozeněji použít ke gramatické vokalizaci zkratek. Není vhodný
na psaní básniček, protože rýmy jsou převážně gramatické. Tento nedostatek
vyřeší budoucí umělý jazyk Hashtalk.
</p>

<h2>Abeceda a výslovnost</h2>
<p>
GeSeL se zapisuje běžně latinkou s apostrofem. Dostupná jsou však i mapování na
jiná písma pro snažší použitelnost lidmi různých jazyků, případně na 
cizojazyčných systémech.
</p>
<pre>
' a b c d e f g h i j k l m n o p q r s t u v w x y z
</pre>
<p>
Výslovnost písmen ', C, G, H, J, X závisí na konkrétním jazyce původu.
' - 3ayn v arabských kořenech, glotální zastavení jindy
C - v arabských kořenech Þ nebo Đ, v japonských Ts, může také spodobit na Dz
G - v arabských kořenech ghayn neboli francouzské R, v ostatních G
H - sjednocuje H, Ch i *dýchání na brýle*
J - většinou Č nebo Dž, ale může zmutovat v Sz a Ż/Rz
Q - Qáf, ve starých verzích i oba 3ayny a Ch
R - čte se jako německé hrdelní, a to i v japonských slovech
X - většinou Š, ale může spodobit na Ž
</p>
<p>
Samohlásky A a I alternují do souhlásky Y, a samohlásky O a U alternují do 
souhlásky W. E se považuje za nulovou samohlásku a ' za nulovou souhlásku.
Slabiky mají omezenou složitost na CSVSC a uplatňuje se zde míra sonority souhlásek.
Nic proti tomu, jestli umíte vyslovit změti souhlásek v nepřehozené podobě.
</p>

<h2>Morfologie</h2>
<p>
Všechna delší slova podléhají monolitickému kořenovému systému. Kořen tvoří 3
vokalizační clustery souhlásek, zatímco odvozování se děje pomocí vkládání
samohlásek, občas i připojování přípon.
</p>

TODO hromada tabulek

<h3>Podstatná jména</h3>
<p>
Zde je patrný vliv esperanta a latiny.
Chybí lokál, protože došly samohlásky a navíc GeSeL nemá předložky. Místo toho
má založky s nominativem s patrným vlivem japonštiny a finštiny. Jediná předpona
je mu-, beze studu převzatá z arabštiny. Kvůli omezeným schopnostem programování
musí všechny prefixy mít souhlásku U, nebo být odděleny spojovíkem.
</p>

<h3>Přídavná jména</h3>
<p>
Skloňuje se až podstatné jméno, ke kterému se vážou.
Stupňování: *a*a*o -> a**a* -> al a**a* / ijiban *a*a*o
</p>

<h3>Zájmena</h3>
<p>
Zde je patrný vliv slovanských jazyků.<br>

ana ini ono unu<br>
ani ini oni uni<br>

Existují zde zvratná zájmena sa a si, která se připojují za vyčasované sloveso, jedná-li se o prostý pasiv (gamalon la tabara sa), a před něj, jedná-li se o zájmeno se (gamal si yasama).<br>

Místo rodu dle pohlaví je zde neživotný a životný, přičemž životnost se určuje
podle schopnosti používat jazyk. Nemá vliv na deklinaci. Zde je patrný vliv klingonšiny.<br>

Skloňování momentálně koliduje s monolitickým kořenovým systémem pro 2souhláskové kořeny.<br>

ana anayn anawn anwon ane anan / ana anin anun anon ane anan<br>
ani aniyn aniwn anyon ane anyan<br>

Návrh (destabilizační, ale vypadá slibně, rezerva na duál s W místo Y):<br>
an  in  on  un  -> ayn  iyn  oyn  uyn<br>
  i   i   i   i       i    i    i    i<br>
  u   u   u   u       u    u    u    u<br>
  o   o   o   o       o    o    o    o<br>
  e   e   e   e       e    e    e    e<br>
  a   a   a   a       a    a    a    a<br>

Nebo taky vykrást arabštinu důkladněji nebo obnovit 1.2b slovanskou variatnu aya iti ono uzu imi ivi ini izi.


</p>

<h3>Číslovky</h3>
<p>
Je asi 10 způsobů, jak vyjádřit číselnou hodnotu. Stále dekadická soustava, hodila by se hexadecimální.
</p>

<h3>Slovesa</h3>
<p>
</p>

<h3>Příslovce</h3>
<p>
Stupňování: *a*i*o -> a**i* -> al a**i* / ijiban *a*i*o
</p>

<h2>Syntax</h2>

<h3>Založky</h3>
<p>
</p>

<h3>Logika</h3>
<p>
Ne - la, a - wa, nebo - wo.
Konstrukt "A => B" se vyjádří jako "¬A \/ B", tedy "la A wo B". Negace toho je A /\ ¬B, tedy "A wa la B".
Konstrukt "A <=> B" by se vyjádřil jako "(¬A \/ B) /\ (A \/ ¬B)", tedy "la A wo B, wa A wo la B", ale naštěstí je poskytkuta spojka "xwa" jakožto XAND (také známé jako XNOR).
Konstrukt "A (+) B" by se vyjádřil jako "(¬A /\ B) \/ (A /\ ¬B)", tedy "la A wa B, wo A wa la B", ale naštěstí je poskytkuta spojka "xwo" jakožto XOR.
Další spojky jsou lwa pro NAND a lwo pro NOR. Kvantifikátory jsou iksi pro existuje, igzi pro existuje jediný a fori pro každý. Symboly modality jsou muc pro musí a may pro může.
</p>

<h3>Skládání slov</h3>
<p>
Funguje jako v Sanskrtu pod německým vlivem. Doporučuje se používat spojovníky.
</p>

<h3>Slovosled</h3>
<p>
Z hlediska procházení stromu se u oznamovacích vět jedná o post-order, tedy SOV.
U tázacích vět se uplatňuje pre-order, tedy VSO.
Rozkazovací věty používají in-order, tedy SVO.
Předmět následuje vždy až po podmětu, což je důležité při ignoraci pádů.
</p>

<h3>Reference</h3>
<p>
</p>

<h2>Popis databáze</h2>
<p>
V rámci 1 soupravy lze mít 441 2písmenných kořenů, přes 9k 3písmenných, a téměř 200k 4písmenných.
Speciálních slov lze mít několik tisíc.
VstupSlovniku, Antosynonymum a Pouziti jsou propojovací tabulky, ta 1. dokonce M:N:P.
Koren je centrální tabulkou, mazání odkud proto kaskáduje.

</p>


<?php include '../include/_footer.php'; ?>
