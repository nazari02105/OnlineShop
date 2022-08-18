<?php
include_once("Cart.php");

class User {
    private $username;
    private $password;
    private $products;
    private $numbers;
    private $cart;

    public function __construct ($username, $password){
        $this->username = $username;
        $this->password = $password;
        $cart = new Cart();
    }

    public function getUsername (){
        return $this->username;
    }

    public function getPassword (){
        return $this->password;
    }

    public function getProducts (){
        return $this->products;
    }

    public function getNumbers (){
        return $this->numbers;
    }

    public function setUsername ($username) {
        $this->username = $username;
    }

    public function setPassword ($password) {
        $this->password = $password;
    }

    public function setProducts ($products) {
        $this->products = $products;
    }

    public function setNumbers ($numbers) {
        $this->numbers = $numbers;
    }

    public function getCart (){
        return $this->cart;
    }
}