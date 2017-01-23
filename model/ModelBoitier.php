<?php

/*! \brief Fonctions de la table Boitier
 *         
 * Cette classe contient les fonctions propres à la table boitier de la base de données.
 *  
 */


class ModelBoitier extends Model {
    

    /// Cette fonction permet de renvoyer la liste de tous les tuples des détails des boitiers de la base de donnée.
    /// @param ne demande \b aucun \b paramètres
    /// @result renvoie un \b objet \b sql qui correspond à tous les tuples des jointures des boitiers et lieu de la base de donnée.
    public static function selectBoitier()
    {
        try 
        {
                $sql = "SELECT Num_serie_boitier, lieu, MAX(nb_satisfait) nb_satisfait
                FROM
                (SELECT b.Num_serie_boitier Num_serie_boitier, l.nom_lieu lieu, COUNT(*) nb_satisfait
                FROM vote v, boitier b, lieu l, question q 
                WHERE b.Num_serie_boitier = v.Num_serie_boitier AND l.id_lieu = v.id_lieu AND q.id_question = v.id_question AND smiley = 2 AND b.id_question = v.id_question AND b.id_lieu = v.id_lieu AND v.timestamp_vote > DATE_SUB(NOW(), INTERVAL 7 DAY) GROUP BY b.Num_serie_boitier, l.id_lieu, q.id_question
                UNION
                SELECT b.Num_serie_boitier Num_serie_boitier, l.nom_lieu lieu, '0' nb_satisfait FROM boitier b, lieu l WHERE l.id_lieu = b.id_lieu) t
                GROUP BY Num_serie_boitier
                ORDER BY Num_serie_boitier";                       
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
    
    
    /// Cette fonction permet d'insérer les données d'un nouveau boitier dans la base de données.
    /// Tous les paramètres sont contenus dans un tableau $data 
    /// @param 'NomBoitier' \b str, le numéro de série du boitier. 
    /// @param 'id_question' \b int , l'identifiant de la question demandé par le boitier.
    /// @param 'id_lieu' \b int, l'identifiant du lieu du boitier.
    /// @return Si les paramètres sont \b conformes aux types souhaités alors la fonction \b insère le nouveau boitier dans la base de données. 
    /// @return Si un ou plusieurs paramètres sont \b incorrectes la fonction affiche une \b erreur
    public static function insertBoitier($data)
    {
        try 
        {
                $sql = "INSERT INTO boitier VALUES (:NomBoitier, CURDATE(), :id_question, :id_lieu)";                       
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
    

    /// Cette fonction permet de renvoyer la liste de tous les tuples des détails nécessaire d'un boitier donnée de la base de données.
    /// Tous les paramètres sont contenus dans un tableau $data 
    /// @param 'Num' \b str, le numéro de série du boitier. 
    /// @result renvoie un \b objet \b sql qui correspond au tuple des jointures des boitiers, question et lieu d'un boitier de la base de donnée.
    public static function detailsBoitier($data)
    {
        try 
        {
                $sql = "SELECT Num_serie_boitier, DATE_FORMAT(Date_install, '%d/%m/%Y') as Date_install, nom_lieu, question, b.id_question id_question, b.id_lieu id_lieu FROM boitier b, question q, lieu l WHERE Num_serie_boitier = :num AND b.id_question = q.id_question AND b.id_lieu = l.id_lieu";
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

    /// Cette fonction permet de modifier la question posé dans un boitier donnée de la base de données.
    /// Tous les paramètres sont contenus dans un tableau $data 
    /// @param 'Num_serie_boitier' \b str, le numéro de série du boitier.
    /// @param 'id_question' \b int, l'identifiant de la question posé par le boitier.
    /// @return Si les paramètres sont \b conformes aux types souhaités alors la fonction \b modifie la question du boitier dans la base de données. 
    /// @return Si un ou plusieurs paramètres sont \b incorrectes la fonction affiche une \b erreur
    public static function updateQuestion($data)
    {
        try 
        {
                $sql = "UPDATE boitier SET id_question = :id_question WHERE Num_serie_boitier = :Num_serie_boitier";                       
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

    /// Cette fonction permet de modifier le lieu posé dans un boitier donnée de la base de données.
    /// Tous les paramètres sont contenus dans un tableau $data 
    /// @param 'Num_serie_boitier' \b str, le numéro de série du boitier.
    /// @param 'id_lieu' \b int, l'identifiant du lieu posé par le boitier.
    /// @return Si les paramètres sont \b conformes aux types souhaités alors la fonction \b modifie le lieu du boitier dans la base de données. 
    /// @return Si un ou plusieurs paramètres sont \b incorrectes la fonction affiche une \b erreur
    public static function updateLieu($data)
    {
        try 
        {
                $sql = "UPDATE boitier SET id_lieu = :id_lieu WHERE Num_serie_boitier = :Num_serie_boitier";                       
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

    /// Cette fonction permet de renvoyer le numèro de série du boitier donné en parammètre si il existe.
    /// Tous les paramètres sont contenus dans un tableau $data 
    /// @param 'num' \b str, le numéro de série du boitier. 
    /// @result renvoie un \b objet \b sql qui correspond au numèro de série du boitier donné en paramètre si il existe et sinon il ne renvoi rien.
    public static function verifBoitier($data)
    {
        try 
        {
                $sql = "SELECT Num_serie_boitier FROM boitier b WHERE Num_serie_boitier = :num";
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
  
}



