<?php

class basket
{
    var $product;

    /**
     * basket constructor.
     */
    public function __construct()
    {
    }

    /**
     * add a product to basket
     * @param $idProduct -> id product
     * @param $quantity -> quantity
     * @return int -> Error code
     */
    public function addProduct($idProduct, $quantity)
    {
        if($quantity < 0)
        {
            return BAD_QUANTITY;
        }
        if(isset($this->product[$idProduct]))
        {
            $this->product[$idProduct] =  $this->product[$idProduct] + $quantity;
            return NO_PROBLEM;
        }
        else
        {
            $this->product[$idProduct] = $quantity;
        }
        return NO_PROBLEM;
    }

    /**
     * delete a product on a basket
     * @param $idProduct -> id product
     * @param $quantity -> quantity
     * @return int -> Error code
     */
    public function deleteProduct($idProduct, $quantity)
    {
        if(isset($this->product[$idProduct]))
        {
            if($this->product[$idProduct] < $quantity)
            {
                return BAD_QUANTITY;
            }
            else
            {
                if(($this->product[$idProduct] - $quantity) < 1)
                {
                    unset($this->product[$idProduct]);
                }
                else
                {
                    $this->product[$idProduct] =  $this->product[$idProduct] - $quantity;
                }
                return NO_PROBLEM;
            }
        }
        else
        {
            return NO_FOUND;
        }
    }

    /**
     * get all the basket
     * @return array
     */
    public function getProducts()
    {
        return $this->product;
    }



}