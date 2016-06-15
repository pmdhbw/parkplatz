<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="station")
*/

class Station {

    /**
     * @ORM\Column(type="string", nullable=true, length=20)
     */
    private $type;

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private $bahnhofsNummer;

    /**
     * @ORM\Column(type="string", nullable=true, length=30)
     */
    private $cityTitle;

    /**
     * @ORM\Column(type="string", nullable=true, length=30)
     */
    private $street;

    /**
     * @ORM\Column(type="string", nullable=true, length=5)
     */
    private $plz;

    /**
     * @ORM\Column(type="integer")
     */
    private $evaNummer;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isDbBahnpark;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isPublished;

    /**
     * @ORM\Column(type="string", nullable=true, nullable=true, length=10)
     */
    private $mainPicId;

    /**
     * @ORM\Column(type="string", nullable=true, length=10)
     */
    private $mainPicId_en;

    /**
     * @ORM\Column(type="string", nullable=true, length=30)
     */
    private $station;

    /**
    * @ORM\Column(type="float", nullable=true)
    */
    private $stationGeoLatitude;

    /**
    * @ORM\Column(type="float", nullable=true)
    */
    private $stationGeoLongitude;

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Station
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
     * Set bahnhofsNummer
     *
     * @param integer $bahnhofsNummer
     *
     * @return Station
     */
    public function setBahnhofsNummer($bahnhofsNummer)
    {
        $this->bahnhofsNummer = $bahnhofsNummer;

        return $this;
    }

    /**
     * Get bahnhofsNummer
     *
     * @return integer
     */
    public function getBahnhofsNummer()
    {
        return $this->bahnhofsNummer;
    }

    /**
     * Set cityTitle
     *
     * @param string $cityTitle
     *
     * @return Station
     */
    public function setCityTitle($cityTitle)
    {
        $this->cityTitle = $cityTitle;

        return $this;
    }

    /**
     * Get cityTitle
     *
     * @return string
     */
    public function getCityTitle()
    {
        return $this->cityTitle;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return Station
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set plz
     *
     * @param string $plz
     *
     * @return Station
     */
    public function setPlz($plz)
    {
        $this->plz = $plz;

        return $this;
    }

    /**
     * Get plz
     *
     * @return string
     */
    public function getPlz()
    {
        return $this->plz;
    }

    /**
     * Set evaNummer
     *
     * @param integer $evaNummer
     *
     * @return Station
     */
    public function setEvaNummer($evaNummer)
    {
        $this->evaNummer = $evaNummer;

        return $this;
    }

    /**
     * Get evaNummer
     *
     * @return integer
     */
    public function getEvaNummer()
    {
        return $this->evaNummer;
    }

    /**
     * Set isDbBahnpark
     *
     * @param boolean $isDbBahnpark
     *
     * @return Station
     */
    public function setIsDbBahnpark($isDbBahnpark)
    {
        $this->isDbBahnpark = $isDbBahnpark;

        return $this;
    }

    /**
     * Get isDbBahnpark
     *
     * @return boolean
     */
    public function getIsDbBahnpark()
    {
        return $this->isDbBahnpark;
    }

    /**
     * Set isPublished
     *
     * @param boolean $isPublished
     *
     * @return Station
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
     * Set mainPicId
     *
     * @param string $mainPicId
     *
     * @return Station
     */
    public function setMainPicId($mainPicId)
    {
        $this->mainPicId = $mainPicId;

        return $this;
    }

    /**
     * Get mainPicId
     *
     * @return string
     */
    public function getMainPicId()
    {
        return $this->mainPicId;
    }

    /**
     * Set mainPicIdEn
     *
     * @param string $mainPicIdEn
     *
     * @return Station
     */
    public function setMainPicIdEn($mainPicIdEn)
    {
        $this->mainPicId_en = $mainPicIdEn;

        return $this;
    }

    /**
     * Get mainPicIdEn
     *
     * @return string
     */
    public function getMainPicIdEn()
    {
        return $this->mainPicId_en;
    }

    /**
     * Set station
     *
     * @param string $station
     *
     * @return Station
     */
    public function setStation($station)
    {
        $this->station = $station;

        return $this;
    }

    /**
     * Get station
     *
     * @return string
     */
    public function getStation()
    {
        return $this->station;
    }

    /**
     * Set stationGeoLatitude
     *
     * @param float $stationGeoLatitude
     *
     * @return Station
     */
    public function setStationGeoLatitude($stationGeoLatitude)
    {
        $this->stationGeoLatitude = $stationGeoLatitude;

        return $this;
    }

    /**
     * Get stationGeoLatitude
     *
     * @return float
     */
    public function getStationGeoLatitude()
    {
        return $this->stationGeoLatitude;
    }

    /**
     * Set stationGeoLongitude
     *
     * @param float $stationGeoLongitude
     *
     * @return Station
     */
    public function setStationGeoLongitude($stationGeoLongitude)
    {
        $this->stationGeoLongitude = $stationGeoLongitude;

        return $this;
    }

    /**
     * Get stationGeoLongitude
     *
     * @return float
     */
    public function getStationGeoLongitude()
    {
        return $this->stationGeoLongitude;
    }
}
