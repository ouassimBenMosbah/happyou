<?php

/*! \brief Fonctions de la table vote
 *         
 * Cette classe contient les fonctions propres à la table vote de la base de données.
 *  
 */


class ModelVote extends Model {
    
    /// Cette fonction permet d'insérer les données d'un nouveau vote dans la base de données.
    /// Tous les paramètres sont contenus dans un tableau $data 
    /// @param 'vote' \b int, la valeur du vote avec 0 = mécontent, 1 = moyennement content et 2 = content.
    /// @param 'num' \b str, le num de série du boitier.
    /// @param 'date' \b datetime, la date du vote.
    /// @param 'id_question' \b int, l'identifiant de la question du vote.
    /// @param 'id_lieu' \b int, l'identifiant du lieu du vote.
    /// @return Si les paramètres sont \b conformes aux types souhaités alors la fonction \b insère le nouveau vote dans la base de données. 
    /// @return Si un ou plusieurs paramètres sont \b incorrectes la fonction affiche une \b erreur
    public static function insertVote($data)
    {
        try 
        {
            $sql = "INSERT INTO vote (smiley, Num_serie_boitier, timestamp_vote, id_question, id_lieu) VALUES (:vote, :num, :date, :id_question, :id_lieu)";
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

    /// Cette fonction permet de compter le nombre de votes pour un type de vote, un lieu, une question, un boitier et un jour.
    /// Tous les paramètres sont contenus dans un tableau $data .
    /// @param 'smiley' \b int, la valeur du vote avec 0 = mécontent, 1 = moyennement content et 2 = content.
    /// @param 'num_serie' \b str, le num de série du boitier.
    /// @param 'id_question' \b int, l'identifiant de la question du vote.
    /// @param 'id_lieu' \b int, l'identifiant du lieu du vote.
    /// @param 'int' \b int, le nombre de jour qu'on doit enlever à la date actuel.
    /// @result renvoie un \b objet \b sql qui correspond au tuple du nombre de votes pour un type de vote, un lieu, une question, un boitier et un jour tous données en paramètre.
    public static function countVotesJ($data)
    {
        try 
        {
                $sql = "SELECT count(*) avis FROM vote WHERE smiley = :smiley AND DATE(timestamp_vote) = subdate(CURDATE(), :int) AND num_serie_boitier = :num_serie AND id_question = :id_question AND id_lieu = :id_lieu";
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

    /// Cette fonction permet de compter le nombre de votes pour un type de vote et un jour.
    /// Tous les paramètres sont contenus dans un tableau $data .
    /// @param 'smiley' \b int, la valeur du vote avec 0 = mécontent, 1 = moyennement content et 2 = content.
    /// @param 'int' \b int, le nombre de jour qu'on doit enlever à la date actuel.
    /// @result renvoie un \b objet \b sql qui correspond au tuple du nombre de votes pour un type de vote et un jour données en paramètre.
    public static function countVotesJGlob($data)
    {
        try 
        {
                $sql = "SELECT count(*) avis FROM vote WHERE smiley = :smiley AND DATE(timestamp_vote) = subdate(CURDATE(), :int)";
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

    /// Cette fonction permet de compter le nombre de votes pour un type de vote, un lieu, une question, un boitier et un mois.
    /// Tous les paramètres sont contenus dans un tableau $data .
    /// @param 'smiley' \b int, la valeur du vote avec 0 = mécontent, 1 = moyennement content et 2 = content.
    /// @param 'num_serie' \b str, le num de série du boitier.
    /// @param 'id_question' \b int, l'identifiant de la question du vote.
    /// @param 'id_lieu' \b int, l'identifiant du lieu du vote.
    /// @param 'int' \b int, le nombre de mois qu'on doit enlever à la date actuel.
    /// @result renvoie un \b objet \b sql qui correspond au tuple du nombre de votes pour un type de vote, un lieu, une question, un boitier et un mois tous données en paramètre.
    public static function countVotesM($data)
    {
        try 
        {
                $sql = "SELECT count(*) avis FROM vote WHERE smiley = :smiley AND MONTH(DATE(timestamp_vote)) = MONTH(date_sub(now(), interval :int month)) AND YEAR(DATE(timestamp_vote)) = YEAR(date_sub(now(), interval :int month)) AND num_serie_boitier = :num_serie AND id_question = :id_question AND id_lieu = :id_lieu";
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

    /// Cette fonction permet de compter le nombre de votes pour un type de vote et un mois.
    /// Tous les paramètres sont contenus dans un tableau $data .
    /// @param 'smiley' \b int, la valeur du vote avec 0 = mécontent, 1 = moyennement content et 2 = content.
    /// @param 'int' \b int, le nombre de mois qu'on doit enlever à la date actuel.
    /// @result renvoie un \b objet \b sql qui correspond au tuple du nombre de votes pour un type de vote et un mois données en paramètre.
    public static function countVotesMGlob($data)
    {
        try 
        {
                $sql = "SELECT count(*) avis FROM vote WHERE smiley = :smiley AND MONTH(DATE(timestamp_vote)) = MONTH(date_sub(now(), interval :int month)) AND YEAR(DATE(timestamp_vote)) = YEAR(date_sub(now(), interval :int month))";
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

    /// Cette fonction permet de compter le nombre de votes pour un type de vote, un lieu, une question, un boitier et une heure.
    /// Tous les paramètres sont contenus dans un tableau $data .
    /// @param 'smiley' \b int, la valeur du vote avec 0 = mécontent, 1 = moyennement content et 2 = content.
    /// @param 'num_serie' \b str, le num de série du boitier.
    /// @param 'id_question' \b int, l'identifiant de la question du vote.
    /// @param 'id_lieu' \b int, l'identifiant du lieu du vote.
    /// @param 'int' \b int, le nombre d'heure qu'on doit enlever à l'horaire actuel.
    /// @result renvoie un \b objet \b sql qui correspond au tuple du nombre de votes pour un type de vote, un lieu, une question, un boitier et une heure tous données en paramètre.
    public static function countVotesH($data)
    {
        try 
        {
                $sql = "SELECT COUNT(*) avis FROM vote WHERE smiley = :smiley AND HOUR(timestamp_vote) = HOUR(DATE_SUB(NOW(), INTERVAL :int HOUR)) AND DATE(DATE_SUB(NOW(), INTERVAL :int HOUR)) = DATE(timestamp_vote) AND id_question = :id_question AND id_lieu = :id_lieu";
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

    /// Cette fonction permet de compter le nombre de votes pour un type de vote et une heure.
    /// Tous les paramètres sont contenus dans un tableau $data .
    /// @param 'smiley' \b int, la valeur du vote avec 0 = mécontent, 1 = moyennement content et 2 = content.
    /// @param 'int' \b int, le nombre de mois qu'on doit enlever à la date actuel.
    /// @result renvoie un \b objet \b sql qui correspond au tuple du nombre de votes pour un type de vote et une heure données en paramètre.
    public static function countVotesHGlob($data)
    {
        try 
        {
                $sql = "SELECT COUNT(*) avis FROM vote WHERE smiley = :smiley AND HOUR(timestamp_vote) = HOUR(DATE_SUB(NOW(), INTERVAL :int HOUR)) AND DATE(DATE_SUB(NOW(), INTERVAL :int HOUR)) = DATE(timestamp_vote)";
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

    /// Cette fonction permet de compter le nombre de votes satisfait lors du dernier mois.
    ///@param ne demande \b aucun \b paramètres
    /// @result renvoie un \b objet \b sql qui correspond au tuple du nombre de votes satisfait pour le mois passé.
    public static function countSatisfactionMensuel()
    {
        try 
        {
                $sql = "SELECT COUNT(*) satisfaction FROM vote v WHERE smiley = 2 AND v.timestamp_vote > DATE_SUB(NOW(), INTERVAL 1 MONTH)";
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

    /// Cette fonction permet de compter le nombre de votes lors du dernier mois.
    ///@param ne demande \b aucun \b paramètres
    /// @result renvoie un \b objet \b sql qui correspond au tuple du nombre de votes pour le mois passé.
    public static function countVotesMensuel()
    {
        try 
        {
                $sql = "SELECT COUNT(*) satisfaction FROM vote v WHERE v.timestamp_vote > DATE_SUB(NOW(), INTERVAL 1 MONTH)";
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

    /// Cette fonction permet de compter le nombre de votes des boitier lors de la dernière semaine.
    ///@param ne demande \b aucun \b paramètres
    /// @result renvoie un \b objet \b sql qui correspond au tuple du nombre de votes pour tous les boitiers lors de la semaine dernière.
    public static function countVotesThisWeek()
    {
        try 
        {
                $sql = "SELECT Num_serie_boitier, lieu, MAX(nb_vote) nb_vote
                        FROM
                        (SELECT b.Num_serie_boitier Num_serie_boitier, l.nom_lieu lieu, COUNT(*) nb_vote FROM vote v, boitier b, lieu l, question q WHERE b.Num_serie_boitier = v.Num_serie_boitier AND l.id_lieu = v.id_lieu AND q.id_question = v.id_question AND b.id_question = v.id_question AND b.id_lieu = v.id_lieu AND v.timestamp_vote > DATE_SUB(NOW(), INTERVAL 7 DAY) GROUP BY b.Num_serie_boitier, l.id_lieu, q.id_question UNION SELECT b.Num_serie_boitier Num_serie_boitier, l.nom_lieu lieu, '0' nb_satisfait FROM boitier b, lieu l WHERE l.id_lieu = b.id_lieu) t
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

    /// Cette fonction permet de compter le nombre de votes des boitier lors de la avant dernière semaine.
    ///@param ne demande \b aucun \b paramètres
    /// @result renvoie un \b objet \b sql qui correspond au tuple du nombre de votes pour tous les boitiers lors de l'avant dernière semaine.
    public static function countVotesLastWeek()
    {
        try 
        {
                $sql = "SELECT Num_serie_boitier, lieu, MAX(nb_vote) nb_vote
                        FROM
                        (SELECT b.Num_serie_boitier Num_serie_boitier, l.nom_lieu lieu, COUNT(*) nb_vote FROM vote v, boitier b, lieu l, question q WHERE b.Num_serie_boitier = v.Num_serie_boitier AND l.id_lieu = v.id_lieu AND q.id_question = v.id_question AND b.id_question = v.id_question AND b.id_lieu = v.id_lieu AND v.timestamp_vote <= DATE_SUB(NOW(), INTERVAL 7 DAY) AND v.timestamp_vote > DATE_SUB(NOW(), INTERVAL 14 DAY) GROUP BY b.Num_serie_boitier, l.id_lieu, q.id_question UNION SELECT b.Num_serie_boitier Num_serie_boitier, l.nom_lieu lieu, '0' nb_satisfait FROM boitier b, lieu l WHERE l.id_lieu = b.id_lieu) t
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

    /// Cette fonction permet de compter le nombre de votes satisfait par boitier lors de l'avant dernière semaine.
    ///@param ne demande \b aucun \b paramètres
    /// @result renvoie un \b objet \b sql qui correspond au tuple du nombre de votes satisfait par boitier lors de l'avant dernière semaine.
    public static function countVotes2LastWeek()
    {
        try 
        {
                $sql = "SELECT Num_serie_boitier, lieu, MAX(nb_satisfait) nb_satisfait
                        FROM
                        (SELECT b.Num_serie_boitier Num_serie_boitier, l.nom_lieu lieu, COUNT(*) nb_satisfait FROM vote v, boitier b, lieu l, question q WHERE b.Num_serie_boitier = v.Num_serie_boitier AND l.id_lieu = v.id_lieu AND q.id_question = v.id_question AND b.id_question = v.id_question AND b.id_lieu = v.id_lieu AND v.timestamp_vote <= DATE_SUB(NOW(), INTERVAL 7 DAY) AND v.timestamp_vote > DATE_SUB(NOW(), INTERVAL 14 DAY) AND smiley = 2 GROUP BY b.Num_serie_boitier, l.id_lieu, q.id_question UNION SELECT b.Num_serie_boitier Num_serie_boitier, l.nom_lieu lieu, '0' nb_satisfait FROM boitier b, lieu l WHERE l.id_lieu = b.id_lieu) t
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

    /// Cette fonction permet de compter le nombre de votes satisfait par boitier lors du dernier mois.
    ///@param ne demande \b aucun \b paramètres
    /// @result renvoie un \b objet \b sql qui correspond au tuple du nombre de votes satisfait par boitier pour le mois passé.
    public static function top5satisf()
    {
        try 
        {
                $sql = "SELECT Num_serie_boitier boitier, l.nom_lieu lieu, v.id_lieu id_lieu, COUNT(*) avis FROM vote v, lieu l WHERE smiley = 2 AND timestamp_vote >= date_sub(now(), interval 1 MONTH) AND l.id_lieu = v.id_lieu GROUP BY Num_serie_boitier, v.id_lieu ORDER BY avis DESC ";
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

    /// Cette fonction permet de compter le nombre de votes insatisfait par boitier lors du dernier mois.
    ///@param ne demande \b aucun \b paramètres
    /// @result renvoie un \b objet \b sql qui correspond au tuple du nombre de votes insatisfait par boitier pour le mois passé.
    public static function top5insatisf()
    {
        try 
        {
                $sql = "SELECT Num_serie_boitier boitier, l.nom_lieu lieu, v.id_lieu id_lieu, COUNT(*) avis FROM vote v, lieu l WHERE smiley = 0 AND timestamp_vote >= date_sub(now(), interval 1 MONTH) AND l.id_lieu = v.id_lieu GROUP BY Num_serie_boitier, v.id_lieu ORDER BY avis DESC";
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

    /// Cette fonction permet de compter le nombre de votes pour un un lieu et un boitier pour le mois dernier.
    /// Tous les paramètres sont contenus dans un tableau $data .
    /// @param 'id_lieu' \b int, l'id du lieu du boitier.
    /// @param 'num_serie_boitier' \b str, le numèro de série du boitier.
    /// @result renvoie un \b objet \b sql qui correspond au tuple du nombre de votes pour un lieu et un boitier données en paramètre.
    public static function top5total($data)
    {
        try 
        {
                $sql = "SELECT COUNT(*) avis_tot FROM vote v WHERE timestamp_vote >= date_sub(now(), interval 1 MONTH) AND v.id_lieu = :id_lieu AND Num_serie_boitier = :num_serie_boitier GROUP BY Num_serie_boitier, v.id_lieu";
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


