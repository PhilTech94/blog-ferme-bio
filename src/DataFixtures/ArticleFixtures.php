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
            [
                'title' => 'Les tomates de saison',
                'content' => 'Découvrez nos tomates bio cultivées en plein champ...',
                'slug' => 'les-tomates-de-saison',
                'categories' => [0]
            ],
            [
                'title' => 'Notre fromage de chèvre',
                'content' => 'Un fromage artisanal fabriqué à la ferme...',
                'slug' => 'notre-fromage-de-chevre',
                'categories' => [1]
            ],
            [
                'title' => 'Le poulet fermier',
                'content' => 'Nos poulets sont élevés en plein air...',
                'slug' => 'le-poulet-fermier',
                'categories' => [2]
            ],
            [
                'title' => 'Le bio en 2026',
                'content' => 'Les tendances du bio cette année...',
                'slug' => 'le-bio-en-2026',
                'categories' => [3]
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
