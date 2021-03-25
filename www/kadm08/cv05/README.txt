Vytvořte rozhraní DatabaseOperations s operacemi:
- create (Create),
- fetch (Read),
- save (Update),
- delete (Delete), 
jejichž implementace bude spočívat ve vypisování hlášek o vykonaných operací, případně s předanými parametry.

Vytvořte abstraktní třídu Database implementující toto rozhraní
- s výchozími konfiguračním vlastnostmi:
- cesta ke složce databázových souborů
- přípona databázových souborů
- odělovač polí v databázovém souboru
- s magickou metodou
    __construct pro oznámení instancování konkrétní třídy
    __toString pro výpis konfiguračních parametrů

Vytvořte její podtřídy a naimplementujte zmíněné 4 metody ze rozhraní
- pro práci s uživateli UsersDB.
- pro práci produkty ProductsDB.
- pro práci s objednávkami OrdersDB.

V neposlední řadě otestujte vaše implementace vytvářením instancí a voláním jejich metod.