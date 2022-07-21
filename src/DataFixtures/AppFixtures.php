<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $admin = (new User())
            ->setEmail('moderncars78@gmail.com')
            ->setRoles(['ROLE_ADMIN']);
        $adminPassword = $this->passwordHasher->hashPassword($admin, "moderncars");
        $admin->setPassword($adminPassword);
        $manager->persist($admin);
        $manager->flush();
    }
}
