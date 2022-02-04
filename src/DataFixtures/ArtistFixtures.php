<?php


namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

/**
 * Class ArtistFixtures
 * @package App\DataFixtures
 */
class ArtistFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $pesci = new Artist();
        $pesci->setLastName('Pesci')
            ->setFirstName('Pesci')
            ->setMail('pesci@lasquadra.com')
            ->setDateOfBirth(\DateTime::createFromFormat("d/m/Y", '05/09/2000'))
            ->setBand($this->getReference(BandFixtures::BAND_LASQUADRA_REFERENCE))
            ->setPictures($this->getReference(PictureFixtures::PICTURE_PESCI_REFERENCE));
        $manager->persist($pesci);

        $prosciutto = new Artist();
        $prosciutto->setLastName('Prosciutto')
            ->setFirstName('Prosciutto')
            ->setMail('prosciutto@lasquadra.com')
            ->setDateOfBirth(\DateTime::createFromFormat("d/m/Y", '05/09/1974'))
            ->setBand($this->getReference(BandFixtures::BAND_LASQUADRA_REFERENCE))
            ->setPictures($this->getReference(PictureFixtures::PICTURE_PROSCIUTTO_REFERENCE));
        $manager->persist($prosciutto);

        $risotto = new Artist();
        $risotto->setLastName('Nero')
            ->setFirstName('Risotto')
            ->setMail('risotto@lasquadra.com')
            ->setDateOfBirth(\DateTime::createFromFormat("d/m/Y", '05/09/1974'))
            ->setBand($this->getReference(BandFixtures::BAND_LASQUADRA_REFERENCE))
            ->setPictures($this->getReference(PictureFixtures::PICTURE_RISOTTO_REFERENCE));
        $manager->persist($risotto);

        $barragan = new Artist();
        $barragan->setLastName('Luisenbarn')
            ->setFirstName('Barragan')
            ->setMail('barragan@espada.com')
            ->setDateOfBirth(\DateTime::createFromFormat("d/m/Y", '09/02/0000'))
            ->setBand($this->getReference(BandFixtures::BAND_ESPADA_REFERENCE))
            ->setPictures($this->getReference(PictureFixtures::PICTURE_BARRAGAN_REFERENCE));
        $manager->persist($barragan);

        $grimmjow = new Artist();
        $grimmjow->setLastName('Jaggerjack')
            ->setFirstName('Grimmjow')
            ->setMail('grimmjow@espada.com')
            ->setDateOfBirth(\DateTime::createFromFormat("d/m/Y", '31/07/0000'))
            ->setBand($this->getReference(BandFixtures::BAND_ESPADA_REFERENCE))
            ->setPictures($this->getReference(PictureFixtures::PICTURE_GRIMMJOW_REFERENCE));
        $manager->persist($grimmjow);

        $ulquiorra = new Artist();
        $ulquiorra->setLastName('Cifer')
            ->setFirstName('Ulquiorra')
            ->setMail('ulquiorra@espada.com')
            ->setDateOfBirth(\DateTime::createFromFormat("d/m/Y", '31/07/0000'))
            ->setBand($this->getReference(BandFixtures::BAND_ESPADA_REFERENCE))
            ->setPictures($this->getReference(PictureFixtures::PICTURE_ULQUIORRA_REFERENCE));
        $manager->persist($ulquiorra);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BandFixtures::class,
            PictureFixtures::class,
        ];
    }
}