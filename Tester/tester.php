<?php

/**
 * Created by PhpStorm.
 * User: skiiro
 * Date: 03/11/16
 * Time: 11:21
 */

include './../Model/bdd.php';


class testerBdd
{
    /**
     * This function test all crud fonction for the user in the database
     */
    static function testerUserBdd()
    {
        $bdd = new bdd();
        echo "I will create the user userTest".PHP_EOL;
        $return = $bdd->createUser("userTest", "azerty", "Surname", "Name", "address", "Name.Surname@imerir.com");
        echo "I will see the users in the database".PHP_EOL;
        $return = $bdd->getUsers();
        foreach($return as $value)
        {
            var_dump($value);
        }
        echo "I will update the user with nickname userTest with Leila Garcia which living in 2 rue de villeroge in Perpignan".PHP_EOL;
        $return = $bdd->updateUser("Leila", "Garcia", "2 rue de villeroge 66100 PERPIGNAN", "leilagarcia@orange.fr", "userTest");
        echo "Check if the user userTest has been modify".PHP_EOL;
        $return = $bdd->getUsers();
        foreach($return as $value)
        {
            var_dump($value);
        }
        echo "I will delete userTest".PHP_EOL;
        $return = $bdd->deleteUser("userTest");
        echo "Check if the userTest has been deleted".PHP_EOL;
        $return = $bdd->getUsers();
        foreach($return as $value)
        {
            var_dump($value);
        }
    }

    /**
     * This function test to modify the password and get it
     */
    static function testPasswordBdd()
    {
        $bdd = new bdd();
        echo "I will create the user userTest with 'azerty' password".PHP_EOL;
        $return = $bdd->createUser("userTest", "azerty", "Surname", "Name", "address", "Name.Surname@imerir.com");
        echo "Let see if the user has been created".PHP_EOL;
        $return = $bdd->getUser("userTest");
        foreach($return as $value)
        {
            var_dump($value);
        }
        echo "Check his password".PHP_EOL;
        $return = $bdd->getPassword("userTest");
        foreach($return as $value)
        {
            var_dump($value);
        }
        echo "Now we change the password to 'ytreza'".PHP_EOL;
        $return = $bdd->setPassword("userTest", "ytreza");
        echo "let see if the password has been changed".PHP_EOL;
        $return = $bdd->getPassword("userTest");
        foreach($return as $value)
        {
            var_dump($value);
        }
        echo "I will delete userTest for a future test".PHP_EOL;
        $return = $bdd->deleteUser("userTest");
        echo "Check if userTest has been deleted".PHP_EOL;
        $return = $bdd->getUser("userTest");
        foreach($return as $value)
        {
            var_dump($value);
        }
    }

    /**
     * This function test all category products functions from BDD
     */
    static function testerCategoryProduct()
    {
        $bdd = new bdd();
        $id = null;
        echo "I will create a category of object : Test".PHP_EOL;
        $return = $bdd->createCategoryProduct("Test");
        echo "Let see if the category has been created".PHP_EOL;
        $return = $bdd->getCategoryProducts();
        foreach($return as $value)
        {
            var_dump($value);
            if($value['Nom'] == "Test")
                $id = $value['Id'];
        }
        echo "Now, modify the name of the 'test' category by 'Mytest'".PHP_EOL;
        $return = $bdd->updateCategoryProduct($id, "myTest");
        echo "Check if the name has been modify".PHP_EOL;
        $return = $bdd->getCategoryProducts();
        foreach($return as $value)
        {
            var_dump($value);
        }
        echo "I will delete Test for a future test".PHP_EOL;
        $return = $bdd->deleteCategoryProduct($id);
        echo "Let see if the category has been deleted".PHP_EOL;
        $return = $bdd->getCategoryProducts();
        foreach($return as $value)
        {
            var_dump($value);
        }
    }

