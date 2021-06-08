<?php


class OrderController extends BaseController
{
    public $cart;
    public $states;
    public $errors;
    public $dataSent;

    public function action()
    {
        if (!User::isUserLoggedIn()) {
            header('Location: ' . getBaseUrl());
            die();
        }

        session_start();

        $this->cart = new Cart();

        if (count($this->cart->getProducts()) < 1) {
            header('Location: ' . getBaseUrl());
            die();
        }

        $this->errors = array();

        $this->dataSent = false;

        $fields = array(
            'firstname',
            'lastname',
            'street',
            'city',
            'zip',
            'phone',
            'fields',
            'deliveryType',
            'paymentMethod'
        );

        $allFieldsSet = true;

        foreach ($fields as $field) {
            if (!isset($_POST[$field])) {
                $allFieldsSet = false;
                echo $field;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->dataSent = true;
            if ($allFieldsSet) {
                if ($_POST['deliveryType'] != 1 && $_POST['deliveryType'] != 2) {
                    $_POST['deliveryType'] = 1;
                }

                if ($_POST['paymentMethod'] != 1 && $_POST['paymentMethod'] != 2) {
                    $_POST['paymentMethod'] = 1;
                }

                $address = new Address(-1, $_POST['firstname'], $_POST['lastname'], $_POST['street'], $_POST['city'], $_POST['zip'], $_POST['phone'], User::getCurrentUserId());
                $addressResult = $address->validate();
                $valid = $addressResult['success'];
                $addressExists = $address->existsAsAnotherId();
                if ($addressExists !== false) {
                    $address = Address::getInstance($addressExists);
                }

                if (!isset($_POST['agreeWithTerms']) || $_POST['agreeWithTerms'] != "on") {
                    $valid = false;
                    $this->errors[] = "Je třeba zaškrtnout souhlas s podmínkami";
                }

                if (!$addressResult['success']) {
                    $this->errors[] = $addressResult['msg'];
                }

                if ($valid) {
                    $fieldsValid = OrderProduct::validateProductsAndFields($this->cart->getProducts(), $_POST['fields']);
                    if ($fieldsValid['success']) {
                        if ($address->getId() == -1) {
                            $address->create();
                        }
                        $order = new Order(-1, $this->cart->getCartTotal(), User::getCurrentUserId(), $address->getId(), $_POST['paymentMethod'], $_POST['deliveryType']);
                        $order->create();
                        OrderProduct::createByCartProducts($this->cart->getProducts(), $_POST['fields'], $order->getId());
                        $this->cart->clear();

                        $currUser = User::getInstance(User::getCurrentUserId());
                        $currUser->load();

                        $mailContent = "Dobrý den,\npod Vaším účtem právě došlo k vytvoření objednávky číslo " . $order->getId() . "\n\n";
                        $mailContent .= "Následuje seznam produktů:\n";


                        foreach (OrderProduct::getProductsByOrderId($order->getId()) as $product) {
                            $baseProduct = $product->getBaseProduct();
                            $mailContent .= "&nbsp;&nbsp;" . htmlspecialchars($baseProduct->name) . "&nbsp;&nbsp;&nbsp;" . $product->quantity . "x&nbsp;&nbsp;&nbsp;" .
                                formatPrice($product->unit_price * $product->quantity) . " " . CURRENCY . "\n";
                        }

                        $mailContent .= "Celková částka objednávky je " . formatPrice($order->total) . " " . CURRENCY . "\n\n";

                        $mailContent .= "S pozdravem eshop Česká dálnice CZ";

                        try {
                            mail($currUser->email, "Vytvoření objednávky na eshopu Česká dálnice", $mailContent);
                        } catch (Exception $e) {}

                    } else {
                        $valid = false;
                        $this->errors[] = $fieldsValid['msg'];
                    }
                }

                if ($valid) {
                    header('Location: ' . "payment?order=" . $order->getId());
                    die();
                }
            } else if (!isset($_POST['action'])) {
                $this->errors[] = "Systém neobdržel všechna vyžadovaná pole";
            }
        }

        $this->states = State::getAll();

        MediaManager::addJavascript(MediaManager::SCRIPT_URL . "order.js", "1.0");

    }
}