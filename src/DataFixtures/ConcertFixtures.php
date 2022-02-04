<?php

namespace App\DataFixtures;

use App\Entity\Concert;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ConcertFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $lasquadra = new Concert();
        $lasquadra->setName('Requiem')
            ->setDate(\DateTime::createFromFormat("d/m/Y", '02/01/2025'))
            ->setPrice(1000)
            ->setPictures($this->getReference(PictureFixtures::PICTURE_CONCERT_LASQUADRA_REFERENCE))
            ->setBand($this->getReference(BandFixtures::BAND_LASQUADRA_REFERENCE))
            ->setOrganization($this->getReference(OrganizationFixtures::ORGANIZATION_REFERENCE))
            ->setRoom($this->getReference(RoomFixtures::ROOM_COLISEUM_REFERENCE));
        $manager->persist($lasquadra);

        $espada = new Concert();
        $espada->setName('Las Noches')
            ->setDate(\DateTime::createFromFormat("d/m/Y", '13/10/2000'))
            ->setPrice(100000)
            ->setPictures($this->getReference(PictureFixtures::PICTURE_CONCERT_ESPADA_REFERENCE))
            ->setBand($this->getReference(BandFixtures::BAND_ESPADA_REFERENCE))
            ->setOrganization($this->getReference(OrganizationFixtures::ORGANIZATION_REFERENCE))
            ->setRoom($this->getReference(RoomFixtures::ROOM_HUECOMUNDO_REFERENCE));
        $manager->persist($espada);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PictureFixtures::class,
            BandFixtures::class,
            OrganizationFixtures::class,
            RoomFixtures::class,
        ];
    }
}
