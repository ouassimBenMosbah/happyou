<?php

/*! \brief Fonctions de la table Lieu
 *         
 * Cette classe contient les fonctions propres à la table lieu de la base de données.
 *  
 */


class ModelLieu extends Model {


    /// Cette fonction permet de renvoyer la liste des id d'un lieu donné en paramètre.
    /// Tous les paramètres sont contenus dans un tableau $data
    /// @param 'lieu' \b str, le lieu du boitier.
    ///@result renvoie un \b objet \b sql qui correspond à tous les id du lieu donné en paramètre.
    public static function verifLieu($data)
    {
        try 
        {
                $sql = "SELECT id_lieu FROM lieu WHERE nom_lieu = :lieu";                       
                // Preparation de la requete
                $req = self::$pdo->prepare($sql);
                // execution de la requete
                $req->execute($data);
                return $req->fetchAll(PDO::FETCH_OBJ);   
        } 
        catch (PDOException $e) {
            echo $e->getMessage();
            die("<br /> Erreur dans la BDD ");
        }
    }

    /// Cette fonction permet d'insérer les données d'un nouveau lieu dans la base de données.
    /// Tous les paramètres sont contenus dans un tableau $data 
    /// @param 'lieu' \b str, le lieu du boitier. 
    /// @return Si les paramètres sont \b conformes aux types souhaités alors la fonction \b insère le nouveau lieu du boitier dans la base de données. 
    /// @return Si un ou plusieurs paramètres sont \b incorrectes la fonction affiche une \b erreur
    public static function insertLieu($data)
    {
        try 
        {
                $sql = "INSERT INTO lieu (`nom_lieu`) VALUES (:lieu)";
                // Preparation de la requete
                $req = self::$pdo->prepare($sql);
                // execution de la requete
                return $req->execute($data);            
        } 
        catch (PDOException $e) {
            echo $e->getMessage();
            die("<br /> Erreur dans la BDD ");
        }
    }

    /// Cette fonction permet de renvoyer la liste de tous les tuples des lieux des boitiers de la base de donnée.
    ///@param ne demande \b aucun \b paramètres
    ///@result renvoie un \b objet \b sql qui correspond à tous les tuples des lieux des boitiers.
    public static function selectLieux()
    {
        try 
        {
                $sql = "SELECT nom_lieu FROM lieu";
                // Preparation de la requete
                $req = self::$pdo->prepare($sql);
                // execution de la requete
                $req->execute();
                return $req->fetchAll(PDO::FETCH_OBJ);
                
            
        } 
        catch (PDOException $e) {
            echo $e->getMessage();
            die("<br /> Erreur dans la BDD ");
        }
    }
  
}



