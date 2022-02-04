<?php

namespace App\DataFixtures;

use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class RoomFixtures
 * @package App\DataFixtures
 */
class RoomFixtures extends Fixture implements DependentFixtureInterface
{
    public const ROOM_COLISEUM_REFERENCE = 'room_coliseum';
    public const ROOM_HUECOMUNDO_REFERENCE = 'room_huecomundo';
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $coliseum = new Room();
        $coliseum->setName('Coliseum')
            ->setAddress('Italie')
            ->setNumberOfPlace(1000)
            ->setPictures($this->getReference(PictureFixtures::PICTURE_COLISEUM_REFERENCE));
        $this->addReference(self::ROOM_COLISEUM_REFERENCE, $coliseum);
        $manager->persist($coliseum);

        $huecomundo= new Room();
        $huecomundo->setName('HuecoMundo')
            ->setAddress('huecomundo')
            ->setNumberOfPlace(1000)
            ->setPictures($this->getReference(PictureFixtures::PICTURE_HUECOMUNDO_REFERENCE));
        $this->addReference(self::ROOM_HUECOMUNDO_REFERENCE, $huecomundo);
        $manager->persist($huecomundo);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PictureFixtures::class,
        ];
    }
}
