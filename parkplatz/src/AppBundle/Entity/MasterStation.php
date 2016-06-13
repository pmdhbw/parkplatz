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
}
