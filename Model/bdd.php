<?php

/**
 * Created by PhpStorm.
 * User: skiiro
 * Date: 02/11/16
 * Time: 11:42
 */
class bdd
{
    private $pdo;
    private $state;

    /**
     * bdd constructor.
     */
    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=localhost; dbname=market', 'root', 'php2016');
        }
        catch (PDOException $e)
        {
            $this->state = false;
        }
        $this->state = true;

    }

    /////////////////////////////////////////////////////////////////USERS/////////////////////////////////////////////////////////////////
    /**
     * This function get all users information from the database
     * @return array -> Result from the database |null -> if an error occurs
     */
    function getUsers()
    {
        if($this->state) {
            $sql = "SELECT Pseudonyme, Nom, Prenom, Adresse_Postal, Adresse_Mail " .
                "FROM Utilisateur ";
            $request = $this->pdo->prepare($sql);
            $success = $request->execute();
            if ($success == false)
                return NULL;
            else
                return $request->fetchAll(PDO::FETCH_ASSOC);
        }
        else
            return NULL;
    }

    /**
     * this function get a user searching by a nickname
     * @param $nickname -> nickname
     * @return array -> Result from the database |null -> if an error occurs
     */
    function getUser($nickname)
    {
        if($this->state) {
            $sql = 'SELECT Pseudonyme, Nom, Prenom, Adresse_Postal, Adresse_Mail 
                    FROM Utilisateur
                     WHERE Pseudonyme = :nickname';
            $request = $this->pdo->prepare($sql);
            $success = $request->execute(array(':nickname' => $nickname));
            if ($success == false)
                return NULL;
            else
                return $request->fetchAll(PDO::FETCH_ASSOC);
        }
        else
            return NULL;
    }

    /**
     * Update information about a user in the database
     * @param $name -> new name
     * @param $lastName -> new lastName
     * @param $address -> new address
     * @param $mail -> new mail
     * @param $nickname -> new nickname
     * @return bool -> request success or not
     */
    function updateUser($name, $lastName, $address, $mail, $nickname)
    {
        if($this->state) {
            $sql = 'UPDATE Utilisateur 
                    SET Nom = :lastName, Prenom = :name, Adresse_Postal = :address, Adresse_Mail = :mail 
                    WHERE Pseudonyme = :nickname';
            $request = $this->pdo->prepare($sql);
            return $request->execute(array(':lastName' => $lastName, ':name' => $name, ':address' => $address, ':mail' => $mail, 'nickname' => $nickname));
        }
        else
            return false;
    }

    /**
     * Delete a user from the database
     * @param $nickname -> nickname of the user to delete
     * @return bool -> request success or not
     */
    function deleteUser($nickname)
    {
        if($this->state) {
            $sql = 'DELETE FROM Utilisateur 
                    WHERE Pseudonyme = :nickname';
            $request = $this->pdo->prepare($sql);
            return $request->execute(array(':nickname' => $nickname));
        }
        else {
            return false;
        }

    }

    /**
     * Create a user in the database
     * @param $nickname -> new nickname
     * @param $password -> new password
     * @param $lastName -> new lastName
     * @param $name -> new name
     * @param $address -> new address
     * @param $mail -> new mail
     * @return bool -> request success or not
     */
    function createUser($nickname, $password, $lastName, $name, $address, $mail)
    {
        if($this->state) {
            $sql = 'INSERT INTO Utilisateur (Pseudonyme, Mot_De_Passe, Nom, Prenom, Adresse_Postal, Adresse_Mail)
                    VALUES(:nickname, :password, :lastName, :name, :address, :mail)';
            $request = $this->pdo->prepare($sql);
            return $request->execute(array(':nickname' => $nickname, ':password' => $password, ':lastName' => $lastName, ':name' => $name, 'address' => $address, 'mail' => $mail));
        }
        else {
            return false;
        }
    }

    /**
     * Get the password from a user
     * @param $nickname -> nickname
     * @return array -> Result from the database |null -> if an error occurs
     */
    function getPassword($nickname)
    {
        if($this->state) {
            $sql = 'SELECT Mot_De_Passe FROM Utilisateur WHERE Pseudonyme = :nickname';
            $request = $this->pdo->prepare($sql);
            $success = $request->execute(array(':nickname' => $nickname));
            if($success == false)
            {
                echo 'shit';
                return NULL;
            }
            else
            {
                return $request->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        else {
            return NULL;
        }
    }

    /**
     * Modify the current password for a user
     * @param $nickname -> nickname
     * @return bool -> request success or not
     */
    function setPassword($nickname, $password)
    {
        if($this->state) {
            $sql = 'UPDATE Utilisateur
                    SET Mot_De_Passe = :password
                    WHERE Pseudonyme = :nickname';
            $request = $this->pdo->prepare($sql);
            return $request->execute(array(':nickname' => $nickname, ':password' => $password));
        }
        else {
            return false;
        }
    }

    /////////////////////////////////////////////////////////////////PRODUCTS/////////////////////////////////////////////////////////////////
    /**
     * This function get all products from the database
     * @return array -> Result from the database |null -> if an error occurs
     */
    function getProducts()
    {
        if($this->state) {
            $sql = 'SELECT p.Id, p.Nom, p.Prix, p.Image, p.Description, cp.Nom AS "Categorie"
                    FROM Produit p 
                    INNER JOIN Categorie_Produit cp ON p.Id_Categorie_Produit = cp.Id';
            $request = $this->pdo->prepare($sql);
            $success = $request->execute();
            if ($success == false)
                return NULL;
            else
                return $request->fetchAll(PDO::FETCH_ASSOC);
        }
        else
            return NULL;
    }

    /**
     * This function get a single product searching by id
     * @param $id -> id
     * @return array -> Result from the database |null -> if an error occurs
     */
    function getProduct($id)
    {
        if($this->state) {
            $sql = 'SELECT p.Id, p.Nom, p.Prix, p.Image, p.Description, cp.Nom AS "Categorie"
                    FROM Produit p 
                    INNER JOIN Categorie_Produit cp ON p.Id_Categorie_Produit = cp.Id
                    WHERE p.Id = :id';
            $request = $this->pdo->prepare($sql);
            $success = $request->execute(array(':id' => $id));
            if ($success == false)
                return NULL;
            else
                return $request->fetchAll(PDO::FETCH_ASSOC);
        }
        else
            return NULL;
    }

    /**
     * Update information about a product in the database
     * @param $id -> id of the product
     * @param $name -> new name
     * @param $price -> new price
     * @param $image -> new image
     * @param $description -> new description
     * @return bool -> request success or not
     */
    function updateProduct($id, $name, $price, $image, $description)
    {
        if($this->state) {
            $sql = 'UPDATE Produit
                    SET Nom = :name, Prix = :price, Image = :image, Description = :description 
                    WHERE Id = :id';
            $request = $this->pdo->prepare($sql);
            return $request->execute(array(':name' => $name, ':price' => $price, ':image' => $image, ':description' => $description, ':id' => $id));
        }
        else
            return false;
    }

    /**
     * Delete a product from the database
     * @param $id -> id of the product to delete
     * @return bool -> request success or not
     */
    function deleteProduct($id)
    {
        if($this->state) {
            $sql = 'DELETE FROM Produit 
                    WHERE Id = :id';
            $request = $this->pdo->prepare($sql);
            return $request->execute(array(':id' => $id));
        }
        else {
            return false;
        }

    }

    /**
     * Create a new product
     * @param $name -> Name
     * @param $price -> price
     * @param $image -> image
     * @param $description -> description
     * @param $idCategorie -> id of the category
     * @return bool -> request success or not
     */
    function createProduct($name, $price, $image, $description, $idCategorie)
    {
        if($this->state) {
            $sql = 'INSERT INTO Produit (Nom, Prix, Image, Description, Id_Categorie_Produit)
                    VALUES(:name, :price, :image, :description, :idCategorie)';
            $request = $this->pdo->prepare($sql);
            return $request->execute(array(':name' => $name, ':price' => $price, ':description' => $description, ':image' => $image, ':idCategorie' => $idCategorie));
        }
        else {
            return false;
        }
    }

    /**
     * Create a category of product
     * @param $name -> name
     * @return bool -> request success or not
     */
    function createCategoryProduct($name)
    {
        if($this->state) {
            $sql = 'INSERT INTO Categorie_Produit (Nom)
                    VALUES(:name)';
            $request = $this->pdo->prepare($sql);
            return $request->execute(array(':name' => $name));
        }
        else {
            return false;
        }
    }

    /**
     * Delete a category of product
     * @param $id -> id
     * @return bool -> request success or not
     */
    function deleteCategoryProduct($id)
    {
        if($this->state) {
            $sql = 'DELETE FROM Categorie_Produit 
                    WHERE Id = :id';
            $request = $this->pdo->prepare($sql);
            return $request->execute(array(':id' => $id));
        }
        else {
            return false;
        }
    }

    /**
     * This function get all category of products from the database
     * @return array -> Result from the database |null -> if an error occurs
     */
    function getCategoryProducts()
    {
        if($this->state) {
            $sql = 'SELECT Id, Nom
                    FROM Categorie_Produit';
            $request = $this->pdo->prepare($sql);
            $success = $request->execute();
            if ($success == false)
                return NULL;
            else
                return $request->fetchAll(PDO::FETCH_ASSOC);
        }
        else
            return NULL;
    }

    /**
     * This function get a single product searching by id
     * @param $id -> id
     * @return array -> Result from the database |null -> if an error occurs
     */
    function getCategoryProduct($id)
    {
        if($this->state) {
            $sql = 'SELECT Id, Nom
                    FROM Categorie_Produit 
                    WHERE p.Id = :id';
            $request = $this->pdo->prepare($sql);
            $success = $request->execute(array(':id' => $id));
            if ($success == false)
                return NULL;
            else
                return $request->fetchAll(PDO::FETCH_ASSOC);
        }
        else
            return NULL;
    }

    /**
     * Update information about a product in the database
     * @param $id -> id of the product
     * @param $name -> new name
     * @param $price -> new price
     * @param $image -> new image
     * @param $description -> new description
     * @return bool -> request success or not
     */
    function updateCategoryProduct($id, $name)
    {
        if($this->state) {
            $sql = 'UPDATE Categorie_Produit
                    SET Nom = :name
                    WHERE Id = :id';
            $request = $this->pdo->prepare($sql);
            return $request->execute(array(':name' => $name, ':id' => $id));
        }
        else
            return false;
    }

    /////////////////////////////////////////////////////////////////BILLS/////////////////////////////////////////////////////////////////

    /**
     * Create a new Bill in the database
     * @param $name -> name
     * @param $products -> array of products id
     * @return bool -> request success or not
     */
    function createBill($name, $products)
    {
        if($this->state) {
            $now = date("Y/m/d H:i:d");
            echo $now;
            $sql = 'INSERT INTO Facture (Date, Pseudonyme_Utilisateur)
                    VALUES(:date, :name)';
            $request = $this->pdo->prepare($sql);
            if($request->execute(array(':name' => $name, ':date' => $now)) == true)
            {
                foreach($products as $value)
                {
                    $sql = 'INSERT INTO Porter_Sur (Id_Facture, Id_Produit)
                    VALUES((SELECT Id FROM Facture WHERE Pseudonyme_Utilisateur = :name AND Date = :date), :idProduit)';
                    $request = $this->pdo->prepare($sql);
                    if($request->execute(array(':name' => $name, ':date' => $now, ':idProduit' => $value)) == false)
                        return false;
                }
                return true;
            }
            else
                return false;
        }
        else {
            return false;
        }
    }

    /**
     * Delete a bill from the database
     * @param $id -> id of the bill
     * @return bool -> request success or not
     */
    function deleteBill($id)
    {
        if($this->state) {
            $sql = 'DELETE FROM Facture 
                    WHERE Id = :id';
            $request = $this->pdo->prepare($sql);
            if ($request->execute(array(':id' => $id)) == true)
            {
                $sql = 'DELETE FROM Porter_Sur 
                    WHERE Id_Facture = :id';
                $request = $this->pdo->prepare($sql);
                return $request->execute(array(':id' => $id));
            }
            else
            {
                return false;
            }
        }
        else {
            return false;
        }
    }

    /**
     * This function get all bills for a user from the database
     * @return array -> Result from the database |null -> if an error occurs
     */
    function getBills($name)
    {
        if($this->state) {
            $sql = 'SELECT Id, Date
                    FROM Facture
                    WHERE Pseudonyme_Utilisateur = :name';
            $request = $this->pdo->prepare($sql);
            $success = $request->execute(array(':name' => $name));
            if ($success == false)
                return NULL;
            else
                return $request->fetchAll(PDO::FETCH_ASSOC);
        }
        else
            return NULL;
    }

    /**
     * This function get all details for a bill from the database
     * @return array -> Result from the database |null -> if an error occurs
     */
    function getDetailsBill($id)
    {
        if($this->state) {
            $sql = 'SELECT Id_Produit, count(Id_Produit) AS "Quantity"
                    FROM Porter_Sur
                    WHERE Id_Facture = :idFacture
                    GROUP BY Id_Produit';
            $request = $this->pdo->prepare($sql);
            $success = $request->execute(array(':idFacture' => $id));
            if ($success == false)
                return NULL;
            else
                return $request->fetchAll(PDO::FETCH_ASSOC);
        }
        else
            return NULL;
    }

}