    /**
     * This function test all product functions from BDD
     */
    static function testerProduct()
    {
        $bdd = new bdd();
        $id = null;
        $idProduit = null;
        echo "I will create a category of object : Test".PHP_EOL;
        $return = $bdd->createCategoryProduct("Test");
        echo "Let see if the category has been created".PHP_EOL;
        $return = $bdd->getCategoryProducts();
        foreach($return as $value)
        {
            var_dump($value);
            if($value['Nom'] == "Test")
                $id = $value['Id'];
        }
        echo "I will create a product".PHP_EOL;
        $return = $bdd->createProduct("Test", 20, "", "This is a test product", $id);
        echo "Let see if the product has been created".PHP_EOL;
        $return = $bdd->getProducts();
        foreach($return as $value)
        {
            var_dump($value);
            if($value['Nom'] == "Test")
                $idProduit = $value['Id'];
        }
        echo "Now, modify the product Name, price and description by myTest, 50 and 'This is a myTest product".PHP_EOL;
        $return = $bdd->updateProduct($idProduit, "myTest", 50, "", "This is a myTest product");
        echo "Check if the product has been modify".PHP_EOL;
        $return = $bdd->getProducts();
        foreach($return as $value)
        {
            var_dump($value);
        }
        echo "I will delete Test product for a future test".PHP_EOL;
        $return = $bdd->deleteProduct($idProduit);
        echo "Let see if the product has been deleted".PHP_EOL;
        $return = $bdd->getProducts();
        foreach($return as $value)
        {
            var_dump($value);
        }
        echo "I will delete Test category for a future test".PHP_EOL;
        $return = $bdd->deleteCategoryProduct($id);
        echo "Let see if the category has been deleted".PHP_EOL;
        $return = $bdd->getCategoryProducts();
        foreach($return as $value)
        {
            var_dump($value);
        }
    }

    /**
     * This function test all functions for a bill on the Database
     */
    static function testerBill()
    {
        $bdd = new bdd();
        $idCatProduct = null;
        $idProduit = null;
        $idProduit2 = null;
        $idBill = null;
        echo "I will create a category of object : Test".PHP_EOL;
        $return = $bdd->createCategoryProduct("Test");
        echo "Let see if the category has been created".PHP_EOL;
        $return = $bdd->getCategoryProducts();
        foreach($return as $value)
        {
            var_dump($value);
            if($value['Nom'] == "Test")
                $idCatProduct = $value['Id'];
        }
        echo "I will create a product".PHP_EOL;
        $return = $bdd->createProduct("Test", 20, "", "This is a test product", $idCatProduct);
        $return = $bdd->getProducts();
        foreach($return as $value)
        {
            if($value['Nom'] == "Test")
                $idProduit = $value['Id'];
        }
        echo "I will create a second product".PHP_EOL;
        $return = $bdd->createProduct("Test2", 20, "", "This is a test second product", $idCatProduct);
        echo "Let see if the products has been created".PHP_EOL;
        $return = $bdd->getProducts();
        foreach($return as $value)
        {
            var_dump($value);
            if($value['Nom'] == "Test2")
                $idProduit2 = $value['Id'];
        }
        echo "I will create the user userTest".PHP_EOL;
        $return = $bdd->createUser("userTest", "azerty", "Surname", "Name", "address", "Name.Surname@imerir.com");
        echo "I will see the users in the database".PHP_EOL;
        $return = $bdd->getUsers();
        foreach($return as $value)
        {
            var_dump($value);
        }
        echo "I will create a bill with 3 objects 'Test' ans 1 object 'test2'".PHP_EOL;
        $return = $bdd->createBill("userTest", array($idProduit, $idProduit, $idProduit, $idProduit2));
        echo "Let see if the bill is created".PHP_EOL;
        $return = $bdd->getBills("userTest");
        foreach($return as $value)
        {
            var_dump($value);
            $idBill = $value['Id'];
        }
        echo "Let see if the bill details".PHP_EOL;
        $return = $bdd->getDetailsBill($idBill);
        foreach($return as $value)
        {
            var_dump($value);
        }
        echo "I will delete the bill for a future test".PHP_EOL;
        $return = $bdd->deleteBill($idBill);
        echo "I will delete userTest".PHP_EOL;
        $return = $bdd->deleteUser("userTest");
        echo "Check if the userTest has been deleted".PHP_EOL;
        $return = $bdd->getUsers();
        foreach($return as $value)
        {
            var_dump($value);
        }
        echo "I will delete Test product for a future test".PHP_EOL;
        $return = $bdd->deleteProduct($idProduit);
        echo "I will delete Test 2 product for a future test".PHP_EOL;
        $return = $bdd->deleteProduct($idProduit2);
        echo "Let see if the products has been deleted".PHP_EOL;
        $return = $bdd->getProducts();
        foreach($return as $value)
        {
            var_dump($value);
        }
        echo "I will delete Test category for a future test".PHP_EOL;
        $return = $bdd->deleteCategoryProduct($idCatProduct);
        echo "Let see if the category has been deleted".PHP_EOL;
        $return = $bdd->getCategoryProducts();
        foreach($return as $value)
        {
            var_dump($value);
        }
    }

