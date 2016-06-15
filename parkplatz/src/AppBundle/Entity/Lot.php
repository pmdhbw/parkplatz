<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="lot")
*/

class Lot {

    /**
    * @ORM\Column(type="integer")
    */
    private $timeCreated;

    /**
    * @ORM\Column(type="string", nullable=true, length=20)
    */
    private $type;

    /**
    * @ORM\Column(type="string", nullable=true, length=100)
    */
    private $bundesland;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    private $isPublished;

    /**
    * @ORM\Column(type="string", nullable=true, length=200)
    */
    private $parkraumAusserBetriebText;

    /**
    * @ORM\Column(type="string", nullable=true, length=200)
    */
    private $parkraumAusserBetrieb_en;

    /**
    * @ORM\Column(type="string", nullable=true, length=100)
    */
    private $parkraumBahnhofName;

    /**
    * @ORM\Column(type="string", nullable=true, length=20)
    */
    private $parkraumBahnhofNummer;

    /**
    * @ORM\Column(type="string", nullable=true, length=50)
    */
    private $parkraumBemerkung;

    /**
    * @ORM\Column(type="string", nullable=true, length=50)
    */
    private $parkraumBemerkung_en;

    /**
    * @ORM\Column(type="string", nullable=true, length=50)
    */
    private $parkraumBetreiber;

    /**
    * @ORM\Column(type="string", nullable=true, length=50)
    */
    private $parkraumDisplayName;

    /**
    * @ORM\Column(type="string", nullable=true, length=10)
    */
    private $parkraumEntfernung;

    /**
    * @ORM\Column(type="float", nullable=true)
    */
    private $parkraumGeoLatitude;

    /**
    * @ORM\Column(type="float", nullable=true)
    */
    private $parkraumGeoLongitude;

    /**
    * @ORM\Column(type="string", nullable=true, length=4)
    */
    private $parkraumHausnummer;

    /**
    * @ORM\Column(type="string", length=10)
    * @ORM\Id
    */
    private $parkraumId;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    private $parkraumIsAusserBetrieb;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    private $parkraumIsDbBahnPark;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    private $parkraumIsOpenData;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    private $parkraumIsParktagesproduktDbFern;

        /**
    * @ORM\Column(type="string", nullable=true, length=10)
    */
    private $parkraumKennung;

        /**
    * @ORM\Column(type="string", nullable=true, length=40)
    */
    private $parkraumName;

    /**
    * @ORM\Column(type="string", nullable=true, length=25)
    */
    private $parkraumOeffnungszeiten;

    /**
    * @ORM\Column(type="string", nullable=true, length=25)
    */
    private $parkraumOeffnungszeiten_en;

    /**
    * @ORM\Column(type="string", nullable=true, length=25)
    */
    private $parkraumParkTypName;

    /**
    * @ORM\Column(type="string", nullable=true, length=25)
    */
    private $parkraumParkart;

    /**
    * @ORM\Column(type="string", nullable=true, length=25)
    */
    private $parkraumReservierung;

    /**
    * @ORM\Column(type="string", nullable=true, length=150)
    */
    private $parkraumSlogan;

    /**
    * @ORM\Column(type="string", nullable=true, length=150)
    */
    private $parkraumSlogan_en;

    /**
    * @ORM\Column(type="string", nullable=true, length=5)
    */
    private $parkraumStellplaetze;

    /**
    * @ORM\Column(type="string", nullable=true, length=30)
    */
    private $parkraumTechnik;

    /**
    * @ORM\Column(type="string", nullable=true, length=30)
    */
    private $parkraumTechnik_en;

    /**
    * @ORM\Column(type="string", nullable=true, length=75)
    */
    private $parkraumURL;

    /**
    * @ORM\Column(type="string", nullable=true, length=75)
    */
    private $parkraumZufahrt;

    /**
    * @ORM\Column(type="string", nullable=true, length=75)
    */
    private $parkraumZufahrt_en;

    /**
    * @ORM\Column(type="string", nullable=true, length=8)
    */
    private $tarif1MonatAutomat;

    /**
    * @ORM\Column(type="string", nullable=true, length=8)
    */
    private $tarif1MonatDauerparken;

    /**
    * @ORM\Column(type="string", nullable=true, length=8)
    */
    private $tarif1MonatDauerparkenFesterStellplatz;

    /**
    * @ORM\Column(type="string", nullable=true, length=5)
    */
    private $tarif1Std;

    /**
    * @ORM\Column(type="string", nullable=true, length=5)
    */
    private $tarif1Tag;

    /**
    * @ORM\Column(type="string", nullable=true, length=5)
    */
    private $tarif1TagRabattDB;

    /**
    * @ORM\Column(type="string", nullable=true, length=5)
    */
    private $tarif1Woche;

    /**
    * @ORM\Column(type="string", nullable=true, length=5)
    */
    private $tarif1WocheRabattDB;

    /**
    * @ORM\Column(type="string", nullable=true, length=5)
    */
    private $tarif20Min;

    /**
    * @ORM\Column(type="string", nullable=true, length=5)
    */
    private $tarif30Min;

