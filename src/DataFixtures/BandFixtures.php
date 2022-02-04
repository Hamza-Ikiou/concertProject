<?php

namespace App\DataFixtures;

use App\Entity\Band;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class BandFixtures
 * @package App\DataFixtures
 */
class BandFixtures extends Fixture implements DependentFixtureInterface
{
    public const BAND_LASQUADRA_REFERENCE = 'band_lasquadra';
    public const BAND_ESPADA_REFERENCE = 'band_espada';
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $b1 = new Band();
        $b1->setName('La Squadra')
            ->setPictures($this->getReference(PictureFixtures::PICTURE_LASQUADRA_REFERENCE));
        $this->addReference(self::BAND_LASQUADRA_REFERENCE, $b1);
        $manager->persist($b1);

        $b1 = new Band();
        $b1->setName('Espada')
            ->setPictures($this->getReference(PictureFixtures::PICTURE_ESPADA_REFERENCE));
        $this->addReference(self::BAND_ESPADA_REFERENCE, $b1);
        $manager->persist($b1);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            PictureFixtures::class,
        ];
    }
}
