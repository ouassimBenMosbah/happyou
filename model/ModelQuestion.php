<?php

/*! \brief Fonctions de la table question
 *         
 * Cette classe contient les fonctions propres à la table question de la base de données.
 *  
 */


class ModelQuestion extends Model {
    

    /// Cette fonction permet de renvoyer la liste des id d'une question donné en paramètre.
    /// Tous les paramètres sont contenus dans un tableau $data
    /// @param 'lieu' \b str, le lieu du boitier.
    ///@result renvoie un \b objet \b sql qui correspond à tous les id du lieu donné en paramètre.
    public static function verifQuestion($data)
    {
        try 
        {
                $sql = "SELECT id_question FROM question WHERE question = :question";                       
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

    /// Cette fonction permet d'insérer les données d'une nouvelle question dans la base de données.
    /// Tous les paramètres sont contenus dans un tableau $data 
    /// @param 'question' \b str, le lieu du boitier. 
    /// @return Si les paramètres sont \b conformes aux types souhaités alors la fonction \b insère la nouvealle question du boitier dans la base de données. 
    /// @return Si un ou plusieurs paramètres sont \b incorrectes la fonction affiche une \b erreur
    public static function insertQuestion($data)
    {
        try 
        {
                $sql = "INSERT INTO question (`question`) VALUES (:question)";
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

    /// Cette fonction permet de renvoyer la liste de tous les tuples des questions des boitiers de la base de donnée.
    ///@param ne demande \b aucun \b paramètres
    ///@result renvoie un \b objet \b sql qui correspond à tous les tuples des questions des boitiers.
    public static function selectQuestions()
    {
        try 
        {
                $sql = "SELECT question nom_question FROM question";
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



