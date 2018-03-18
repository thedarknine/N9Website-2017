<?php
namespace N9Bundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Experience
 *
 * @ORM\Table(name="experience")
 * @ORM\Entity(repositoryClass="N9Bundle\Repository\ExperienceRepository")
 */
class Experience
{
    /**
     * @var int
     *
     * @ORM\Column(name="experience_id", type="integer")
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
     * @var \Date
     *
     * @ORM\Column(name="start_date", type="date")
     */
    private $startDate;

    /**
     * @var \Date
     *
     * @ORM\Column(name="end_date", type="date", nullable=true)
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitle", type="string", length=255)
     */
    private $subtitle;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
    /**
     * @ORM\ManyToOne(targetEntity="N9Bundle\Entity\Company")
     * @ORM\JoinColumn(name="company_id", referencedColumnName="company_id", nullable=false)
     */
    private $company;
    
    /**
     * @var ArrayCollection Skill $skills
     * Owning Side
     *
     * @ORM\ManyToMany(targetEntity="Skill")
     * @ORM\JoinTable(name="experience_skill",
     *   joinColumns={@ORM\JoinColumn(name="experience_id", referencedColumnName="experience_id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="skill_id", referencedColumnName="skill_id")}
     * )
     */
    private $skills;
    
    
    public function __construct()
    {
        $this->skills = new ArrayCollection();
    }

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
     * @return Experience
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
     * @return Experience
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
     * Set startDate
     *
     * @param \Date $startDate
     *
     * @return Experience
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \Date
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \Date $endDate
     *
     * @return Experience
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \Date
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set subtitle
     *
     * @param string $subtitle
     *
     * @return Experience
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get subtitle
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Experience
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set company
     *
     * @param string $company
     *
     * @return Company
     */
    public function setCompany(Company $company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }
    
    /**
     * Add Skill
     *
     * @param Skill $skill
     */
    public function addSkill(Skill $skill)
    {
        if (!$this->skills->contains($skill)) {
            $this->skills->add($skill);
        }
    }

    public function setSkills($items)
    {
        if ($items instanceof ArrayCollection || is_array($items)) {
            foreach ($items as $item) {
                $this->addSkill($item);
            }
        } elseif ($items instanceof Skill) {
            $this->addSkill($items);
        } else {
            throw new Exception("$items must be an instance of Produit or ArrayCollection");
        }
    }

    /**
    * Get ArrayCollection
    *
    * @return ArrayCollection $skills
    */
    public function getSkills()
    {
    return $this->skills;
    }
}

