<?php

namespace App\DataFixtures;

use App\Entity\Picture;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class PictureFixtures
 * @package App\DataFixtures
 */
class PictureFixtures extends Fixture
{
    public const PICTURE_LASQUADRA_REFERENCE = 'picture_lasquadra';
    public const PICTURE_CONCERT_LASQUADRA_REFERENCE = 'picture_concert_lasquadra';
    public const PICTURE_PESCI_REFERENCE = 'picture_pesci';
    public const PICTURE_PROSCIUTTO_REFERENCE = 'picture_prosciutto';
    public const PICTURE_RISOTTO_REFERENCE = 'picture_risotto';

    public const PICTURE_ESPADA_REFERENCE = 'picture_espada';
    public const PICTURE_CONCERT_ESPADA_REFERENCE = 'picture_concert_espada';
    public const PICTURE_BARRAGAN_REFERENCE = 'picture_barragan';
    public const PICTURE_GRIMMJOW_REFERENCE = 'picture_grimmjow';
    public const PICTURE_ULQUIORRA_REFERENCE = 'picture_ulquiorra';

    public const PICTURE_COLISEUM_REFERENCE = 'picture_coliseum';
    public const PICTURE_HUECOMUNDO_REFERENCE = 'picture_huecomundo';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $pesci = new Picture();
        $pesci->setName('Photo de Pesci')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~ikiouh/concertProject/public/images/pesci.png');
        $this->addReference(self::PICTURE_PESCI_REFERENCE, $pesci);
        $manager->persist($pesci);

        $prosciutto = new Picture();
        $prosciutto->setName('Photo de Prosciutto')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~ikiouh/concertProject/public/images/prosciutto.png');
        $this->addReference(self::PICTURE_PROSCIUTTO_REFERENCE, $prosciutto);
        $manager->persist($prosciutto);

        $risotto = new Picture();
        $risotto->setName('Photo de Risotto')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~ikiouh/concertProject/public/images/risotto.png');
        $this->addReference(self::PICTURE_RISOTTO_REFERENCE, $risotto);
        $manager->persist($risotto);

        $lasquadra = new Picture();
        $lasquadra->setName('Photo de LaSquadra')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~ikiouh/concertProject/public/images/laSquadra.png');
        $this->addReference(self::PICTURE_LASQUADRA_REFERENCE, $lasquadra);
        $manager->persist($lasquadra);

        $concertLasquadra = new Picture();
        $concertLasquadra->setName('Photo du concert de LaSquadra')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~ikiouh/concertProject/public/images/lasquadraConcert.png');
        $this->addReference(self::PICTURE_CONCERT_LASQUADRA_REFERENCE, $concertLasquadra);
        $manager->persist($concertLasquadra);

        $espada = new Picture();
        $espada->setName('Photo des Espada')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~ikiouh/concertProject/public/images/espada.png');
        $this->addReference(self::PICTURE_ESPADA_REFERENCE, $espada);
        $manager->persist($espada);

        $concertEspada = new Picture();
        $concertEspada->setName('Photo du concert des Espada')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~ikiouh/concertProject/public/images/espadaConcert.png');
        $this->addReference(self::PICTURE_CONCERT_ESPADA_REFERENCE, $concertEspada);
        $manager->persist($concertEspada);

        $barragan = new Picture();
        $barragan->setName('Photo de Barragan')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~ikiouh/concertProject/public/images/barragan.png');
        $this->addReference(self::PICTURE_BARRAGAN_REFERENCE, $barragan);
        $manager->persist($barragan);

        $grimmjow = new Picture();
        $grimmjow->setName('Photo de Grimmjow')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~ikiouh/concertProject/public/images/grimmjow.png');
        $this->addReference(self::PICTURE_GRIMMJOW_REFERENCE, $grimmjow);
        $manager->persist($grimmjow);

        $ulquiorra = new Picture();
        $ulquiorra->setName('Photo de Ulquiorra')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~ikiouh/concertProject/public/images/ulquiorra.png');
        $this->addReference(self::PICTURE_ULQUIORRA_REFERENCE, $ulquiorra);
        $manager->persist($ulquiorra);

        $coliseum = new Picture();
        $coliseum->setName('Photo de la salle du coliseum')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~ikiouh/concertProject/public/images/coliseum.png');
        $this->addReference(self::PICTURE_COLISEUM_REFERENCE, $coliseum);
        $manager->persist($coliseum);

        $huecomundo= new Picture();
        $huecomundo->setName('Photo de la salle du hueco mundo')
            ->setUrl('https://webinfo.iutmontp.univ-montp2.fr/~ikiouh/concertProject/public/images/huecomundo.png');
        $this->addReference(self::PICTURE_HUECOMUNDO_REFERENCE, $huecomundo);
        $manager->persist($huecomundo);

        $manager->flush();
    }
}
