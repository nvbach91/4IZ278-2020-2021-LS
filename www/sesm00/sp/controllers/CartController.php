<?php

class CartController extends BaseController {

    protected $cartMsgs;
    protected $cartProducts;
    protected $cart;

    public function action()
    {
        $this->cart = new Cart();

        if (isset($_POST['action']) && isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['action'] == "addToCart") {
            $this->cart->addToCart($_POST['id']);
            array_push($this->cartMsgs, "Produkt byl přidán do košíku");
        } elseif (isset($_POST['action']) && isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['action'] == "removeFromCart") {
            $this->cart->removeFromCart($_POST['id']);
            array_push($this->cartMsgs, "Produkt byl z košíku odebrán");
        }

        $this->cartProducts = $this->cart->getProducts();
    }
}

