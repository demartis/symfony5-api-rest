<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Contracts\Translation\TranslatorInterface;
use Faker\Factory;
use Faker\Generator;

class CategoryFixtures extends Fixture
{
    private $translator;
    private $faker;

    public function __construct(TranslatorInterface $translator, Generator $faker)
    {
        $this->translator = $translator;
        $this->faker = $faker;
    }
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Factory::create();
        $faker->addProvider(new \Faker\Provider\Lorem($faker));

        $locales = ['en', 'hr'];
        $data = [];

        foreach ($locales as $locale){
            $this->faker->seed(1234);
            $this->translator->setLocale($locale);

            for ($i=1; $i <= 10; $i++) { 
                $category = new Category();

                $category->setSlug('category-' . $i);
                $category->setTitle($this->translator->trans('Meal Category ' . $i));
                
                $data[] = $category;

                //$manager->persist($category);
                //$manager->flush();
            }
        }
        print_r($data);die;


    }
}
