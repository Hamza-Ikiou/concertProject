<?php

namespace App\DataFixtures;

use App\Entity\Organization;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class OrganizationFixtures
 * @package App\DataFixtures
 */
class OrganizationFixtures extends Fixture implements DependentFixtureInterface
{
    public const ORGANIZATION_REFERENCE = 'organization';
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $o1 = new Organization();
        $o1->setName('SpeedWagon Foundation')
            ->setMail('sweedwagonfoundation@speed.com')
            ->setPhoneNumber('0601020304')
            ->setPictures($this->getReference(PictureFixtures::PICTURE_PESCI_REFERENCE));
        $this->addReference(self::ORGANIZATION_REFERENCE, $o1);
        $manager->persist($o1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PictureFixtures::class,
        ];
    }
}