    /**
    * @ORM\Column(type="string", nullable=true, length=30)
    */
    private $tarifBemerkung;

    /**
    * @ORM\Column(type="string", nullable=true, length=30)
    */
    private $tarifBemerkung_en;

    /**
    * @ORM\Column(type="string", nullable=true, length=5)
    */
    private $tarifFreiparkzeit;

    /**
    * @ORM\Column(type="string", nullable=true, length=5)
    */
    private $tarifFreiparkzeit_en;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    private $tarifMonatIsDauerparken;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    private $tarifMonatIsParkAndRide;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    private $tarifMonatIsParkscheinautomat;

     /**
    * @ORM\Column(type="string", nullable=true, length=50)
    */
    private $tarifParkdauer;

    /**
    * @ORM\Column(type="string", nullable=true, length=50)
    */
    private $tarifParkdauer_en;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    private $tarifRabattDBIsBahnCard;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    private $tarifRabattDBIsParkAndRail;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    private $tarifRabattDBIsbahncomfort;

    /**
    * @ORM\Column(type="string", nullable=true, length=5)
    */
    private $tarifSondertarif;

    /**
    * @ORM\Column(type="string", nullable=true, length=5)
    */
    private $tarifSondertarif_en;

    /**
    * @ORM\Column(type="string", nullable=true, length=5)
    */
    private $tarifWieRabattDB;

    /**
    * @ORM\Column(type="string", nullable=true, length=5)
    */
    private $tarifWieRabattDB_en;

    /**
    * @ORM\Column(type="string", nullable=true, length=5)
    */
    private $tarifWoVorverkaufDB;

    /**
    * @ORM\Column(type="string", nullable=true, length=5)
    */
    private $tarifWoVorverkaufDB_en;

    /**
    * @ORM\Column(type="string", nullable=true, length=5)
    */
    private $zahlungKundenkarten;

    /**
    * @ORM\Column(type="string", nullable=true, length=50)
    */
    private $zahlungMedien;

    /**
    * @ORM\Column(type="string", nullable=true, length=50)
    */
    private $zahlungMedien_en;

    /**
    * @ORM\Column(type="string", nullable=true, length=50)
    */
    private $zahlungMobil;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    private $validData;

    /**
    * @ORM\Column(type="string", nullable=true, length=19)
    */
    private $timestamp;

    /**
    * @ORM\Column(type="string", nullable=true, length=19)
    */
    private $timeSegment;

    /**
    * @ORM\Column(type="integer", nullable=true)
    */
    private $category;

    /**
    * @ORM\Column(type="string", nullable=true, length=5)
    */
    private $text;

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Lot
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set bundesland
     *
     * @param string $bundesland
     *
     * @return Lot
     */
    public function setBundesland($bundesland)
    {
        $this->bundesland = $bundesland;

        return $this;
    }

    /**
     * Get bundesland
     *
     * @return string
     */
    public function getBundesland()
    {
        return $this->bundesland;
    }

    /**
     * Set isPublished
     *
     * @param boolean $isPublished
     *
     * @return Lot
     */
    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;

