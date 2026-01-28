<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PictureFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $pictures = [
            ['name' => 'tomates.jpg', 'article' => 0],
            ['name' => 'fromage.jpg', 'article' => 1],
            ['name' => 'poulet.jpg', 'article' => 2],
            ['name' => 'bio-2026.jpg', 'article' => 3],
        ];

        foreach ($pictures as $data) {
            $picture = new Picture();
            $picture->setName($data['name']);
            $picture->setArticle($this->getReference('article_' . $data['article'], Article::class));
            $manager->persist($picture);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [ArticleFixtures::class];
    }
}
