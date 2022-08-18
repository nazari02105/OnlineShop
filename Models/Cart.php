<?php

class Cart {
    private $productsArray = array();

    public function addProduct ($product){
        $this->productsArray[] = $product;
    }

    public function getProductArray (){
        return $this->productsArray;
    }

    public function removeFromProductArray ($product){
        $tempArr = array();
        for ($i = 0; $i<count($this->productsArray); $i++){
            if ($this->productsArray[$i] != $product) $tempArr[] = $this->productsArray[$i];
        }
        $this->productsArray = $tempArr;
    }
}