        return $this;
    }

    /**
     * Get isPublished
     *
     * @return boolean
     */
    public function getIsPublished()
    {
        return $this->isPublished;
    }

    /**
     * Set parkraumAusserBetriebText
     *
     * @param string $parkraumAusserBetriebText
     *
     * @return Lot
     */
    public function setParkraumAusserBetriebText($parkraumAusserBetriebText)
    {
        $this->parkraumAusserBetriebText = $parkraumAusserBetriebText;

        return $this;
    }

    /**
     * Get parkraumAusserBetriebText
     *
     * @return string
     */
    public function getParkraumAusserBetriebText()
    {
        return $this->parkraumAusserBetriebText;
    }

    /**
     * Set parkraumAusserBetriebEn
     *
     * @param string $parkraumAusserBetriebEn
     *
     * @return Lot
     */
    public function setParkraumAusserBetriebEn($parkraumAusserBetriebEn)
    {
        $this->parkraumAusserBetrieb_en = $parkraumAusserBetriebEn;

        return $this;
    }

    /**
     * Get parkraumAusserBetriebEn
     *
     * @return string
     */
    public function getParkraumAusserBetriebEn()
    {
        return $this->parkraumAusserBetrieb_en;
    }

    /**
     * Set parkraumBahnhofName
     *
     * @param string $parkraumBahnhofName
     *
     * @return Lot
     */
    public function setParkraumBahnhofName($parkraumBahnhofName)
    {
        $this->parkraumBahnhofName = $parkraumBahnhofName;

        return $this;
    }

    /**
     * Get parkraumBahnhofName
     *
     * @return string
     */
    public function getParkraumBahnhofName()
    {
        return $this->parkraumBahnhofName;
    }

    /**
     * Set parkraumBahnhofNummer
     *
     * @param string $parkraumBahnhofNummer
     *
     * @return Lot
     */
    public function setParkraumBahnhofNummer($parkraumBahnhofNummer)
    {
        $this->parkraumBahnhofNummer = $parkraumBahnhofNummer;

        return $this;
    }

    /**
     * Get parkraumBahnhofNummer
     *
     * @return string
     */
    public function getParkraumBahnhofNummer()
    {
        return $this->parkraumBahnhofNummer;
    }

    /**
     * Set parkraumBemerkung
     *
     * @param string $parkraumBemerkung
     *
     * @return Lot
     */
    public function setParkraumBemerkung($parkraumBemerkung)
    {
        $this->parkraumBemerkung = $parkraumBemerkung;

        return $this;
    }

    /**
     * Get parkraumBemerkung
     *
     * @return string
     */
    public function getParkraumBemerkung()
    {
        return $this->parkraumBemerkung;
    }

    /**
     * Set parkraumBemerkungEn
     *
     * @param string $parkraumBemerkungEn
     *
     * @return Lot
     */
    public function setParkraumBemerkungEn($parkraumBemerkungEn)
    {
        $this->parkraumBemerkung_en = $parkraumBemerkungEn;

        return $this;
    }

    /**
     * Get parkraumBemerkungEn
     *
     * @return string
     */
    public function getParkraumBemerkungEn()
    {
        return $this->parkraumBemerkung_en;
    }

    /**
     * Set parkraumBetreiber
     *
     * @param string $parkraumBetreiber
     *
     * @return Lot
     */
    public function setParkraumBetreiber($parkraumBetreiber)
    {
        $this->parkraumBetreiber = $parkraumBetreiber;

        return $this;
    }

    /**
     * Get parkraumBetreiber
     *
     * @return string
     */
    public function getParkraumBetreiber()
    {
        return $this->parkraumBetreiber;
    }

    /**
     * Set parkraumDisplayName
     *
     * @param string $parkraumDisplayName
     *
     * @return Lot
     */
    public function setParkraumDisplayName($parkraumDisplayName)
    {
        $this->parkraumDisplayName = $parkraumDisplayName;

        return $this;
    }

    /**
     * Get parkraumDisplayName
     *
     * @return string
     */
    public function getParkraumDisplayName()
    {
        return $this->parkraumDisplayName;
    }

    /**
     * Set parkraumEntfernung
     *
     * @param string $parkraumEntfernung
     *
     * @return Lot
     */
    public function setParkraumEntfernung($parkraumEntfernung)
    {
        $this->parkraumEntfernung = $parkraumEntfernung;

        return $this;
    }

    /**
     * Get parkraumEntfernung
     *
     * @return string
     */
    public function getParkraumEntfernung()
    {
        return $this->parkraumEntfernung;
    }

    /**
     * Set parkraumGeoLatitude
     *
     * @param string $parkraumGeoLatitude
     *
     * @return Lot
     */
    public function setParkraumGeoLatitude($parkraumGeoLatitude)
    {
        $this->parkraumGeoLatitude = $parkraumGeoLatitude;

        return $this;
    }

    /**
     * Get parkraumGeoLatitude
     *
     * @return string
     */
    public function getParkraumGeoLatitude()
    {
        return $this->parkraumGeoLatitude;
    }

    /**
     * Set parkraumGeoLongitude
     *
     * @param string $parkraumGeoLongitude
     *
     * @return Lot
     */
    public function setParkraumGeoLongitude($parkraumGeoLongitude)
    {
        $this->parkraumGeoLongitude = $parkraumGeoLongitude;

        return $this;
    }

    /**
     * Get parkraumGeoLongitude
     *
     * @return string
     */
    public function getParkraumGeoLongitude()
    {
        return $this->parkraumGeoLongitude;
    }

    /**
     * Set parkraumHausnummer
     *
     * @param string $parkraumHausnummer
     *
     * @return Lot
     */
    public function setParkraumHausnummer($parkraumHausnummer)
    {
        $this->parkraumHausnummer = $parkraumHausnummer;

        return $this;
    }

    /**
     * Get parkraumHausnummer
     *
     * @return string
     */
    public function getParkraumHausnummer()
    {
        return $this->parkraumHausnummer;
    }

    /**
     * Set parkraumId
     *
     * @param string $parkraumId
     *
     * @return Lot
     */
    public function setParkraumId($parkraumId)
    {
        $this->parkraumId = $parkraumId;

        return $this;
    }

    /**
     * Get parkraumId
     *
     * @return string
     */
    public function getParkraumId()
    {
        return $this->parkraumId;
    }

    /**
     * Set parkraumIsAusserBetrieb
     *
     * @param boolean $parkraumIsAusserBetrieb
     *
     * @return Lot
     */
    public function setParkraumIsAusserBetrieb($parkraumIsAusserBetrieb)
    {
        $this->parkraumIsAusserBetrieb = $parkraumIsAusserBetrieb;

        return $this;
    }

    /**
     * Get parkraumIsAusserBetrieb
     *
     * @return boolean
     */
    public function getParkraumIsAusserBetrieb()
    {
        return $this->parkraumIsAusserBetrieb;
    }

    /**
     * Set parkraumIsDbBahnPark
     *
     * @param boolean $parkraumIsDbBahnPark
     *
     * @return Lot
     */
    public function setParkraumIsDbBahnPark($parkraumIsDbBahnPark)
    {
        $this->parkraumIsDbBahnPark = $parkraumIsDbBahnPark;

        return $this;
    }

    /**
     * Get parkraumIsDbBahnPark
     *
     * @return boolean
     */
    public function getParkraumIsDbBahnPark()
    {
        return $this->parkraumIsDbBahnPark;
    }

    /**
     * Set parkraumIsOpenData
     *
     * @param boolean $parkraumIsOpenData
     *
     * @return Lot
     */
    public function setParkraumIsOpenData($parkraumIsOpenData)
    {
        $this->parkraumIsOpenData = $parkraumIsOpenData;

        return $this;
    }

    /**
     * Get parkraumIsOpenData
     *
     * @return boolean
     */
    public function getParkraumIsOpenData()
    {
        return $this->parkraumIsOpenData;
    }

    /**
     * Set parkraumIsParktagesproduktDbFern
     *
     * @param boolean $parkraumIsParktagesproduktDbFern
     *
     * @return Lot
     */
    public function setParkraumIsParktagesproduktDbFern($parkraumIsParktagesproduktDbFern)
    {
        $this->parkraumIsParktagesproduktDbFern = $parkraumIsParktagesproduktDbFern;

        return $this;
    }

    /**
     * Get parkraumIsParktagesproduktDbFern
     *
     * @return boolean
     */
    public function getParkraumIsParktagesproduktDbFern()
    {
        return $this->parkraumIsParktagesproduktDbFern;
    }

    /**
     * Set parkraumKennung
     *
     * @param string $parkraumKennung
     *
     * @return Lot
     */
    public function setParkraumKennung($parkraumKennung)
    {
        $this->parkraumKennung = $parkraumKennung;

        return $this;
    }

    /**
     * Get parkraumKennung
     *
     * @return string
     */
    public function getParkraumKennung()
    {
        return $this->parkraumKennung;
    }

    /**
     * Set parkraumName
     *
     * @param string $parkraumName
     *
     * @return Lot
     */
    public function setParkraumName($parkraumName)
    {
        $this->parkraumName = $parkraumName;

        return $this;
    }

    /**
     * Get parkraumName
     *
     * @return string
     */
    public function getParkraumName()
    {
        return $this->parkraumName;
    }

    /**
     * Set parkraumOeffnungszeiten
     *
     * @param string $parkraumOeffnungszeiten
     *
     * @return Lot
     */
    public function setParkraumOeffnungszeiten($parkraumOeffnungszeiten)
    {
        $this->parkraumOeffnungszeiten = $parkraumOeffnungszeiten;

        return $this;
    }

    /**
     * Get parkraumOeffnungszeiten
     *
     * @return string
     */
    public function getParkraumOeffnungszeiten()
    {
        return $this->parkraumOeffnungszeiten;
    }

    /**
     * Set parkraumOeffnungszeitenEn
     *
     * @param string $parkraumOeffnungszeitenEn
     *
     * @return Lot
     */
    public function setParkraumOeffnungszeitenEn($parkraumOeffnungszeitenEn)
    {
        $this->parkraumOeffnungszeiten_en = $parkraumOeffnungszeitenEn;

        return $this;
    }

    /**
     * Get parkraumOeffnungszeitenEn
     *
     * @return string
     */
    public function getParkraumOeffnungszeitenEn()
    {
        return $this->parkraumOeffnungszeiten_en;
    }

    /**
     * Set parkraumParkTypName
     *
     * @param string $parkraumParkTypName
     *
     * @return Lot
     */
    public function setParkraumParkTypName($parkraumParkTypName)
    {
        $this->parkraumParkTypName = $parkraumParkTypName;

        return $this;
    }

    /**
     * Get parkraumParkTypName
     *
     * @return string
     */
    public function getParkraumParkTypName()
    {
        return $this->parkraumParkTypName;
    }

    /**
     * Set parkraumParkart
     *
     * @param string $parkraumParkart
     *
     * @return Lot
     */
    public function setParkraumParkart($parkraumParkart)
    {
        $this->parkraumParkart = $parkraumParkart;

        return $this;
    }

    /**
     * Get parkraumParkart
     *
     * @return string
     */
    public function getParkraumParkart()
    {
        return $this->parkraumParkart;
    }

    /**
     * Set parkraumReservierung
     *
     * @param string $parkraumReservierung
     *
     * @return Lot
     */
    public function setParkraumReservierung($parkraumReservierung)
    {
        $this->parkraumReservierung = $parkraumReservierung;

        return $this;
    }

    /**
     * Get parkraumReservierung
     *
     * @return string
     */
    public function getParkraumReservierung()
    {
        return $this->parkraumReservierung;
    }

    /**
     * Set parkraumSlogan
     *
     * @param string $parkraumSlogan
     *
     * @return Lot
     */
    public function setParkraumSlogan($parkraumSlogan)
    {
        $this->parkraumSlogan = $parkraumSlogan;

        return $this;
    }

    /**
     * Get parkraumSlogan
     *
     * @return string
     */
    public function getParkraumSlogan()
    {
        return $this->parkraumSlogan;
    }

    /**
     * Set parkraumSloganEn
     *
     * @param string $parkraumSloganEn
     *
     * @return Lot
     */
    public function setParkraumSloganEn($parkraumSloganEn)
    {
        $this->parkraumSlogan_en = $parkraumSloganEn;

        return $this;
    }

    /**
     * Get parkraumSloganEn
     *
     * @return string
     */
    public function getParkraumSloganEn()
    {
        return $this->parkraumSlogan_en;
    }

    /**
     * Set parkraumStellplaetze
     *
     * @param string $parkraumStellplaetze
     *
     * @return Lot
     */
    public function setParkraumStellplaetze($parkraumStellplaetze)
    {
        $this->parkraumStellplaetze = $parkraumStellplaetze;

        return $this;
    }

    /**
     * Get parkraumStellplaetze
     *
     * @return string
     */
    public function getParkraumStellplaetze()
    {
        return $this->parkraumStellplaetze;
    }

    /**
     * Set parkraumTechnik
     *
     * @param string $parkraumTechnik
     *
     * @return Lot
     */
    public function setParkraumTechnik($parkraumTechnik)
    {
        $this->parkraumTechnik = $parkraumTechnik;

        return $this;
    }

    /**
     * Get parkraumTechnik
     *
     * @return string
     */
    public function getParkraumTechnik()
    {
        return $this->parkraumTechnik;
    }

    /**
     * Set parkraumTechnikEn
     *
     * @param string $parkraumTechnikEn
     *
     * @return Lot
     */
    public function setParkraumTechnikEn($parkraumTechnikEn)
    {
        $this->parkraumTechnik_en = $parkraumTechnikEn;

        return $this;
    }

    /**
     * Get parkraumTechnikEn
     *
     * @return string
     */
    public function getParkraumTechnikEn()
    {
        return $this->parkraumTechnik_en;
    }

    /**
     * Set parkraumURL
     *
     * @param string $parkraumURL
     *
     * @return Lot
     */
    public function setParkraumURL($parkraumURL)
    {
        $this->parkraumURL = $parkraumURL;

        return $this;
    }

    /**
     * Get parkraumURL
     *
     * @return string
     */
    public function getParkraumURL()
    {
        return $this->parkraumURL;
    }

    /**
     * Set parkraumZufahrt
     *
     * @param string $parkraumZufahrt
     *
     * @return Lot
     */
    public function setParkraumZufahrt($parkraumZufahrt)
    {
        $this->parkraumZufahrt = $parkraumZufahrt;

        return $this;
    }

    /**
     * Get parkraumZufahrt
     *
     * @return string
     */
    public function getParkraumZufahrt()
    {
        return $this->parkraumZufahrt;
    }

    /**
     * Set parkraumZufahrtEn
     *
     * @param string $parkraumZufahrtEn
     *
     * @return Lot
     */
    public function setParkraumZufahrtEn($parkraumZufahrtEn)
    {
        $this->parkraumZufahrt_en = $parkraumZufahrtEn;

        return $this;
    }

    /**
     * Get parkraumZufahrtEn
     *
     * @return string
     */
    public function getParkraumZufahrtEn()
    {
        return $this->parkraumZufahrt_en;
    }

    /**
     * Set tarif1MonatAutomat
     *
     * @param string $tarif1MonatAutomat
     *
     * @return Lot
     */
    public function setTarif1MonatAutomat($tarif1MonatAutomat)
    {
        $this->tarif1MonatAutomat = $tarif1MonatAutomat;

        return $this;
    }

    /**
     * Get tarif1MonatAutomat
     *
     * @return string
     */
    public function getTarif1MonatAutomat()
    {
        return $this->tarif1MonatAutomat;
    }

    /**
     * Set tarif1MonatDauerparken
     *
     * @param string $tarif1MonatDauerparken
     *
     * @return Lot
     */
    public function setTarif1MonatDauerparken($tarif1MonatDauerparken)
    {
        $this->tarif1MonatDauerparken = $tarif1MonatDauerparken;

        return $this;
    }

    /**
     * Get tarif1MonatDauerparken
     *
     * @return string
     */
    public function getTarif1MonatDauerparken()
    {
        return $this->tarif1MonatDauerparken;
    }

    /**
     * Set tarif1MonatDauerparkenFesterStellplatz
     *
     * @param string $tarif1MonatDauerparkenFesterStellplatz
     *
     * @return Lot
     */
    public function setTarif1MonatDauerparkenFesterStellplatz($tarif1MonatDauerparkenFesterStellplatz)
    {
        $this->tarif1MonatDauerparkenFesterStellplatz = $tarif1MonatDauerparkenFesterStellplatz;

        return $this;
    }

    /**
     * Get tarif1MonatDauerparkenFesterStellplatz
     *
     * @return string
     */
    public function getTarif1MonatDauerparkenFesterStellplatz()
    {
        return $this->tarif1MonatDauerparkenFesterStellplatz;
    }

    /**
     * Set tarif1Std
     *
     * @param string $tarif1Std
     *
     * @return Lot
     */
    public function setTarif1Std($tarif1Std)
    {
        $this->tarif1Std = $tarif1Std;

        return $this;
    }

    /**
     * Get tarif1Std
     *
     * @return string
     */
    public function getTarif1Std()
    {
        return $this->tarif1Std;
    }

    /**
     * Set tarif1Tag
     *
     * @param string $tarif1Tag
     *
     * @return Lot
     */
    public function setTarif1Tag($tarif1Tag)
    {
        $this->tarif1Tag = $tarif1Tag;

        return $this;
    }

    /**
     * Get tarif1Tag
     *
     * @return string
     */
    public function getTarif1Tag()
    {
        return $this->tarif1Tag;
    }

    /**
     * Set tarif1TagRabattDB
     *
     * @param string $tarif1TagRabattDB
     *
     * @return Lot
     */
    public function setTarif1TagRabattDB($tarif1TagRabattDB)
    {
        $this->tarif1TagRabattDB = $tarif1TagRabattDB;

        return $this;
    }

    /**
     * Get tarif1TagRabattDB
     *
     * @return string
     */
    public function getTarif1TagRabattDB()
    {
        return $this->tarif1TagRabattDB;
    }

    /**
     * Set tarif1Woche
     *
     * @param string $tarif1Woche
     *
     * @return Lot
     */
    public function setTarif1Woche($tarif1Woche)
    {
        $this->tarif1Woche = $tarif1Woche;

        return $this;
    }

    /**
     * Get tarif1Woche
     *
     * @return string
     */
    public function getTarif1Woche()
    {
        return $this->tarif1Woche;
    }

    /**
     * Set tarif1WocheRabattDB
     *
     * @param string $tarif1WocheRabattDB
     *
     * @return Lot
     */
    public function setTarif1WocheRabattDB($tarif1WocheRabattDB)
    {
        $this->tarif1WocheRabattDB = $tarif1WocheRabattDB;

        return $this;
    }

    /**
     * Get tarif1WocheRabattDB
     *
     * @return string
     */
    public function getTarif1WocheRabattDB()
    {
        return $this->tarif1WocheRabattDB;
    }

    /**
     * Set tarif20Min
     *
     * @param string $tarif20Min
     *
     * @return Lot
     */
    public function setTarif20Min($tarif20Min)
    {
        $this->tarif20Min = $tarif20Min;

        return $this;
    }

    /**
     * Get tarif20Min
     *
     * @return string
     */
    public function getTarif20Min()
    {
        return $this->tarif20Min;
    }

    /**
     * Set tarif30Min
     *
     * @param string $tarif30Min
     *
     * @return Lot
     */
    public function setTarif30Min($tarif30Min)
    {
        $this->tarif30Min = $tarif30Min;

        return $this;
    }

    /**
     * Get tarif30Min
     *
     * @return string
     */
    public function getTarif30Min()
    {
        return $this->tarif30Min;
    }

    /**
     * Set tarifBemerkung
     *
     * @param string $tarifBemerkung
     *
     * @return Lot
     */
    public function setTarifBemerkung($tarifBemerkung)
    {
        $this->tarifBemerkung = $tarifBemerkung;

        return $this;
    }

    /**
     * Get tarifBemerkung
     *
     * @return string
     */
    public function getTarifBemerkung()
    {
        return $this->tarifBemerkung;
    }

    /**
     * Set tarifBemerkungEn
     *
     * @param string $tarifBemerkungEn
     *
     * @return Lot
     */
    public function setTarifBemerkungEn($tarifBemerkungEn)
    {
        $this->tarifBemerkung_en = $tarifBemerkungEn;

        return $this;
    }

    /**
     * Get tarifBemerkungEn
     *
     * @return string
     */
    public function getTarifBemerkungEn()
    {
        return $this->tarifBemerkung_en;
    }

    /**
     * Set tarifFreiparkzeit
     *
     * @param string $tarifFreiparkzeit
     *
     * @return Lot
     */
    public function setTarifFreiparkzeit($tarifFreiparkzeit)
    {
        $this->tarifFreiparkzeit = $tarifFreiparkzeit;

        return $this;
    }

    /**
     * Get tarifFreiparkzeit
     *
     * @return string
     */
    public function getTarifFreiparkzeit()
    {
        return $this->tarifFreiparkzeit;
    }

    /**
     * Set tarifFreiparkzeitEn
     *
     * @param string $tarifFreiparkzeitEn
     *
     * @return Lot
     */
    public function setTarifFreiparkzeitEn($tarifFreiparkzeitEn)
    {
        $this->tarifFreiparkzeit_en = $tarifFreiparkzeitEn;

        return $this;
    }

    /**
     * Get tarifFreiparkzeitEn
     *
     * @return string
     */
    public function getTarifFreiparkzeitEn()
    {
        return $this->tarifFreiparkzeit_en;
    }

    /**
     * Set tarifMonatIsDauerparken
     *
     * @param boolean $tarifMonatIsDauerparken
     *
     * @return Lot
     */
    public function setTarifMonatIsDauerparken($tarifMonatIsDauerparken)
    {
        $this->tarifMonatIsDauerparken = $tarifMonatIsDauerparken;

        return $this;
    }

    /**
     * Get tarifMonatIsDauerparken
     *
     * @return boolean
     */
    public function getTarifMonatIsDauerparken()
    {
        return $this->tarifMonatIsDauerparken;
    }

    /**
     * Set tarifMonatIsParkAndRide
     *
     * @param boolean $tarifMonatIsParkAndRide
     *
     * @return Lot
     */
    public function setTarifMonatIsParkAndRide($tarifMonatIsParkAndRide)
    {
        $this->tarifMonatIsParkAndRide = $tarifMonatIsParkAndRide;

        return $this;
    }

    /**
     * Get tarifMonatIsParkAndRide
     *
     * @return boolean
     */
    public function getTarifMonatIsParkAndRide()
    {
        return $this->tarifMonatIsParkAndRide;
    }

    /**
     * Set tarifMonatIsParkscheinautomat
     *
     * @param boolean $tarifMonatIsParkscheinautomat
     *
     * @return Lot
     */
    public function setTarifMonatIsParkscheinautomat($tarifMonatIsParkscheinautomat)
    {
        $this->tarifMonatIsParkscheinautomat = $tarifMonatIsParkscheinautomat;

        return $this;
    }

    /**
     * Get tarifMonatIsParkscheinautomat
     *
     * @return boolean
     */
    public function getTarifMonatIsParkscheinautomat()
    {
        return $this->tarifMonatIsParkscheinautomat;
    }

    /**
     * Set tarifParkdauer
     *
     * @param string $tarifParkdauer
     *
     * @return Lot
     */
    public function setTarifParkdauer($tarifParkdauer)
    {
        $this->tarifParkdauer = $tarifParkdauer;

        return $this;
    }

    /**
     * Get tarifParkdauer
     *
     * @return string
     */
    public function getTarifParkdauer()
    {
        return $this->tarifParkdauer;
    }

    /**
     * Set tarifParkdauerEn
     *
     * @param string $tarifParkdauerEn
     *
     * @return Lot
     */
    public function setTarifParkdauerEn($tarifParkdauerEn)
    {
        $this->tarifParkdauer_en = $tarifParkdauerEn;

        return $this;
    }

    /**
     * Get tarifParkdauerEn
     *
     * @return string
     */
    public function getTarifParkdauerEn()
    {
        return $this->tarifParkdauer_en;
    }

    /**
     * Set tarifRabattDBIsBahnCard
     *
     * @param boolean $tarifRabattDBIsBahnCard
     *
     * @return Lot
     */
    public function setTarifRabattDBIsBahnCard($tarifRabattDBIsBahnCard)
    {
        $this->tarifRabattDBIsBahnCard = $tarifRabattDBIsBahnCard;

        return $this;
    }

    /**
     * Get tarifRabattDBIsBahnCard
     *
     * @return boolean
     */
    public function getTarifRabattDBIsBahnCard()
    {
        return $this->tarifRabattDBIsBahnCard;
    }

    /**
     * Set tarifRabattDBIsParkAndRail
     *
     * @param boolean $tarifRabattDBIsParkAndRail
     *
     * @return Lot
     */
    public function setTarifRabattDBIsParkAndRail($tarifRabattDBIsParkAndRail)
    {
        $this->tarifRabattDBIsParkAndRail = $tarifRabattDBIsParkAndRail;

        return $this;
    }

    /**
     * Get tarifRabattDBIsParkAndRail
     *
     * @return boolean
     */
    public function getTarifRabattDBIsParkAndRail()
    {
        return $this->tarifRabattDBIsParkAndRail;
    }

    /**
     * Set tarifRabattDBIsbahncomfort
     *
     * @param boolean $tarifRabattDBIsbahncomfort
     *
     * @return Lot
     */
    public function setTarifRabattDBIsbahncomfort($tarifRabattDBIsbahncomfort)
    {
        $this->tarifRabattDBIsbahncomfort = $tarifRabattDBIsbahncomfort;

        return $this;
    }

    /**
     * Get tarifRabattDBIsbahncomfort
     *
     * @return boolean
     */
    public function getTarifRabattDBIsbahncomfort()
    {
        return $this->tarifRabattDBIsbahncomfort;
    }

    /**
     * Set tarifSondertarif
     *
     * @param string $tarifSondertarif
     *
     * @return Lot
     */
    public function setTarifSondertarif($tarifSondertarif)
    {
        $this->tarifSondertarif = $tarifSondertarif;

        return $this;
    }

    /**
     * Get tarifSondertarif
     *
     * @return string
     */
    public function getTarifSondertarif()
    {
        return $this->tarifSondertarif;
    }

    /**
     * Set tarifSondertarifEn
     *
     * @param string $tarifSondertarifEn
     *
     * @return Lot
     */
    public function setTarifSondertarifEn($tarifSondertarifEn)
    {
        $this->tarifSondertarif_en = $tarifSondertarifEn;

        return $this;
    }

    /**
     * Get tarifSondertarifEn
     *
     * @return string
     */
    public function getTarifSondertarifEn()
    {
        return $this->tarifSondertarif_en;
    }

    /**
     * Set tarifWieRabattDB
     *
     * @param string $tarifWieRabattDB
     *
     * @return Lot
     */
    public function setTarifWieRabattDB($tarifWieRabattDB)
    {
        $this->tarifWieRabattDB = $tarifWieRabattDB;

        return $this;
    }

    /**
     * Get tarifWieRabattDB
     *
     * @return string
     */
    public function getTarifWieRabattDB()
    {
        return $this->tarifWieRabattDB;
    }

    /**
     * Set tarifWieRabattDBEn
     *
     * @param string $tarifWieRabattDBEn
     *
     * @return Lot
     */
    public function setTarifWieRabattDBEn($tarifWieRabattDBEn)
    {
        $this->tarifWieRabattDB_en = $tarifWieRabattDBEn;

        return $this;
    }

    /**
     * Get tarifWieRabattDBEn
     *
     * @return string
     */
    public function getTarifWieRabattDBEn()
    {
        return $this->tarifWieRabattDB_en;
    }

    /**
     * Set tarifWoVorverkaufDB
     *
     * @param string $tarifWoVorverkaufDB
     *
     * @return Lot
     */
    public function setTarifWoVorverkaufDB($tarifWoVorverkaufDB)
    {
        $this->tarifWoVorverkaufDB = $tarifWoVorverkaufDB;

        return $this;
    }

    /**
     * Get tarifWoVorverkaufDB
     *
     * @return string
     */
    public function getTarifWoVorverkaufDB()
    {
        return $this->tarifWoVorverkaufDB;
    }

    /**
     * Set tarifWoVorverkaufDBEn
     *
     * @param string $tarifWoVorverkaufDBEn
     *
     * @return Lot
     */
    public function setTarifWoVorverkaufDBEn($tarifWoVorverkaufDBEn)
    {
        $this->tarifWoVorverkaufDB_en = $tarifWoVorverkaufDBEn;

        return $this;
    }

    /**
     * Get tarifWoVorverkaufDBEn
     *
     * @return string
     */
    public function getTarifWoVorverkaufDBEn()
    {
        return $this->tarifWoVorverkaufDB_en;
    }

    /**
     * Set zahlungKundenkarten
     *
     * @param string $zahlungKundenkarten
     *
     * @return Lot
     */
    public function setZahlungKundenkarten($zahlungKundenkarten)
    {
        $this->zahlungKundenkarten = $zahlungKundenkarten;

        return $this;
    }

    /**
     * Get zahlungKundenkarten
     *
     * @return string
     */
    public function getZahlungKundenkarten()
    {
        return $this->zahlungKundenkarten;
    }

    /**
     * Set zahlungMedien
     *
     * @param string $zahlungMedien
     *
     * @return Lot
     */
    public function setZahlungMedien($zahlungMedien)
    {
        $this->zahlungMedien = $zahlungMedien;

        return $this;
    }

    /**
     * Get zahlungMedien
     *
     * @return string
     */
    public function getZahlungMedien()
    {
        return $this->zahlungMedien;
    }

    /**
     * Set zahlungMedienEn
     *
     * @param string $zahlungMedienEn
     *
     * @return Lot
     */
    public function setZahlungMedienEn($zahlungMedienEn)
    {
        $this->zahlungMedien_en = $zahlungMedienEn;

        return $this;
    }

    /**
     * Get zahlungMedienEn
     *
     * @return string
     */
    public function getZahlungMedienEn()
    {
        return $this->zahlungMedien_en;
    }

    /**
     * Set zahlungMobil
     *
     * @param string $zahlungMobil
     *
     * @return Lot
     */
    public function setZahlungMobil($zahlungMobil)
    {
        $this->zahlungMobil = $zahlungMobil;

        return $this;
    }

    /**
     * Get zahlungMobil
     *
     * @return string
     */
    public function getZahlungMobil()
    {
        return $this->zahlungMobil;
    }

    /**
     * Set validData
     *
     * @param boolean $validData
     *
     * @return Lot
     */
    public function setValidData($validData)
    {
        $this->validData = $validData;

        return $this;
    }

    /**
     * Get validData
     *
     * @return boolean
     */
    public function getValidData()
    {
        return $this->validData;
    }

    /**
     * Set timestamp
     *
     * @param string $timestamp
     *
     * @return Lot
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set timeSegment
     *
     * @param string $timeSegment
     *
     * @return Lot
     */
    public function setTimeSegment($timeSegment)
    {
        $this->timeSegment = $timeSegment;

        return $this;
    }

    /**
     * Get timeSegment
     *
     * @return string
     */
    public function getTimeSegment()
    {
        return $this->timeSegment;
    }

    /**
     * Set category
     *
     * @param integer $category
     *
     * @return Lot
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return integer
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Lot
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set timeCreated
     *
     * @param integer $timeCreated
     *
     * @return Lot
     */
    public function setTimeCreated($timeCreated)
    {
        $this->timeCreated = $timeCreated;

        return $this;
    }

    /**
     * Get timeCreated
     *
     * @return integer
     */
    public function getTimeCreated()
    {
        return $this->timeCreated;
    }
}
