<?php

/*! \brief Fonctions de la table Admin
 *         
 * Cette classe contient les fonctions propres à la table Admin de la base de données.
 *  
 */

class ModelAdmin extends Model {
     
    /// Cette fonction modifie les informations d'un admin dans la base de données.
    /// Tous les paramètres suivants sont contenus dans un tableau $data.
    /// @param login \b string cette chaine de caractère est le login de l'admin.
    /// @param mdp \b string cette chaine de caractère est le mdp de l'admin.
    /// @return \b modifie les informations de l'admin.
    public static function modifAdmin($data)
    {
        try 
        {
            $sql = "UPDATE Admin SET  login=:login, mdp=:mdp WHERE id=:idAdmin";
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
    
    
    
    /// Cette fonction retourne l'id correspondant au login passé en paramètre
    /// Le paramètre suivant est contenu dans un tableau $data 
    /// @param Login \b string une chaine de caractère contenant un login.
    /// @return un \b objet \b sql contenant l'id de l'admin concerné
    public static function selectIdAdmin($data)
    {
        try
        {
            $sql = "SELECT id FROM admin WHERE login =:login";                       
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
    
    /// Cette fonction modifie le mot de passe d'un admin en fonction de l'id de l'admin passé en paramètre
    /// Les paramètres suivants sont contenus dans un tableau $data 
    /// @param newMdp \b string le nouveau mot de passe
    /// @param idMdp \b int l'identifiant de l'admin
    /// @return \b modifie le mot de passe de l'admin concerné
    public static function modifMdp($data)
    {
        try 
        {
            $sql = "UPDATE admin a SET a.mdp=:newMdp WHERE a.id = :idMdp ";
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
    
    
    /// Cette fonction retourne tous les champs d'un admin correspondant au login et au mot de passe passés en paramètre
    /// Les paramètres suivants sont contenus dans un tableau $data 
    /// @param login \b string le login d'un admin
    /// @param mdp \b string le mot de passe d'un admin
    /// @return un \b objet \b sql qui correspond aux champs du tuple de l'admin concerné
    public static function selectInfoConnect($data)
    {
        try
        {
            $sql = "SELECT * FROM admin WHERE login = :login AND mdp = :mdp";                       
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
    
    
    
    /// Cette fonction retourne tous les champs de tous les admins de la base de données
    /// @param \b pas \b de \paramètre string
    /// @return un \b objet \b sql qui correspond aux champs du tuple de l'admin concerné
    public static function selectAdmin()
    {
        try 
        {
                $sql = "SELECT  id, login FROM admin";                       
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