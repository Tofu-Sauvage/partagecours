<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setEmail("admin@blog.com")
        ->setPassword($this->encoder->encodePassword($admin, 'admin'))
        ->setRoles(['ROLE_ADMIN'])
        ->setName("Admin");
        $manager->persist($admin);
        $manager->flush();
    }
}
