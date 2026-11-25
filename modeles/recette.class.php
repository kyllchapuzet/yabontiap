<?php

/**
 * @file    recette.class.php
 * @author  Antoine Moulin
 * @brief   Définit une classe permettant de représenter une Recette avec
 *          ses IngredientQuantifie et sa Categorie (entrée, dessert...)
 * @version 0.1
 * @date    02/09/2024
 */


/**
 * @brief Classe Recette pour représenter une recette de cuisine
 *
 * @details Cette classe permet de gérer les informations d'une recette, telles que
 * l'identifiant, le nom, la description, l'image, la catégorie et les ingrédients
 * quantifiés.
 *
 * La catégorie est représentée par un objet Categorie et les ingrédients sont
 * mémorisés dans un tableau d'objets IngredientQuantifie.
 */
class Recette
{
    private int|null $id;                 ///< Identifiant unique de la recette.
    private string|null $nom;             ///< Nom de la recette.
    private string|null $description;     ///< Description textuelle de la recette.
    private string|null $image;           ///< Chemin vers l'image illustrant la recette.
    private ?Categorie $categorie;        ///< Catégorie (entrée, plat, dessert...).
    private ?array $ingredientQuantifies;  ///< Liste d'IngredientQuantifie.

    public function __construct(?int $id = null, ?string $nom = null, ?string $description = null, ?string $image = null, ?Categorie $categorie = null, ?array $ingredientQuantifies = null)
    {
        $this->setId($id);
        $this->setNom($nom);
        $this->setDescription($description);
        $this->setImage($image);
        $this->setCategorie($categorie);
        $this->setIngredientQuantifies($ingredientQuantifies);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): void
    {
        $this->nom = $nom;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): void
    {
        $this->categorie = $categorie;
    }

    public function getIngredientQuantifies(): ?array
    {
        if ($this->ingredientQuantifies == null)
        {
            $db = Bd::getInstance();
            $pdo = $db->getConnection();
            $manager = new IngredientQuantifieDao($pdo);
            $this->ingredientQuantifies = $manager->findIngredientQuantifieByRecette($this->id);
        }
        return $this->ingredientQuantifies;
    }

    public function setIngredientQuantifies(?array $ingredientQuantifies): void
    {
        $this->ingredientQuantifies = $ingredientQuantifies;
    }
}
