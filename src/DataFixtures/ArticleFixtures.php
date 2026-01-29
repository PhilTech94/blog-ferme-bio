<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $articles = [
            // Catégorie 0 : Fruits / Légumes
            [
                'title' => 'Les tomates de saison',
                'content' => 'Découvrez nos tomates bio cultivées en plein champ. Variétés anciennes et savoureuses, récoltées à maturité pour un goût incomparable. Cœur de bœuf, noires de Crimée, green zebra... il y en a pour tous les goûts !',
                'slug' => 'les-tomates-de-saison',
                'categories' => [0]
            ],
            [
                'title' => 'Les courges d\'automne',
                'content' => 'Butternut, potimarron, courge spaghetti... Nos courges sont cultivées sans pesticides et récoltées à la main. Parfaites pour vos soupes et gratins d\'hiver.',
                'slug' => 'les-courges-automne',
                'categories' => [0]
            ],
            [
                'title' => 'Nos pommes bio',
                'content' => 'Cette année, notre verger a donné une belle récolte. Pommes golden, reinettes et granny smith vous attendent. Idéales pour les compotes maison !',
                'slug' => 'nos-pommes-bio',
                'categories' => [0]
            ],

            // Catégorie 1 : Produits frais
            [
                'title' => 'Notre fromage de chèvre',
                'content' => 'Un fromage artisanal fabriqué à la ferme avec le lait de nos chèvres. Frais, demi-sec ou sec, choisissez votre affinage préféré.',
                'slug' => 'notre-fromage-de-chevre',
                'categories' => [1]
            ],
            [
                'title' => 'Les œufs frais de la ferme',
                'content' => 'Nos poules élevées en plein air pondent chaque jour des œufs savoureux. Jaune orangé garanti grâce à leur alimentation naturelle.',
                'slug' => 'les-oeufs-frais',
                'categories' => [1]
            ],
            [
                'title' => 'Le lait cru de nos vaches',
                'content' => 'Directement de la traite à votre table. Notre lait cru est disponible tous les matins. Idéal pour faire vos propres yaourts.',
                'slug' => 'lait-cru-vaches',
                'categories' => [1]
            ],

            // Catégorie 2 : Viande
            [
                'title' => 'Le poulet fermier',
                'content' => 'Nos poulets sont élevés en plein air pendant 120 jours minimum. Une chair ferme et goûteuse pour vos repas du dimanche.',
                'slug' => 'le-poulet-fermier',
                'categories' => [2]
            ],
            [
                'title' => 'Le porc plein air',
                'content' => 'Nos cochons vivent dehors toute l\'année. Côtes, rôtis, saucisses... une viande persillée et savoureuse.',
                'slug' => 'le-porc-plein-air',
                'categories' => [2]
            ],
            [
                'title' => 'L\'agneau de pré-salé',
                'content' => 'Élevés dans nos prairies naturelles, nos agneaux offrent une viande tendre aux saveurs délicates. Disponible à Pâques et à l\'automne.',
                'slug' => 'agneau-pre-sale',
                'categories' => [2]
            ],

            // Catégorie 3 : Actu du bio
            [
                'title' => 'Le bio en 2026',
                'content' => 'Les tendances du bio cette année : circuits courts, agroforesterie et permaculture. Le consommateur veut du local et du transparent.',
                'slug' => 'le-bio-en-2026',
                'categories' => [3]
            ],
            [
                'title' => 'Pourquoi manger bio ?',
                'content' => 'Santé, environnement, goût... Les raisons de passer au bio sont nombreuses. On vous explique tout dans cet article.',
                'slug' => 'pourquoi-manger-bio',
                'categories' => [3]
            ],
            [
                'title' => 'La ferme ouvre ses portes',
                'content' => 'Venez nous rencontrer le 15 juin prochain ! Visite des installations, dégustation de nos produits et atelier pour les enfants.',
                'slug' => 'ferme-portes-ouvertes',
                'categories' => [3, 0]  // Exemple : 2 catégories
            ],
        ];

        foreach ($articles as $index => $data) {
            $article = new Article();
            $article->setTitle($data['title']);
            $article->setContent($data['content']);
            $article->setSlug($data['slug']);

            foreach ($data['categories'] as $catIndex) {
                $article->addCategory($this->getReference('category_' . $catIndex, Category::class));
            }

            $manager->persist($article);
            $this->addReference('article_' . $index, $article);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [CategoryFixtures::class];
    }
}
