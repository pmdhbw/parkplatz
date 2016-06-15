<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="masterstation")
*/

class MasterStation {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     */
    private $bahnhofsNummer;

    /**
    * @ORM\Column(type="integer")
    */
    private $timeCreated;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $station;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $cityTitle;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $street;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $plz;

    /**
    * @ORM\Column(type="float")
    */
    private $stationGeoLatitude;

    /**
    * @ORM\Column(type="float")
    */
    private $stationGeoLongitude;

    /**
     * Set bahnhofsNummer
     *
     * @param integer $bahnhofsNummer
     *
     * @return MasterStation
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
     * Set station
     *
     * @param string $station
     *
     * @return MasterStation
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
     * Set cityTitle
     *
     * @param string $cityTitle
     *
     * @return MasterStation
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
     * @return MasterStation
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
     * @return MasterStation
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
     * Set timeCreated
     *
     * @param integer $timeCreated
     *
     * @return MasterStation
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

    /**
     * Set stationGeoLatitude
     *
     * @param float $stationGeoLatitude
     *
     * @return MasterStation
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
     * @return MasterStation
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
