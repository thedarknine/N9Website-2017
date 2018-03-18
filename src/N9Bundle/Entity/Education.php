<?php
namespace N9Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Education
 *
 * @ORM\Table(name="education")
 * @ORM\Entity(repositoryClass="N9Bundle\Repository\EducationRepository")
 */
class Education
{
    /**
     * @var int
     *
     * @ORM\Column(name="education_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="datetime", options={"default"="CURRENT_TIMESTAMP"})
     */
    private $createdDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_date", type="datetime", nullable=true, columnDefinition="DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP")
     */
    private $updatedDate;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="details", type="string", length=255, nullable=true)
     */
    private $details;

    /**
     * @var string
     *
     * @ORM\Column(name="speciality", type="string", length=255, nullable=true)
     */
    private $speciality;

    /**
     * @var string
     *
     * @ORM\Column(name="mention", type="string", length=255, nullable=true)
     */
    private $mention;

    /**
     * @ORM\ManyToOne(targetEntity="N9Bundle\Entity\School")
     * @ORM\JoinColumn(name="school_id", referencedColumnName="school_id", nullable=false)
     */
    private $school;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set createdDate
     *
     * @param \DateTime $createdDate
     *
     * @return Experience
     */
    public function setCreatedDate($createdDate)
    {
        if (!$this->createdDate) {
            $this->createdDate = new \DateTime();
        }
        
        return $this;
    }

    /**
     * Get createdDate
     *
     * @return \DateTime
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * Set updatedDate
     *
     * @param \DateTime $updatedDate
     *
     * @return Experience
     */
    public function setUpdatedDate($updatedDate)
    {
        $this->updatedDate = new \DateTime();

        return $this;
    }

    /**
     * Get updatedDate
     *
     * @return \DateTime
     */
    public function getUpdatedDate()
    {
        return $this->updatedDate;
    }

    /**
     * Set label
     *
     * @param string $label
     *
     * @return Education
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Education
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return Education
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set details
     *
     * @param string $details
     *
     * @return Education
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set speciality
     *
     * @param string $speciality
     *
     * @return Education
     */
    public function setSpeciality($speciality)
    {
        $this->speciality = $speciality;

        return $this;
    }

    /**
     * Get speciality
     *
     * @return string
     */
    public function getSpeciality()
    {
        return $this->speciality;
    }

    /**
     * Set mention
     *
     * @param string $mention
     *
     * @return Education
     */
    public function setMention($mention)
    {
        $this->mention = $mention;

        return $this;
    }

    /**
     * Get mention
     *
     * @return string
     */
    public function getMention()
    {
        return $this->mention;
    }

    /**
     * Set school
     *
     * @param string $school
     *
     * @return School
     */
    public function setSchool(School $school)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school
     *
     * @return string
     */
    public function getSchool()
    {
        return $this->school;
    }
}

