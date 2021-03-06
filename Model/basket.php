<?php

class basket
{
    var $products;

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
        if(isset($this->products[$idProduct]))
        {
            $this->products[$idProduct] =  $this->products[$idProduct] + $quantity;
            return NO_PROBLEM;
        }
        else
        {
            $this->products[$idProduct] = $quantity;
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
        if(isset($this->products[$idProduct]))
        {
            if($this->products[$idProduct] < $quantity)
            {
                return BAD_QUANTITY;
            }
            else
            {
                if(($this->products[$idProduct] - $quantity) < 1)
                {
                    unset($this->products[$idProduct]);
                }
                else
                {
                    $this->products[$idProduct] =  $this->products[$idProduct] - $quantity;
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
     * delete a product on a basket
     * @param $idProduct -> id product
     * @param $quantity -> quantity
     * @return int -> Error code
     */
    public function deleteAllQuantityOfProduct($idProduct)
    {
        if(isset($this->products[$idProduct]))
        {
            unset($this->products[$idProduct]);
            return NO_PROBLEM;
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
        return $this->products;
    }

    /**
     * Send the session basket to the database
     * @param $bdd -> Database
     * @param $user -> Username
     */
    public function sendToBDD($user)
    {
        $database = new bdd();
        $database->deleteBasket($user);
        foreach($this->products as $id => $quantity)
        {
            for($i=0; $i<$quantity; $i++)
                $database->insertBasket($user, $id);
        }
    }
}