    /**
     * This function test all functions for basket in Database
     */
    static function testerBasket()
    {
        $bdd = new bdd();
        $idCatProduct = null;
        $idProduit = null;
        $idProduit2 = null;
        $idBill = null;
        echo "I will create a category of object : Test".PHP_EOL;
        $return = $bdd->createCategoryProduct("Test");
        echo "Let see if the category has been created".PHP_EOL;
        $return = $bdd->getCategoryProducts();
        foreach($return as $value)
        {
            var_dump($value);
            if($value['Nom'] == "Test")
                $idCatProduct = $value['Id'];
        }
        echo "I will create a product".PHP_EOL;
        $return = $bdd->createProduct("Test", 20, "", "This is a test product", $idCatProduct);
        $return = $bdd->getProducts();
        foreach($return as $value)
        {
            if($value['Nom'] == "Test")
                $idProduit = $value['Id'];
        }
        echo "I will create a second product".PHP_EOL;
        $return = $bdd->createProduct("Test2", 20, "", "This is a test second product", $idCatProduct);
        echo "Let see if the products has been created".PHP_EOL;
        $return = $bdd->getProducts();
        foreach($return as $value)
        {
            var_dump($value);
            if($value['Nom'] == "Test2")
                $idProduit2 = $value['Id'];
        }
        echo "I will create the user userTest".PHP_EOL;
        $return = $bdd->createUser("userTest", "azerty", "Surname", "Name", "address", "Name.Surname@imerir.com");
        echo "I will see the users in the database".PHP_EOL;
        $return = $bdd->getUsers();
        foreach($return as $value)
        {
            var_dump($value);
        }

        echo "Now we will add 2 products 'test1' and 1 product 'test2' on basket".PHP_EOL;
        $return = $bdd->insertBasket("userTest", $idProduit);
        $return = $bdd->insertBasket("userTest", $idProduit);
        $return = $bdd->insertBasket("userTest", $idProduit2);

        echo "Check if the product has been add to basket".PHP_EOL;
        $return = $bdd->getBasket("userTest");
        foreach($return as $value)
        {
            var_dump($value);
        }

        echo "Now I will delete 1 product of 'test1'".PHP_EOL;
        $return = $bdd->deleteBasketProduct($idProduit, "userTest", 1);
        if($return)
            echo "OK";
        else
            echo "NOK";
        echo "Check if the product 'test1' has been deleted 1 time".PHP_EOL;
        $return = $bdd->getBasket("userTest");
        foreach($return as $value)
        {
            var_dump($value);
        }
        echo "Now we will delete all product on basket".PHP_EOL;
        $return = $bdd->deleteBasket("userTest");
        echo "Check if all products has been deleted".PHP_EOL;
        $return = $bdd->getBasket("userTest");
        foreach($return as $value)
        {
            var_dump($value);
        }

        echo "I will delete userTest".PHP_EOL;
        $return = $bdd->deleteUser("userTest");
        echo "Check if the userTest has been deleted".PHP_EOL;
        $return = $bdd->getUsers();
        foreach($return as $value)
        {
            var_dump($value);
        }
        echo "I will delete Test product for a future test".PHP_EOL;
        $return = $bdd->deleteProduct($idProduit);
        echo "I will delete Test 2 product for a future test".PHP_EOL;
        $return = $bdd->deleteProduct($idProduit2);
        echo "Let see if the products has been deleted".PHP_EOL;
        $return = $bdd->getProducts();
        foreach($return as $value)
        {
            var_dump($value);
        }
        echo "I will delete Test category for a future test".PHP_EOL;
        $return = $bdd->deleteCategoryProduct($idCatProduct);
        echo "Let see if the category has been deleted".PHP_EOL;
        $return = $bdd->getCategoryProducts();
        foreach($return as $value)
        {
            var_dump($value);
        }
    }
}