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
        echo "I will create the user ccleouf".PHP_EOL;
        $user = $bdd->createUser("ccleouf", "azerty", "Connan", "Cyril", "8 impasse de la tuillerie", "cyril.connan@imerir.com");
        echo "I will see the users in the database".PHP_EOL;
        $user = $bdd->getUsers();
        foreach($user as $value)
        {
            var_dump($value);
        }
        echo "I will update the user with nickname ccleouf with Leila Garcia which living in 2 rue de villeroge in Perpignan".PHP_EOL;
        $user = $bdd->updateUser("Leila", "Garcia", "2 rue de villeroge 66100 PERPIGNAN", "leilagarcia@orange.fr", "ccleouf");
        echo "Check if the user ccleouf has been modify".PHP_EOL;
        $user = $bdd->getUsers();
        foreach($user as $value)
        {
            var_dump($value);
        }
        echo "I will delete ccleouf".PHP_EOL;
        $user = $bdd->deleteUser("ccleouf");
        echo "Check if the ccleouf has been deleted".PHP_EOL;
        $user = $bdd->getUsers();
        foreach($user as $value)
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
        echo "I will create the user ccleouf with 'azerty' password".PHP_EOL;
        $user = $bdd->createUser("ccleouf", "azerty", "Connan", "Cyril", "8 impasse de la tuillerie", "cyril.connan@imerir.com");
        echo "Let see if the user has been created".PHP_EOL;
        $user = $bdd->getUser("ccleouf");
        foreach($user as $value)
        {
            var_dump($value);
        }
        echo "Check his password".PHP_EOL;
        $user = $bdd->getPassword("ccleouf");
        foreach($user as $value)
        {
            var_dump($value);
        }
        echo "Now we change the password to 'ytreza'".PHP_EOL;
        $user = $bdd->setPassword("ccleouf", "ytreza");
        echo "let see if the password has been changed".PHP_EOL;
        $user = $bdd->getPassword("ccleouf");
        foreach($user as $value)
        {
            var_dump($value);
        }
        echo "I will delete ccleouf for a future test".PHP_EOL;
        $user = $bdd->deleteUser("ccleouf");
        echo "Check if ccleouf has been deleted".PHP_EOL;
        $user = $bdd->getUser("ccleouf");
        foreach($user as $value)
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
        $user = $bdd->createCategoryProduct("Test");
        echo "Let see if the category has been created".PHP_EOL;
        $user = $bdd->getCategoryProducts();
        foreach($user as $value)
        {
            var_dump($value);
            if($value['Nom'] == "Test")
                $id = $value['Id'];
        }
        echo "Now, modify the name of the 'test' category by 'Mytest'".PHP_EOL;
        $user = $bdd->updateCategoryProduct($id, "myTest");
        echo "Check if the name has been modify".PHP_EOL;
        $user = $bdd->getCategoryProducts();
        foreach($user as $value)
        {
            var_dump($value);
        }
        echo "I will delete Test for a future test".PHP_EOL;
        $user = $bdd->deleteCategoryProduct($id);
        echo "Let see if the category has been deleted".PHP_EOL;
        $user = $bdd->getCategoryProducts();
        foreach($user as $value)
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
        $user = $bdd->createCategoryProduct("Test");
        echo "Let see if the category has been created".PHP_EOL;
        $user = $bdd->getCategoryProducts();
        foreach($user as $value)
        {
            var_dump($value);
            if($value['Nom'] == "Test")
                $id = $value['Id'];
        }
        echo "I will create a product".PHP_EOL;
        $user = $bdd->createProduct("Test", 20, "", "This is a test product", $id);
        echo "Let see if the product has been created".PHP_EOL;
        $user = $bdd->getProducts();
        foreach($user as $value)
        {
            var_dump($value);
            if($value['Nom'] == "Test")
                $idProduit = $value['Id'];
        }
        echo "Now, modify the product Name, price and description by myTest, 50 and 'This is a myTest product".PHP_EOL;
        $user = $bdd->updateProduct($idProduit, "myTest", 50, "", "This is a myTest product");
        echo "Check if the product has been modify".PHP_EOL;
        $user = $bdd->getProducts();
        foreach($user as $value)
        {
            var_dump($value);
        }
        echo "I will delete Test product for a future test".PHP_EOL;
        $user = $bdd->deleteProduct($idProduit);
        echo "Let see if the product has been deleted".PHP_EOL;
        $user = $bdd->getProducts();
        foreach($user as $value)
        {
            var_dump($value);
        }
        echo "I will delete Test category for a future test".PHP_EOL;
        $user = $bdd->deleteCategoryProduct($id);
        echo "Let see if the category has been deleted".PHP_EOL;
        $user = $bdd->getCategoryProducts();
        foreach($user as $value)
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
        $user = $bdd->createCategoryProduct("Test");
        echo "Let see if the category has been created".PHP_EOL;
        $user = $bdd->getCategoryProducts();
        foreach($user as $value)
        {
            var_dump($value);
            if($value['Nom'] == "Test")
                $idCatProduct = $value['Id'];
        }
        echo "I will create a product".PHP_EOL;
        $user = $bdd->createProduct("Test", 20, "", "This is a test product", $idCatProduct);
        $user = $bdd->getProducts();
        foreach($user as $value)
        {
            if($value['Nom'] == "Test")
                $idProduit = $value['Id'];
        }
        echo "I will create a second product".PHP_EOL;
        $user = $bdd->createProduct("Test2", 20, "", "This is a test second product", $idCatProduct);
        echo "Let see if the products has been created".PHP_EOL;
        $user = $bdd->getProducts();
        foreach($user as $value)
        {
            var_dump($value);
            if($value['Nom'] == "Test2")
                $idProduit2 = $value['Id'];
        }
        echo "I will create the user ccleouf".PHP_EOL;
        $user = $bdd->createUser("ccleouf", "azerty", "Connan", "Cyril", "8 impasse de la tuillerie", "cyril.connan@imerir.com");
        echo "I will see the users in the database".PHP_EOL;
        $user = $bdd->getUsers();
        foreach($user as $value)
        {
            var_dump($value);
        }
        echo "I will create a bill with 3 objects 'Test' ans 1 object 'test2'".PHP_EOL;
        $user = $bdd->createBill("ccleouf", array($idProduit, $idProduit, $idProduit, $idProduit2));
        echo "Let see if the bill is created".PHP_EOL;
        $user = $bdd->getBills("ccleouf");
        foreach($user as $value)
        {
            var_dump($value);
            $idBill = $value['Id'];
        }
        echo "Let see if the bill details".PHP_EOL;
        $user = $bdd->getDetailsBill($idBill);
        foreach($user as $value)
        {
            var_dump($value);
        }
        echo "I will delete ccleouf".PHP_EOL;
        $user = $bdd->deleteUser("ccleouf");
        echo "Check if the ccleouf has been deleted".PHP_EOL;
        $user = $bdd->getUsers();
        foreach($user as $value)
        {
            var_dump($value);
        }
        echo "I will delete Test product for a future test".PHP_EOL;
        $user = $bdd->deleteProduct($idProduit);
        echo "I will delete Test 2 product for a future test".PHP_EOL;
        $user = $bdd->deleteProduct($idProduit2);
        echo "Let see if the products has been deleted".PHP_EOL;
        $user = $bdd->getProducts();
        foreach($user as $value)
        {
            var_dump($value);
        }
        echo "I will delete Test category for a future test".PHP_EOL;
        $user = $bdd->deleteCategoryProduct($idCatProduct);
        echo "Let see if the category has been deleted".PHP_EOL;
        $user = $bdd->getCategoryProducts();
        foreach($user as $value)
        {
            var_dump($value);
        }
    }
}