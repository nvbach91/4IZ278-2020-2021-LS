<?php

class CartController extends BaseController {

    protected $cartMsgs;
    protected $cartProducts;
    protected $cart;

    public function action()
    {
        $this->cartMsgs = array();
        $this->cart = new Cart();

        if (isset($_POST['action']) && isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['action'] == "addToCart") {
            $this->cart->addToCart($_POST['id']);
            $this->cartMsgs[] = array("msg" => "Produkt byl přidán do košíku", "type" => "success");
        } elseif (isset($_POST['action']) && isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['action'] == "removeFromCart") {
            $this->cart->removeFromCart($_POST['id']);
            $this->cartMsgs[] = array("msg" => "Produkt byl z košíku odebrán", "type" => "success");
        }

        $this->cartProducts = $this->cart->getProducts();
    }

    public function getMessages() {
        return $this->cartMsgs;
    }
}

