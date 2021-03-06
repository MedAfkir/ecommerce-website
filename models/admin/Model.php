<?php

  namespace App\Models\Admin;

  use App\Db\Db;

  abstract class Model extends Db {
    // Table de la base de données
    protected $table;

    // Instance de connexion
    private $db;

    /**
     * Méthode qui exécutera les requêtes
     * @param string $sql Requête SQL à exécuter
     * @param array $attributes Attributs à ajouter à la requête 
     * @return PDOStatement | false 
     */
    public function requete(string $sql, array $attributs = null) {
        // On récupère l'instance de Db
        $this->db = Db::getInstance();

        // On vérifie si on a des attributs
        if($attributs !== null) {
            // Requête préparée
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            // Requête simple
            return $this->db->query($sql);
        }
    }

    /**
     * Sélection de tous les enregistrements d'une table
     * @return array Tableau des enregistrements trouvés
     */
    public function findAll() {
        $query = $this->requete('SELECT * FROM '.$this->table);
        return $query->fetchAll();
    }

    /**
     * Sélection de des enregistrements d'une table avec une limite suivant un ordre
     * @return array Tableau des enregistrements trouvés
     */
    public function findWithLimit($limit, $order = 'ASC') {
        if ($order != 'ASC' && $order != 'DESC')
            $order = 'ASC';

        $query = $this->requete('SELECT * FROM ' . $this->table . ' ORDER BY ' . $order . ' LIMIT ' . $limit);
        return $query->fetchAll();
    }

    /**
     * Sélection de plusieurs enregistrements suivant un tableau de critères
     * @param array $criteres Tableau de critères
     * @return array Tableau des enregistrements trouvés
     */
    public function findBy(array $criteres) {
        $champs = [];
        $valeurs = [];

        // On boucle pour "éclater le tableau"
        foreach($criteres as $champ => $valeur){
            $champs[] = "$champ = ?";
            $valeurs[]= $valeur;
        }

        // On transforme le tableau en chaîne de caractères séparée par des AND
        $liste_champs = implode(' AND ', $champs);

        // On exécute la requête
        return $this->requete("SELECT * FROM {$this->table} WHERE $liste_champs", $valeurs)->fetchAll();
    }

    /**
     * Sélection d'un enregistrement suivant son id
     * @param int $id id de l'enregistrement
     * @return array Tableau contenant l'enregistrement trouvé
     */
    public function find(int $id) {
        // On exécute la requête
        return $this->requete("SELECT * FROM {$this->table} WHERE id = $id")->fetch();
    }

    /**
     * Insertion d'un enregistrement suivant un tableau de données
     * @return bool
     */
    public function create($model) {
        $champs = [];
        $inter = [];
        $valeurs = [];

        // On boucle pour éclater le tableau
        foreach($model as $champ => $valeur){
            $champs[] = $champ;
            $inter[] = "?";
            $valeurs[] = $valeur;
        }

        // On transforme le tableau "champs" en une chaine de caractères
        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);

        // On exécute la requête
        return $this->requete('INSERT INTO '.$this->table.' ('. $liste_champs.') VALUES('.$liste_inter.')', $valeurs);
    }

    /**
     * Mise à jour d'un enregistrement suivant un tableau de données
     * @param int $id id de l'enregistrement à modifier
     * @param Model $model Objet à modifier
     * @return bool
     */
    public function update(int $id, $array = []) {
        $champs = [];
        $valeurs = [];

        // On boucle pour éclater le tableau
        foreach($array as $champ => $valeur) {
            $champs[] = "$champ = ?";
            $valeurs[] = $valeur;
        }
        $valeurs[] = $id;

        // On transforme le tableau "champs" en une chaine de caractères
        $liste_champs = implode(', ', $champs);

        // On exécute la requête
        return $this->requete('UPDATE '. $this->table .' SET '. $liste_champs.' WHERE id = ?', $valeurs);
    }

    /**
     * Suppression d'un enregistrement
     * @param int $id id de l'enregistrement à supprimer
     * @return bool 
     */
    public function delete(int $id) {
      return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    /**
     * Hydratation des données
     * @param array $donnees Tableau associatif des données
     * @return self Retourne l'objet hydraté
     */
    public function hydrate(array $donnees) {
        foreach ($donnees as $key => $value){
            // On récupère le nom du setter correspondant à l'attribut.
            $method = 'set' . str_replace(" ", "_", ucwords(str_replace("_", " ", $str)));

            // Si le setter correspondant existe.
            if (method_exists($this, $method)){
                // On appelle le setter.
                $this->$method($value);
            }
        }
        return $this;
    }
  }
