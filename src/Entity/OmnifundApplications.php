<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator As Validator;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use App\Filter\OrSearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;

/**
 * OmnifundApplications
 *
 * @ApiResource(
 *     shortName="applications",
 *     collectionOperations={
 *          "get"={"method"="GET"}
 *     },
 *     itemOperations={
 *          "get"={"method"="GET"},
 *          "put"={"method"="PUT"},
 *          "delete"={"method"="DELETE"}
 *     },
 *     normalizationContext={"groups"={"api:read"}}
 * )
 * @ApiFilter(OrSearchFilter::class, properties={
 *     "applicationHash": "start",
 *     "businessName": "partial",
 *     "businessEmail": "partial",
 *     "isoId": "partial"}
 * )
 * @ApiFilter(DateFilter::class, properties={"boardedAt": DateFilter::INCLUDE_NULL_BEFORE})
 * @ApiFilter(OrderFilter::class, arguments={"orderParameterName"="order"})
 *
 * @ORM\Table(name="omnifund_applications")
 * @ORM\Entity(repositoryClass="App\Repository\OmnifundApplicationsRepository")
 */
class OmnifundApplications implements UserInterface
{
    /**
     * @var int
     * @Groups("api:read")
     * @ORM\Column(name="application_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $applicationId;

    /**
     * @var string
     * @Groups("api:read")
     * @ORM\Column(name="application_hash", type="string", length=32, nullable=false)
     */
    private $applicationHash;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_info"}, message="Please provide a first name.")
     * @ORM\Column(name="business_contact_first", type="string", length=50, nullable=true)
     */
    private $businessContactFirst;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_info"}, message="Please provide a last name.")
     * @ORM\Column(name="business_contact_last", type="string", length=50, nullable=true)
     */
    private $businessContactLast;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_info"}, message="Please provide a business name.")
     * @ORM\Column(name="business_name", type="string", length=100, nullable=true)
     */
    private $businessName;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_info"}, message="Please provide a legal address.")
     * @ORM\Column(name="business_address1", type="string", length=150, nullable=true)
     */
    private $businessAddress1;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_info"}, message="")
     * @ORM\Column(name="business_city", type="string", length=50, nullable=true)
     */
    private $businessCity;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_info"}, message="")
     * @ORM\Column(name="business_state", type="string", length=20, nullable=true)
     */
    private $businessState;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_info"}, message="")
     * @Assert\Length(groups={"grp_business_info"}, min=5, minMessage="")
     * @ORM\Column(name="business_zip", type="string", length=10, nullable=true)
     */
    private $businessZip;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_info"}, message="Please provide a legal phone.")
     * @Assert\Length(groups={"grp_business_info"}, min=14, minMessage="Please provide a valid legal phone.")
     * @ORM\Column(name="business_phone", type="string", length=14, nullable=true)
     */
    private $businessPhone;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_info"}, message="Please provide a business email.")
     * @Assert\Email(groups={"grp_business_info"}, message="Please provide a valid email.")
     * @ORM\Column(name="business_email", type="string", length=150, nullable=true)
     */
    private $businessEmail;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_info"}, message="Please provide a Federal Tax ID.")
     * @Assert\Length(groups={"grp_business_info"}, min=9, minMessage="Please provide a valid Federal Tax ID.")
     * @ORM\Column(name="business_taxid", type="string", length=20, nullable=true)
     */
    private $businessTaxid;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_info"}, message="Please provide a DBA.")
     * @ORM\Column(name="business_dba", type="string", length=100, nullable=true)
     */
    private $businessDba;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_info"}, message="Please provide a DBA address.")
     * @ORM\Column(name="business_dba_address1", type="string", length=150, nullable=true)
     */
    private $businessDbaAddress1;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_info"}, message="")
     * @ORM\Column(name="business_dba_city", type="string", length=50, nullable=true)
     */
    private $businessDbaCity;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_info"}, message="")
     * @ORM\Column(name="business_dba_state", type="string", length=20, nullable=true)
     */
    private $businessDbaState;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_info"}, message="")
     * @Assert\Length(groups={"grp_business_info"}, min=5, minMessage="")
     * @ORM\Column(name="business_dba_zip", type="string", length=10, nullable=true)
     */
    private $businessDbaZip;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\Length(groups={"grp_business_info"}, min=14, minMessage="Please provide a valid DBA Phone.")
     * @ORM\Column(name="business_dba_phone", type="string", length=14, nullable=true)
     */
    private $businessDbaPhone;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\Length(groups={"grp_business_info"}, min=14, minMessage="Please provide a valid fax.")
     * @ORM\Column(name="business_fax", type="string", length=14, nullable=true)
     */
    private $businessFax;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\GreaterThan(0, groups={"grp_business_info"}, message="Please provide the number of locations.")
     * @ORM\Column(name="business_num_locations", type="string", length=5, nullable=true)
     */
    private $businessNumLocations;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="business_website", type="string", length=100, nullable=true)
     */
    private $businessWebsite;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_struc"}, message="Please select a ownership type.")
     * @ORM\Column(name="ownership_type", type="string", length=30, nullable=true)
     */
    private $ownershipType;

    /**
     * @var \DateTime|null
     * @Groups("api:read")
     * @ORM\Column(name="business_open_date", type="date", nullable=true)
     */
    private $businessOpenDate;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="currently_processing_cc", type="string", length=1, nullable=true)
     */
    private $currentlyProcessingCc;

    /**
     * @var int|null
     * @Groups("api:read")
     * @Assert\Expression(
     *     "(this.getSwipeF2FPercent() + this.getSwipeMOTOPercent() + this.getSwipeInternetPercent()) == 100",
     *     groups={"grp_card"}
     * )
     * @ORM\Column(name="swipe_f2f_percent", type="integer", nullable=true)
     */
    private $swipeF2fPercent;

    /**
     * @var int|null
     * @Groups("api:read")
     * @ORM\Column(name="swipe_moto_percent", type="integer", nullable=true)
     */
    private $swipeMotoPercent;

    /**
     * @var int|null
     * @Groups("api:read")
     * @ORM\Column(name="swipe_internet_percent", type="integer", nullable=true)
     */
    private $swipeInternetPercent;

    /**
     * @var int|null
     * @Groups("api:read")
     * @ORM\Column(name="tx_at_store", type="integer", nullable=true)
     */
    private $txAtStore;

    /**
     * @var int|null
     * @Groups("api:read")
     * @ORM\Column(name="tx_at_residence", type="integer", nullable=true)
     */
    private $txAtResidence;

    /**
     * @var int|null
     * @Groups("api:read")
     * @ORM\Column(name="tx_at_warehouse", type="integer", nullable=true)
     */
    private $txAtWarehouse;

    /**
     * @var int|null
     * @Groups("api:read")
     * @ORM\Column(name="tx_at_mobile", type="integer", nullable=true)
     */
    private $txAtMobile;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership"}, message="Please provide a first name.")
     * @ORM\Column(name="owner_first", type="string", length=50, nullable=true)
     */
    private $ownerFirst;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership"}, message="Please provide a last name.")
     * @ORM\Column(name="owner_last", type="string", length=50, nullable=true)
     */
    private $ownerLast;

    /**
     * @var \DateTime|null
     * @Groups("api:read")
     * @ORM\Column(name="owner_dob", type="date", nullable=true)
     */
    private $ownerDob;

    /**
     * @var int|null
     * @Groups("api:read")
     * @Assert\Range(
     *      min = 1,
     *      max = 100,
     *      groups={"grp_ownership"},
     *      notInRangeMessage = "Invalid percent.",
     * )
     * @ORM\Column(name="owner_percent", type="integer", nullable=true)
     */
    private $ownerPercent;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership_dl"}, message="Please provide a driver's license number.")
     * @ORM\Column(name="owner_dl", type="string", length=20, nullable=true)
     */
    private $ownerDl;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership_dl"}, message="Invalid state.")
     * @ORM\Column(name="owner_dl_state", type="string", length=20, nullable=true)
     */
    private $ownerDlState;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership"}, message="Please provide a SSN.")
     * @Assert\Length(groups={"grp_ownership"}, min=11, minMessage="Please provide a valid SSN.")
     * @ORM\Column(name="owner_ssn", type="string", length=11, nullable=true)
     */
    private $ownerSsn;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership"}, message="Please provide a home address.")
     * @ORM\Column(name="owner_address1", type="string", length=150, nullable=true)
     */
    private $ownerAddress1;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership"}, message="")
     * @ORM\Column(name="owner_city", type="string", length=50, nullable=true)
     */
    private $ownerCity;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership"}, message="")
     * @ORM\Column(name="owner_state", type="string", length=20, nullable=true)
     */
    private $ownerState;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership"}, message="")
     * @Assert\Length(groups={"grp_ownership"}, min=5, minMessage="")
     * @ORM\Column(name="owner_zip", type="string", length=10, nullable=true)
     */
    private $ownerZip;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership"}, message="Please provide a phone.")
     * @Assert\Length(groups={"grp_ownership"}, min=14, minMessage="Please provide a valid phone.")
     * @ORM\Column(name="owner_phone", type="string", length=14, nullable=true)
     */
    private $ownerPhone;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership"}, message="Please provide a valid email.")
     * @Assert\Email(groups={"grp_ownership"}, message="Please provide a valid email.")
     * @ORM\Column(name="owner_email", type="string", length=255, nullable=true)
     */
    private $ownerEmail;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="owner_lessthan_51pct", type="string", length=1, nullable=true)
     */
    private $ownerLessthan51pct;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership2"}, message="Please provide a first name.")
     * @ORM\Column(name="owner2_first", type="string", length=50, nullable=true)
     */
    private $owner2First;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership2"}, message="Please provide a first name.")
     * @ORM\Column(name="owner2_last", type="string", length=50, nullable=true)
     */
    private $owner2Last;

    /**
     * @var \DateTime|null
     * @Groups("api:read")
     * @Assert\NotNull(groups={"grp_ownership2"}, message="Please enter a valid date of birth.")
     * @ORM\Column(name="owner2_dob", type="date", nullable=true)
     */
    private $owner2Dob;

    /**
     * @var int|null
     * @Groups("api:read")
     * @Assert\Range(
     *      min = 1,
     *      max = 100,
     *      groups={"grp_ownership2"},
     *      notInRangeMessage = "Invalid percent.",
     * )
     * @ORM\Column(name="owner2_percent", type="integer", nullable=true)
     */
    private $owner2Percent;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership2_dl"}, message="Please provide a driver's license number.")
     * @ORM\Column(name="owner2_dl", type="string", length=20, nullable=true)
     */
    private $owner2Dl;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership2_dl"}, message="Invalid state.")
     * @ORM\Column(name="owner2_dl_state", type="string", length=20, nullable=true)
     */
    private $owner2DlState;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership2"}, message="Please provide a SSN.")
     * @Assert\Length(groups={"grp_ownership2"}, min=11, minMessage="Please provide a valid SSN.")
     * @ORM\Column(name="owner2_ssn", type="string", length=11, nullable=true)
     */
    private $owner2Ssn;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership2"}, message="Please provide a home address.")
     * @ORM\Column(name="owner2_address1", type="string", length=150, nullable=true)
     */
    private $owner2Address1;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership2"}, message="")
     * @ORM\Column(name="owner2_city", type="string", length=50, nullable=true)
     */
    private $owner2City;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership2"}, message="")
     * @ORM\Column(name="owner2_state", type="string", length=20, nullable=true)
     */
    private $owner2State;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership2"}, message="")
     * @Assert\Length(groups={"grp_ownership2"}, min=5, minMessage="")
     * @ORM\Column(name="owner2_zip", type="string", length=10, nullable=true)
     */
    private $owner2Zip;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership2"}, message="Please provide a phone.")
     * @Assert\Length(groups={"grp_ownership2"}, min=14, minMessage="Please provide a valid phone.")
     * @ORM\Column(name="owner2_phone", type="string", length=14, nullable=true)
     */
    private $owner2Phone;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership2"}, message="Please provide a valid email.")
     * @Assert\Email(groups={"grp_ownership2"}, message="Please provide a valid email.")
     * @ORM\Column(name="owner2_email", type="string", length=255, nullable=true)
     */
    private $owner2Email;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_bank"}, message="Please provide a name.")
     * @ORM\Column(name="bank_name_on_account", type="string", length=50, nullable=true)
     */
    private $bankNameOnAccount;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_bank"}, message="Please provide a bank name.")
     * @ORM\Column(name="bank_name", type="string", length=50, nullable=true)
     */
    private $bankName;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_bank"}, message="Please provide a phone.")
     * @Assert\Length(groups={"grp_business_bank"}, min=14, minMessage="Please provide a valid phone.")
     * @ORM\Column(name="bank_phone", type="string", length=14, nullable=true)
     */
    private $bankPhone;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_bank"}, message="Please provide a city.")
     * @ORM\Column(name="bank_city", type="string", length=50, nullable=true)
     */
    private $bankCity;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_bank"}, message="Invalid state.")
     * @ORM\Column(name="bank_state", type="string", length=20, nullable=true)
     */
    private $bankState;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Validator\ABA(groups={"grp_business_bank"})
     * @ORM\Column(name="bank_routing", type="string", length=20, nullable=true)
     */
    private $bankRouting;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_bank"}, message="Please provide bank account.")
     * @ORM\Column(name="bank_account", type="string", length=20, nullable=true)
     */
    private $bankAccount;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="avg_monthly_volume", type="decimal", precision=13, scale=2, nullable=true)
     * @Assert\GreaterThan(0, groups={"grp_card"}, message="Please provide a valid amount.")
     */
    private $avgMonthlyVolume;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="high_monthly_volume", type="decimal", precision=13, scale=2, nullable=true)
     * @Assert\GreaterThan(0, groups={"grp_card"}, message="Please provide a valid amount.")
     */
    private $highMonthlyVolume;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="avg_ticket", type="decimal", precision=13, scale=2, nullable=true)
     * @Assert\GreaterThan(0, groups={"grp_card"}, message="Please provide a valid amount.")
     */
    private $avgTicket;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="high_ticket", type="decimal", precision=13, scale=2, nullable=true)
     * @Assert\GreaterThan(0, groups={"grp_card"}, message="Please provide a valid amount.")
     */
    private $highTicket;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_struc"}, message="Please describe business products or services.")
     * @ORM\Column(name="business_description", type="string", length=500, nullable=true)
     */
    private $businessDescription;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="accept_advance", type="string", length=1, nullable=true)
     */
    private $acceptAdvance;

    /**
     * @var bool
     * @Groups("api:read")
     * @ORM\Column(name="advance_deposits", type="boolean", nullable=false)
     */
    private $advanceDeposits=false;

    /**
     * @var bool
     * @Groups("api:read")
     * @ORM\Column(name="advance_payment", type="boolean", nullable=false)
     */
    private $advancePayment=false;

    /**
     * @var bool
     * @Groups("api:read")
     * @ORM\Column(name="advance_membership", type="boolean", nullable=false)
     */
    private $advanceMembership=false;

    /**
     * @var int|null
     * @Groups("api:read")
     * @ORM\Column(name="advance_avg_deposits", type="integer", nullable=true)
     */
    private $advanceAvgDeposits;

    /**
     * @var int|null
     * @Groups("api:read")
     * @ORM\Column(name="advance_days_deposit_paid", type="integer", nullable=true)
     * @Assert\NotBlank(groups={"grp_accept_advance"}, message="Please select an option.")
     */
    private $advanceDaysDepositPaid;

    /**
     * @var int|null
     * @Groups("api:read")
     * @ORM\Column(name="advance_avg_service", type="integer", nullable=true)
     */
    private $advanceAvgService;

    /**
     * @var int|null
     * @Groups("api:read")
     * @ORM\Column(name="advance_pct_volume", type="integer", nullable=true)
     */
    private $advancePctVolume;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="seasonal", type="string", length=1, nullable=true)
     */
    private $seasonal;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="months_open", type="string", length=100, nullable=true)
     */
    private $monthsOpen;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="months_closed", type="string", length=100, nullable=true)
     */
    private $monthsClosed;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="fulfillment_performed_by", type="string", length=100, nullable=true)
     */
    private $fulfillmentPerformedBy;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_fulfillment_vendor"}, message="Please provide a vendor name.")
     * @ORM\Column(name="fulfillment_vendor", type="string", length=100, nullable=true)
     */
    private $fulfillmentVendor;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="accept_amex", type="string", length=1, nullable=true)
     */
    private $acceptAmex;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_amex"}, message="Please provide a merchant number.")
     * @ORM\Column(name="amex_number", type="string", length=30, nullable=true)
     */
    private $amexNumber;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="amex_cap", type="string", length=30, nullable=true)
     */
    private $amexCap;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\GreaterThan(0, groups={"grp_amex"}, message="Please provide a yearly volume.")
     * @ORM\Column(name="amex_volume", type="decimal", precision=13, scale=2, nullable=true)
     */
    private $amexVolume;

    /**
     * @var string|null
     * @Groups("api:read")
     * @Assert\GreaterThan(0, groups={"grp_amex"}, message="Please provide a average ticket.")
     * @ORM\Column(name="amex_avg_ticket", type="decimal", precision=13, scale=2, nullable=true)
     */
    private $amexAvgTicket;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="accept_ach", type="string", length=1, nullable=true)
     */
    private $acceptAch;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="debit_max_single_amount", type="decimal", precision=13, scale=2, nullable=true)
     * @Assert\GreaterThan(0, groups={"grp_ach"}, message="Please provide a valid amount.")
     */
    private $debitMaxSingleAmount;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="debit_max_daily_amount", type="decimal", precision=13, scale=2, nullable=true)
     * @Assert\Expression(
     *     "(this.getDebitMaxDailyAmount() >= this.getDebitMaxSingleAmount())",
     *     groups={"grp_ach"},
     *     message="(!) Please provide an amount greater than Max Single Amount."
     * )
     */
    private $debitMaxDailyAmount;

    /**
     * @var int|null
     * @Groups("api:read")
     * @ORM\Column(name="debit_max_daily_count", type="integer", nullable=true)
     * @Assert\GreaterThan(0, groups={"grp_ach"}, message="Please provide a valid amount.")
     */
    private $debitMaxDailyCount;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="debit_max_amount_14days", type="decimal", precision=13, scale=2, nullable=true)
     * @Assert\Expression(
     *     "(this.getDebitMaxAmount14days() > this.getDebitMaxDailyAmount())",
     *     groups={"grp_ach"},
     *     message="(!) Please provide an amount greater than Max Daily Amount."
     * )
     */
    private $debitMaxAmount14days;

    /**
     * @var int|null
     * @Groups("api:read")
     * @ORM\Column(name="debit_max_count_14days", type="integer", nullable=true)
     * @Assert\GreaterThan(0, groups={"grp_ach"}, message="Please provide a valid amount.")
     */
    private $debitMaxCount14days;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="credit_max_single_amount", type="decimal", precision=13, scale=2, nullable=true)
     * @Assert\GreaterThan(0, groups={"grp_ach"}, message="Please provide a valid amount.")
     */
    private $creditMaxSingleAmount;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="credit_max_daily_amount", type="decimal", precision=13, scale=2, nullable=true)
     * @Assert\Expression(
     *     "(this.getCreditMaxDailyAmount() >= this.getCreditMaxSingleAmount())",
     *     groups={"grp_ach"},
     *     message="(!) Please provide an amount greater than Max Single Amount."
     * )
     */
    private $creditMaxDailyAmount;

    /**
     * @var int|null
     * @Groups("api:read")
     * @ORM\Column(name="credit_max_daily_count", type="integer", nullable=true)
     * @Assert\GreaterThan(0, groups={"grp_ach"}, message="Please provide a valid amount.")
     */
    private $creditMaxDailyCount;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="credit_max_amount_14days", type="decimal", precision=13, scale=2, nullable=true)
     * @Assert\Expression(
     *     "(this.getCreditMaxAmount14days() > this.getCreditMaxDailyAmount())",
     *     groups={"grp_ach"},
     *     message="(!) Please provide an amount greater than Max Daily Amount."
     * )
     */
    private $creditMaxAmount14days;

    /**
     * @var int|null
     * @Groups("api:read")
     * @ORM\Column(name="credit_max_count_14days", type="integer", nullable=true)
     * @Assert\GreaterThan(0, groups={"grp_ach"}, message="Please provide a valid amount.")
     */
    private $creditMaxCount14days;

    /**
     * @var bool
     * @Groups("api:read")
     * @ORM\Column(name="sectype_ppd", type="boolean", nullable=false)
     */
    private $sectypePpd=false;

    /**
     * @var bool
     * @Groups("api:read")
     * @ORM\Column(name="sectype_ccd", type="boolean", nullable=false)
     */
    private $sectypeCcd=false;

    /**
     * @var bool
     * @Groups("api:read")
     * @ORM\Column(name="sectype_tel", type="boolean", nullable=false)
     */
    private $sectypeTel=false;

    /**
     * @var bool
     * @Groups("api:read")
     * @ORM\Column(name="sectype_web", type="boolean", nullable=false)
     */
    private $sectypeWeb=false;

    /**
     * @var bool
     * @Groups("api:read")
     * @ORM\Column(name="sectype_pop", type="boolean", nullable=false)
     */
    private $sectypePop=false;

    /**
     * @var bool
     * @Groups("api:read")
     * @ORM\Column(name="sectype_check21", type="boolean", nullable=false)
     */
    private $sectypeCheck21=false;

    /**
     * @var string|null
     * @Groups("api:read")
     * @ORM\Column(name="iso_id", type="string", length=50, nullable=true)
     */
    private $isoId;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=255)
     */
    private $step = 'register_welcome';

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $acceptCC;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $currentlyProcessingAch;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $achVerification;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $softwareIntegration;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $softwareIntegrationOther;

    /**
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_info"}, message="Please provide at least one value.")
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $heardAbout;

    /**
     * @Groups("api:read")
     * @ORM\OneToMany(targetEntity="App\Entity\OmnifundApplicationsDocs", mappedBy="application", cascade={"persist", "remove"}))
     */
    private $applicationDocs;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $boardedAt;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="boolean")
     */
    private $sectypeArc=false;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="boolean")
     */
    private $sectypeBoc=false;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $achEquipment;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $ccEquipment;

    /**
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership"}, message="Please select a ownership title.")
     * @ORM\Column(name="owner_title", type="string", length=100, nullable=true)
     */
    private $ownerTitle;

    /**
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_ownership2"}, message="Please select a ownership title.")
     * @ORM\Column(name="owner2_title", type="string", length=100, nullable=true)
     */
    private $owner2Title;

    /**
     * @Groups("api:read")
     * @Validator\ABA(groups={"grp_business_bank2"})
     * @ORM\Column(name="bank2_routing", type="string", length=20, nullable=true)
     */
    private $bank2Routing;

    /**
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_bank2"}, message="Please provide bank account.")
     * @ORM\Column(name="bank2_account", type="string", length=20, nullable=true)
     */
    private $bank2Account;

    /**
     * @Groups("api:read")
     * @Assert\NotBlank(groups={"grp_business_bank2"}, message="Please select an option.")
     * @ORM\Column(name="bank2_usedfor", type="string", length=100, nullable=true)
     */
    private $bank2Usedfor;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $bank2;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $mccCode;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="boolean")
     */
    private $sectypeRck=false;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $compliantPci;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(groups={"grp_pci_assessment"}, message="Please provide a valid certificate number.")
     */
    private $pciCertNumber;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="date", nullable=true)
     * @Assert\NotNull(groups={"grp_pci_yes"}, message="Please enter a valid certification date.")
     */
    private $pciCertDate;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(groups={"grp_pci_no"}, message="Please select an option.")
     */
    private $pciPaymentPlan;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="decimal", precision=13, scale=2, nullable=true)
     * @Assert\GreaterThan(0, groups={"grp_card"}, message="Please provide a valid annual volume.")
     */
    private $annualVolume;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $storeCardholder;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank(groups={"grp_card"}, message="Please select an option.")
     */
    private $goodServicesOn;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank(groups={"grp_card"}, message="Please select an option.")
     */
    private $goodServicesDelivered;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank(groups={"grp_business_bank"}, message="Please select a bank type.")
     */
    private $bankType;

    /**
     * @Groups("api:read")
     * @ORM\Column(name="bank2_type", type="string", length=100, nullable=true)
     * @Assert\NotBlank(groups={"grp_business_bank2"}, message="Please select a bank type.")
     */
    private $bank2Type;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\NotBlank(groups={"grp_business_struc"}, message="Please select an option.")
     */
    private $refundPolicy;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $refundPolicyOther;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\NotBlank(groups={"grp_business_struc"}, message="Please select an option.")
     */
    private $locationType;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $txAtRestaurant;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $txAtInternet;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\NotBlank(groups={"grp_fulfillment_vendor"}, message="Please provide a vendor contact info.")
     */
    private $fulfillmentContact;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $fulfillmentPci;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\GreaterThan(0, groups={"grp_fulfillment_vendor"}, message="Please provide a percentual of shipments.")
     */
    private $fulfillmentPercent;

    /**
     * @var array|null
     * @Groups("api:read")
     * @ORM\Column(type="array", length=255, nullable=true)
     * @Assert\NotBlank(groups={"grp_seasonal"}, message="Please select at least one month.")
     */
    private $activeMonths=[];

    /**
     * @Groups("api:read")
     * @ORM\Column(type="boolean")
     * @Assert\Expression(
     *     "(this.getStorePaper() or this.getStoreElectronic())",
     *     groups={"grp_store_cardholder"}
     * )
     */
    private $storePaper=false;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="boolean")
     */
    private $storeElectronic=false;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(groups={"grp_pci_assessment"}, message="Please provide a valid security assessor.")
     */
    private $pciSecAssessor;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $pciSelfAssessment;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $accCompromise;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $accRemediation;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="decimal", precision=13, scale=2, nullable=true)
     * @Assert\GreaterThan(0, groups={"grp_ach"}, message="Please provide a valid amount.")
     */
    private $achAvgTransaction;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="decimal", precision=13, scale=2, nullable=true)
     * @Assert\GreaterThan(0, groups={"grp_ach"}, message="Please provide a valid amount.")
     */
    private $achAvgMonthly;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="decimal", precision=13, scale=2, nullable=true)
     * @Assert\GreaterThan(0, groups={"grp_ach"}, message="Please provide a valid amount.")
     */
    private $achHighMonthly;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="decimal", precision=13, scale=2, nullable=true)
     */
    private $achHighTicket;

    /**
     * @var array|null
     * @Groups("api:read")
     * @ORM\Column(type="array", nullable=true)
     */
    private $merchantAdvertise = [];

    /**
     * @Groups("api:read")
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\LessThanOrEqual(100, groups={"grp_card"}, message="Please provide a valid percentage (0-100)")
     */
    private $b2bPercent;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $b2bMerchant;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $merchantAdvertiseWeb;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $merchantAdvertiseEmail;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(groups={"grp_advertise_other"}, message="Please provide a valid information.")
     */
    private $merchantAdvertiseOther;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="text", nullable=true)
     */
    private $notes;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $merchantId;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="json")
     */
    private $agreement = [];

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $buyerBankStatement;

    /**
     * @Groups("api:read")
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $phoneBankStatement;

    public function __construct()
    {
        $this->createdAt = new \DateTime('now', new \DateTimeZone('UTC'));
        $this->applicationDocs = new ArrayCollection();
    }

    public function getApplicationId(): ?int
    {
        return $this->applicationId;
    }

    public function getApplicationHash(): ?string
    {
        return $this->applicationHash;
    }

    public function setApplicationHash(string $applicationHash): self
    {
        $this->applicationHash = $applicationHash;

        return $this;
    }

    public function getBusinessContactFirst(): ?string
    {
        return $this->businessContactFirst;
    }

    public function setBusinessContactFirst(?string $businessContactFirst): self
    {
        $this->businessContactFirst = $businessContactFirst;

        return $this;
    }

    public function getBusinessContactLast(): ?string
    {
        return $this->businessContactLast;
    }

    public function setBusinessContactLast(?string $businessContactLast): self
    {
        $this->businessContactLast = $businessContactLast;

        return $this;
    }

    public function getBusinessName(): ?string
    {
        return $this->businessName;
    }

    public function setBusinessName(?string $businessName): self
    {
        $this->businessName = $businessName;

        return $this;
    }

    public function getBusinessAddress1(): ?string
    {
        return $this->businessAddress1;
    }

    public function setBusinessAddress1(?string $businessAddress1): self
    {
        $this->businessAddress1 = $businessAddress1;

        return $this;
    }

    public function getBusinessCity(): ?string
    {
        return $this->businessCity;
    }

    public function setBusinessCity(?string $businessCity): self
    {
        $this->businessCity = $businessCity;

        return $this;
    }

    public function getBusinessState(): ?string
    {
        return $this->businessState;
    }

    public function setBusinessState(?string $businessState): self
    {
        $this->businessState = $businessState;

        return $this;
    }

    public function getBusinessZip(): ?string
    {
        return $this->businessZip;
    }

    public function setBusinessZip(?string $businessZip): self
    {
        $this->businessZip = $businessZip;

        return $this;
    }

    public function getBusinessPhone(): ?string
    {
        return $this->businessPhone;
    }

    public function setBusinessPhone(?string $businessPhone): self
    {
        $this->businessPhone = $businessPhone;

        return $this;
    }

    public function getBusinessEmail(): ?string
    {
        return $this->businessEmail;
    }

    public function setBusinessEmail(?string $businessEmail): self
    {
        $this->businessEmail = $businessEmail;

        return $this;
    }

    public function getBusinessTaxid(): ?string
    {
        return $this->businessTaxid;
    }

    public function setBusinessTaxid(?string $businessTaxid): self
    {
        $this->businessTaxid = $businessTaxid;

        return $this;
    }

    public function getBusinessDba(): ?string
    {
        return $this->businessDba;
    }

    public function setBusinessDba(?string $businessDba): self
    {
        $this->businessDba = $businessDba;

        return $this;
    }

    public function getBusinessDbaAddress1(): ?string
    {
        return $this->businessDbaAddress1;
    }

    public function setBusinessDbaAddress1(?string $businessDbaAddress1): self
    {
        $this->businessDbaAddress1 = $businessDbaAddress1;

        return $this;
    }

    public function getBusinessDbaCity(): ?string
    {
        return $this->businessDbaCity;
    }

    public function setBusinessDbaCity(?string $businessDbaCity): self
    {
        $this->businessDbaCity = $businessDbaCity;

        return $this;
    }

    public function getBusinessDbaState(): ?string
    {
        return $this->businessDbaState;
    }

    public function setBusinessDbaState(?string $businessDbaState): self
    {
        $this->businessDbaState = $businessDbaState;

        return $this;
    }

    public function getBusinessDbaZip(): ?string
    {
        return $this->businessDbaZip;
    }

    public function setBusinessDbaZip(?string $businessDbaZip): self
    {
        $this->businessDbaZip = $businessDbaZip;

        return $this;
    }

    public function getBusinessDbaPhone(): ?string
    {
        return $this->businessDbaPhone;
    }

    public function setBusinessDbaPhone(?string $businessDbaPhone): self
    {
        $this->businessDbaPhone = $businessDbaPhone;

        return $this;
    }

    public function getBusinessFax(): ?string
    {
        return $this->businessFax;
    }

    public function setBusinessFax(?string $businessFax): self
    {
        $this->businessFax = $businessFax;

        return $this;
    }

    public function getBusinessNumLocations(): ?string
    {
        return $this->businessNumLocations;
    }

    public function setBusinessNumLocations(?string $businessNumLocations): self
    {
        $this->businessNumLocations = $businessNumLocations;

        return $this;
    }

    public function getBusinessWebsite(): ?string
    {
        return $this->businessWebsite;
    }

    public function setBusinessWebsite(?string $businessWebsite): self
    {
        $this->businessWebsite = $businessWebsite;

        return $this;
    }

    public function getOwnershipType(): ?string
    {
        return $this->ownershipType;
    }

    public function setOwnershipType(?string $ownershipType): self
    {
        $this->ownershipType = $ownershipType;

        return $this;
    }

    public function getBusinessOpenDate(): ?\DateTimeInterface
    {
        return $this->businessOpenDate;
    }

    public function setBusinessOpenDate(?\DateTimeInterface $businessOpenDate): self
    {
        $this->businessOpenDate = $businessOpenDate;

        return $this;
    }

    public function getCurrentlyProcessingCc(): ?string
    {
        return $this->currentlyProcessingCc;
    }

    public function setCurrentlyProcessingCc(?string $currentlyProcessingCc): self
    {
        $this->currentlyProcessingCc = $currentlyProcessingCc;

        return $this;
    }

    public function getSwipeF2fPercent(): ?int
    {
        return $this->swipeF2fPercent;
    }

    public function setSwipeF2fPercent(?int $swipeF2fPercent): self
    {
        $this->swipeF2fPercent = $swipeF2fPercent;

        return $this;
    }

    public function getSwipeMotoPercent(): ?int
    {
        return $this->swipeMotoPercent;
    }

    public function setSwipeMotoPercent(?int $swipeMotoPercent): self
    {
        $this->swipeMotoPercent = $swipeMotoPercent;

        return $this;
    }

    public function getSwipeInternetPercent(): ?int
    {
        return $this->swipeInternetPercent;
    }

    public function setSwipeInternetPercent(?int $swipeInternetPercent): self
    {
        $this->swipeInternetPercent = $swipeInternetPercent;

        return $this;
    }

    public function getTxAtStore(): ?int
    {
        return $this->txAtStore;
    }

    public function setTxAtStore(?int $txAtStore): self
    {
        $this->txAtStore = $txAtStore;

        return $this;
    }

    public function getTxAtResidence(): ?int
    {
        return $this->txAtResidence;
    }

    public function setTxAtResidence(?int $txAtResidence): self
    {
        $this->txAtResidence = $txAtResidence;

        return $this;
    }

    public function getTxAtWarehouse(): ?int
    {
        return $this->txAtWarehouse;
    }

    public function setTxAtWarehouse(?int $txAtWarehouse): self
    {
        $this->txAtWarehouse = $txAtWarehouse;

        return $this;
    }

    public function getTxAtMobile(): ?int
    {
        return $this->txAtMobile;
    }

    public function setTxAtMobile(?int $txAtMobile): self
    {
        $this->txAtMobile = $txAtMobile;

        return $this;
    }

    public function getOwnerFirst(): ?string
    {
        return $this->ownerFirst;
    }

    public function setOwnerFirst(?string $ownerFirst): self
    {
        $this->ownerFirst = $ownerFirst;

        return $this;
    }

    public function getOwnerLast(): ?string
    {
        return $this->ownerLast;
    }

    public function setOwnerLast(?string $ownerLast): self
    {
        $this->ownerLast = $ownerLast;

        return $this;
    }

    public function getOwnerDob(): ?\DateTimeInterface
    {
        return $this->ownerDob;
    }

    public function setOwnerDob(?\DateTimeInterface $ownerDob): self
    {
        $this->ownerDob = $ownerDob;

        return $this;
    }

    public function getOwnerPercent(): ?int
    {
        return $this->ownerPercent;
    }

    public function setOwnerPercent(?int $ownerPercent): self
    {
        $this->ownerPercent = $ownerPercent;

        return $this;
    }

    public function getOwnerDl(): ?string
    {
        return $this->ownerDl;
    }

    public function setOwnerDl(?string $ownerDl): self
    {
        $this->ownerDl = $ownerDl;

        return $this;
    }

    public function getOwnerDlState(): ?string
    {
        return $this->ownerDlState;
    }

    public function setOwnerDlState(?string $ownerDlState): self
    {
        $this->ownerDlState = $ownerDlState;

        return $this;
    }

    public function getOwnerSsn(): ?string
    {
        return $this->ownerSsn;
    }

    public function setOwnerSsn(?string $ownerSsn): self
    {
        $this->ownerSsn = $ownerSsn;

        return $this;
    }

    public function getOwnerAddress1(): ?string
    {
        return $this->ownerAddress1;
    }

    public function setOwnerAddress1(?string $ownerAddress1): self
    {
        $this->ownerAddress1 = $ownerAddress1;

        return $this;
    }

    public function getOwnerCity(): ?string
    {
        return $this->ownerCity;
    }

    public function setOwnerCity(?string $ownerCity): self
    {
        $this->ownerCity = $ownerCity;

        return $this;
    }

    public function getOwnerState(): ?string
    {
        return $this->ownerState;
    }

    public function setOwnerState(?string $ownerState): self
    {
        $this->ownerState = $ownerState;

        return $this;
    }

    public function getOwnerZip(): ?string
    {
        return $this->ownerZip;
    }

    public function setOwnerZip(?string $ownerZip): self
    {
        $this->ownerZip = $ownerZip;

        return $this;
    }

    public function getOwnerPhone(): ?string
    {
        return $this->ownerPhone;
    }

    public function setOwnerPhone(?string $ownerPhone): self
    {
        $this->ownerPhone = $ownerPhone;

        return $this;
    }

    public function getOwnerEmail(): ?string
    {
        return $this->ownerEmail;
    }

    public function setOwnerEmail(?string $ownerEmail): self
    {
        $this->ownerEmail = $ownerEmail;

        return $this;
    }

    public function getOwnerLessthan51pct(): ?string
    {
        return $this->ownerLessthan51pct;
    }

    public function setOwnerLessthan51pct(?string $ownerLessthan51pct): self
    {
        $this->ownerLessthan51pct = $ownerLessthan51pct;

        return $this;
    }

    public function getOwner2First(): ?string
    {
        return $this->owner2First;
    }

    public function setOwner2First(?string $owner2First): self
    {
        $this->owner2First = $owner2First;

        return $this;
    }

    public function getOwner2Last(): ?string
    {
        return $this->owner2Last;
    }

    public function setOwner2Last(?string $owner2Last): self
    {
        $this->owner2Last = $owner2Last;

        return $this;
    }

    public function getOwner2Dob(): ?\DateTimeInterface
    {
        return $this->owner2Dob;
    }

    public function setOwner2Dob(?\DateTimeInterface $owner2Dob): self
    {
        $this->owner2Dob = $owner2Dob;

        return $this;
    }

    public function getOwner2Percent(): ?int
    {
        return $this->owner2Percent;
    }

    public function setOwner2Percent(?int $owner2Percent): self
    {
        $this->owner2Percent = $owner2Percent;

        return $this;
    }

    public function getOwner2Dl(): ?string
    {
        return $this->owner2Dl;
    }

    public function setOwner2Dl(?string $owner2Dl): self
    {
        $this->owner2Dl = $owner2Dl;

        return $this;
    }

    public function getOwner2DlState(): ?string
    {
        return $this->owner2DlState;
    }

    public function setOwner2DlState(?string $owner2DlState): self
    {
        $this->owner2DlState = $owner2DlState;

        return $this;
    }

    public function getOwner2Ssn(): ?string
    {
        return $this->owner2Ssn;
    }

    public function setOwner2Ssn(?string $owner2Ssn): self
    {
        $this->owner2Ssn = $owner2Ssn;

        return $this;
    }

    public function getOwner2Address1(): ?string
    {
        return $this->owner2Address1;
    }

    public function setOwner2Address1(?string $owner2Address1): self
    {
        $this->owner2Address1 = $owner2Address1;

        return $this;
    }

    public function getOwner2City(): ?string
    {
        return $this->owner2City;
    }

    public function setOwner2City(?string $owner2City): self
    {
        $this->owner2City = $owner2City;

        return $this;
    }

    public function getOwner2State(): ?string
    {
        return $this->owner2State;
    }

    public function setOwner2State(?string $owner2State): self
    {
        $this->owner2State = $owner2State;

        return $this;
    }

    public function getOwner2Zip(): ?string
    {
        return $this->owner2Zip;
    }

    public function setOwner2Zip(?string $owner2Zip): self
    {
        $this->owner2Zip = $owner2Zip;

        return $this;
    }

    public function getOwner2Phone(): ?string
    {
        return $this->owner2Phone;
    }

    public function setOwner2Phone(?string $owner2Phone): self
    {
        $this->owner2Phone = $owner2Phone;

        return $this;
    }

    public function getOwner2Email(): ?string
    {
        return $this->owner2Email;
    }

    public function setOwner2Email(?string $owner2Email): self
    {
        $this->owner2Email = $owner2Email;

        return $this;
    }

    public function getBankNameOnAccount(): ?string
    {
        return $this->bankNameOnAccount;
    }

    public function setBankNameOnAccount(?string $bankNameOnAccount): self
    {
        $this->bankNameOnAccount = $bankNameOnAccount;

        return $this;
    }

    public function getBankName(): ?string
    {
        return $this->bankName;
    }

    public function setBankName(?string $bankName): self
    {
        $this->bankName = $bankName;

        return $this;
    }

    public function getBankPhone(): ?string
    {
        return $this->bankPhone;
    }

    public function setBankPhone(?string $bankPhone): self
    {
        $this->bankPhone = $bankPhone;

        return $this;
    }

    public function getBankCity(): ?string
    {
        return $this->bankCity;
    }

    public function setBankCity(?string $bankCity): self
    {
        $this->bankCity = $bankCity;

        return $this;
    }

    public function getBankState(): ?string
    {
        return $this->bankState;
    }

    public function setBankState(?string $bankState): self
    {
        $this->bankState = $bankState;

        return $this;
    }

    public function getBankRouting(): ?string
    {
        return $this->bankRouting;
    }

    public function setBankRouting(?string $bankRouting): self
    {
        $this->bankRouting = $bankRouting;

        return $this;
    }

    public function getBankAccount(): ?string
    {
        return $this->bankAccount;
    }

    public function setBankAccount(?string $bankAccount): self
    {
        $this->bankAccount = $bankAccount;

        return $this;
    }

    public function getAvgMonthlyVolume()
    {
        return $this->avgMonthlyVolume;
    }

    public function setAvgMonthlyVolume($avgMonthlyVolume): self
    {
        $this->avgMonthlyVolume = $avgMonthlyVolume;

        return $this;
    }

    public function getHighMonthlyVolume()
    {
        return $this->highMonthlyVolume;
    }

    public function setHighMonthlyVolume($highMonthlyVolume): self
    {
        $this->highMonthlyVolume = $highMonthlyVolume;

        return $this;
    }

    public function getAvgTicket()
    {
        return $this->avgTicket;
    }

    public function setAvgTicket($avgTicket): self
    {
        $this->avgTicket = $avgTicket;

        return $this;
    }

    public function getHighTicket()
    {
        return $this->highTicket;
    }

    public function setHighTicket($highTicket): self
    {
        $this->highTicket = $highTicket;

        return $this;
    }

    public function getBusinessDescription(): ?string
    {
        return $this->businessDescription;
    }

    public function setBusinessDescription(?string $businessDescription): self
    {
        $this->businessDescription = $businessDescription;

        return $this;
    }

    public function getAcceptAdvance(): ?string
    {
        return $this->acceptAdvance;
    }

    public function setAcceptAdvance(?string $acceptAdvance): self
    {
        $this->acceptAdvance = $acceptAdvance;

        return $this;
    }

    public function getAdvanceDeposits(): ?bool
    {
        return $this->advanceDeposits;
    }

    public function setAdvanceDeposits(bool $advanceDeposits): self
    {
        $this->advanceDeposits = $advanceDeposits;

        return $this;
    }

    public function getAdvancePayment(): ?bool
    {
        return $this->advancePayment;
    }

    public function setAdvancePayment(bool $advancePayment): self
    {
        $this->advancePayment = $advancePayment;

        return $this;
    }

    public function getAdvanceMembership(): ?bool
    {
        return $this->advanceMembership;
    }

    public function setAdvanceMembership(bool $advanceMembership): self
    {
        $this->advanceMembership = $advanceMembership;

        return $this;
    }

    public function getAdvanceAvgDeposits(): ?int
    {
        return $this->advanceAvgDeposits;
    }

    public function setAdvanceAvgDeposits(?int $advanceAvgDeposits): self
    {
        $this->advanceAvgDeposits = $advanceAvgDeposits;

        return $this;
    }

    public function getAdvanceDaysDepositPaid(): ?int
    {
        return $this->advanceDaysDepositPaid;
    }

    public function setAdvanceDaysDepositPaid(?int $advanceDaysDepositPaid): self
    {
        $this->advanceDaysDepositPaid = $advanceDaysDepositPaid;

        return $this;
    }

    public function getAdvanceAvgService(): ?int
    {
        return $this->advanceAvgService;
    }

    public function setAdvanceAvgService(?int $advanceAvgService): self
    {
        $this->advanceAvgService = $advanceAvgService;

        return $this;
    }

    public function getAdvancePctVolume(): ?int
    {
        return $this->advancePctVolume;
    }

    public function setAdvancePctVolume(?int $advancePctVolume): self
    {
        $this->advancePctVolume = $advancePctVolume;

        return $this;
    }

    public function getSeasonal(): ?string
    {
        return $this->seasonal;
    }

    public function setSeasonal(?string $seasonal): self
    {
        $this->seasonal = $seasonal;

        return $this;
    }

    public function getMonthsOpen(): ?string
    {
        return $this->monthsOpen;
    }

    public function setMonthsOpen(?string $monthsOpen): self
    {
        $this->monthsOpen = $monthsOpen;

        return $this;
    }

    public function getMonthsClosed(): ?string
    {
        return $this->monthsClosed;
    }

    public function setMonthsClosed(?string $monthsClosed): self
    {
        $this->monthsClosed = $monthsClosed;

        return $this;
    }

    public function getFulfillmentPerformedBy(): ?string
    {
        return $this->fulfillmentPerformedBy;
    }

    public function setFulfillmentPerformedBy(?string $fulfillmentPerformedBy): self
    {
        $this->fulfillmentPerformedBy = $fulfillmentPerformedBy;

        return $this;
    }

    public function getFulfillmentVendor(): ?string
    {
        return $this->fulfillmentVendor;
    }

    public function setFulfillmentVendor(?string $fulfillmentVendor): self
    {
        $this->fulfillmentVendor = $fulfillmentVendor;

        return $this;
    }

    public function getAcceptAmex(): ?string
    {
        return $this->acceptAmex;
    }

    public function setAcceptAmex(?string $acceptAmex): self
    {
        $this->acceptAmex = $acceptAmex;

        return $this;
    }

    public function getAmexNumber(): ?string
    {
        return $this->amexNumber;
    }

    public function setAmexNumber(?string $amexNumber): self
    {
        $this->amexNumber = $amexNumber;

        return $this;
    }

    public function getAmexCap(): ?string
    {
        return $this->amexCap;
    }

    public function setAmexCap(?string $amexCap): self
    {
        $this->amexCap = $amexCap;

        return $this;
    }

    public function getAmexVolume()
    {
        return $this->amexVolume;
    }

    public function setAmexVolume($amexVolume): self
    {
        $this->amexVolume = $amexVolume;

        return $this;
    }

    public function getAmexAvgTicket()
    {
        return $this->amexAvgTicket;
    }

    public function setAmexAvgTicket($amexAvgTicket): self
    {
        $this->amexAvgTicket = $amexAvgTicket;

        return $this;
    }

    public function getAcceptAch(): ?string
    {
        return $this->acceptAch;
    }

    public function setAcceptAch(?string $acceptAch): self
    {
        $this->acceptAch = $acceptAch;

        return $this;
    }

    public function getDebitMaxSingleAmount()
    {
        return $this->debitMaxSingleAmount;
    }

    public function setDebitMaxSingleAmount($debitMaxSingleAmount): self
    {
        $this->debitMaxSingleAmount = $debitMaxSingleAmount;

        return $this;
    }

    public function getDebitMaxDailyAmount()
    {
        return $this->debitMaxDailyAmount;
    }

    public function setDebitMaxDailyAmount($debitMaxDailyAmount): self
    {
        $this->debitMaxDailyAmount = $debitMaxDailyAmount;

        return $this;
    }

    public function getDebitMaxDailyCount(): ?int
    {
        return $this->debitMaxDailyCount;
    }

    public function setDebitMaxDailyCount(?int $debitMaxDailyCount): self
    {
        $this->debitMaxDailyCount = $debitMaxDailyCount;

        return $this;
    }

    public function getDebitMaxAmount14days()
    {
        return $this->debitMaxAmount14days;
    }

    public function setDebitMaxAmount14days($debitMaxAmount14days): self
    {
        $this->debitMaxAmount14days = $debitMaxAmount14days;

        return $this;
    }

    public function getDebitMaxCount14days(): ?int
    {
        return $this->debitMaxCount14days;
    }

    public function setDebitMaxCount14days(?int $debitMaxCount14days): self
    {
        $this->debitMaxCount14days = $debitMaxCount14days;

        return $this;
    }

    public function getCreditMaxSingleAmount()
    {
        return $this->creditMaxSingleAmount;
    }

    public function setCreditMaxSingleAmount($creditMaxSingleAmount): self
    {
        $this->creditMaxSingleAmount = $creditMaxSingleAmount;

        return $this;
    }

    public function getCreditMaxDailyAmount()
    {
        return $this->creditMaxDailyAmount;
    }

    public function setCreditMaxDailyAmount($creditMaxDailyAmount): self
    {
        $this->creditMaxDailyAmount = $creditMaxDailyAmount;

        return $this;
    }

    public function getCreditMaxDailyCount(): ?int
    {
        return $this->creditMaxDailyCount;
    }

    public function setCreditMaxDailyCount(?int $creditMaxDailyCount): self
    {
        $this->creditMaxDailyCount = $creditMaxDailyCount;

        return $this;
    }

    public function getCreditMaxAmount14days()
    {
        return $this->creditMaxAmount14days;
    }

    public function setCreditMaxAmount14days($creditMaxAmount14days): self
    {
        $this->creditMaxAmount14days = $creditMaxAmount14days;

        return $this;
    }

    public function getCreditMaxCount14days(): ?int
    {
        return $this->creditMaxCount14days;
    }

    public function setCreditMaxCount14days(?int $creditMaxCount14days): self
    {
        $this->creditMaxCount14days = $creditMaxCount14days;

        return $this;
    }

    public function getSectypePpd(): ?bool
    {
        return $this->sectypePpd;
    }

    public function setSectypePpd(bool $sectypePpd): self
    {
        $this->sectypePpd = $sectypePpd;

        return $this;
    }

    public function getSectypeCcd(): ?bool
    {
        return $this->sectypeCcd;
    }

    public function setSectypeCcd(bool $sectypeCcd): self
    {
        $this->sectypeCcd = $sectypeCcd;

        return $this;
    }

    public function getSectypeTel(): ?bool
    {
        return $this->sectypeTel;
    }

    public function setSectypeTel(bool $sectypeTel): self
    {
        $this->sectypeTel = $sectypeTel;

        return $this;
    }

    public function getSectypeWeb(): ?bool
    {
        return $this->sectypeWeb;
    }

    public function setSectypeWeb(bool $sectypeWeb): self
    {
        $this->sectypeWeb = $sectypeWeb;

        return $this;
    }

    public function getSectypePop(): ?bool
    {
        return $this->sectypePop;
    }

    public function setSectypePop(bool $sectypePop): self
    {
        $this->sectypePop = $sectypePop;

        return $this;
    }

    public function getSectypeCheck21(): ?bool
    {
        return $this->sectypeCheck21;
    }

    public function setSectypeCheck21(bool $sectypeCheck21): self
    {
        $this->sectypeCheck21 = $sectypeCheck21;

        return $this;
    }

    public function getIsoId(): ?string
    {
        return $this->isoId;
    }

    public function setIsoId(?string $isoId): self
    {
        $this->isoId = $isoId;

        return $this;
    }

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->businessEmail;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword()
    {
       return $this->getApplicationHash();
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed for apps that do not check user passwords
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getStep(): ?string
    {
        return $this->step;
    }

    public function setStep(string $step): self
    {
        $this->step = $step;

        return $this;
    }

    public function getAcceptCC(): ?string
    {
        return $this->acceptCC;
    }

    public function setAcceptCC(?string $acceptCC): self
    {
        $this->acceptCC = $acceptCC;

        return $this;
    }

    public function getCurrentlyProcessingAch(): ?string
    {
        return $this->currentlyProcessingAch;
    }

    public function setCurrentlyProcessingAch(?string $currentlyProcessingAch): self
    {
        $this->currentlyProcessingAch = $currentlyProcessingAch;

        return $this;
    }

    public function getAchVerification(): ?string
    {
        return $this->achVerification;
    }

    public function setAchVerification(?string $achVerification): self
    {
        $this->achVerification = $achVerification;

        return $this;
    }

    public function getSoftwareIntegration(): ?string
    {
        return $this->softwareIntegration;
    }

    public function setSoftwareIntegration(?string $softwareIntegration): self
    {
        $this->softwareIntegration = $softwareIntegration;

        return $this;
    }

    public function getSoftwareIntegrationOther(): ?string
    {
        return $this->softwareIntegrationOther;
    }

    public function setSoftwareIntegrationOther(?string $softwareIntegrationOther): self
    {
        $this->softwareIntegrationOther = $softwareIntegrationOther;

        return $this;
    }

    public function getHeardAbout(): ?string
    {
        return $this->heardAbout;
    }

    public function setHeardAbout(?string $heardAbout): self
    {
        $this->heardAbout = $heardAbout;

        return $this;
    }

    /**
     * @return Collection|OmnifundApplicationsDocs[]
     */
    public function getApplicationDocs(): Collection
    {
        return $this->applicationDocs;
    }

    public function addApplicationDoc(OmnifundApplicationsDocs $applicationDoc): self
    {
        if (!$this->applicationDocs->contains($applicationDoc)) {
            $this->applicationDocs[] = $applicationDoc;
            $applicationDoc->setApplication($this);
        }

        return $this;
    }

    public function removeApplicationDoc(OmnifundApplicationsDocs $applicationDoc): self
    {
        if ($this->applicationDocs->contains($applicationDoc)) {
            $this->applicationDocs->removeElement($applicationDoc);
            // set the owning side to null (unless already changed)
            if ($applicationDoc->getApplication() === $this) {
                $applicationDoc->setApplication(null);
            }
        }

        return $this;
    }

    public function getBoardedAt(): ?\DateTimeInterface
    {
        return $this->boardedAt;
    }

    public function setBoardedAt(?\DateTimeInterface $boardedAt): self
    {
        $this->boardedAt = $boardedAt;

        return $this;
    }

    public function getSectypeArc(): ?bool
    {
        return $this->sectypeArc;
    }

    public function setSectypeArc(bool $sectypeArc): self
    {
        $this->sectypeArc = $sectypeArc;

        return $this;
    }

    public function getSectypeBoc(): ?bool
    {
        return $this->sectypeBoc;
    }

    public function setSectypeBoc(bool $sectypeBoc): self
    {
        $this->sectypeBoc = $sectypeBoc;

        return $this;
    }

    public function getAchEquipment(): ?string
    {
        return $this->achEquipment;
    }

    public function setAchEquipment(string $achEquipment): self
    {
        $this->achEquipment = $achEquipment;

        return $this;
    }

    public function getCcEquipment(): ?string
    {
        return $this->ccEquipment;
    }

    public function setCcEquipment(string $ccEquipment): self
    {
        $this->ccEquipment = $ccEquipment;

        return $this;
    }

    public function getOwnerTitle(): ?string
    {
        return $this->ownerTitle;
    }

    public function setOwnerTitle(?string $ownerTitle): self
    {
        $this->ownerTitle = $ownerTitle;

        return $this;
    }

    public function getOwner2Title(): ?string
    {
        return $this->owner2Title;
    }

    public function setOwner2Title(?string $owner2Title): self
    {
        $this->owner2Title = $owner2Title;

        return $this;
    }

    public function getBank2Routing(): ?string
    {
        return $this->bank2Routing;
    }

    public function setBank2Routing(?string $bank2Routing): self
    {
        $this->bank2Routing = $bank2Routing;

        return $this;
    }

    public function getBank2Account(): ?string
    {
        return $this->bank2Account;
    }

    public function setBank2Account(?string $bank2Account): self
    {
        $this->bank2Account = $bank2Account;

        return $this;
    }

    public function getBank2Usedfor(): ?string
    {
        return $this->bank2Usedfor;
    }

    public function setBank2Usedfor(?string $bank2Usedfor): self
    {
        $this->bank2Usedfor = $bank2Usedfor;

        return $this;
    }

    public function getBank2(): ?string
    {
        return $this->bank2;
    }

    public function setBank2(?string $bank2): self
    {
        $this->bank2 = $bank2;

        return $this;
    }

    public function getMccCode(): ?string
    {
        return $this->mccCode;
    }

    public function setMccCode(?string $mccCode): self
    {
        $this->mccCode = $mccCode;

        return $this;
    }

    public function getSectypeRck(): ?bool
    {
        return $this->sectypeRck;
    }

    public function setSectypeRck(bool $sectypeRck): self
    {
        $this->sectypeRck = $sectypeRck;

        return $this;
    }

    public function getCompliantPci()
    {
        return $this->compliantPci;
    }

    public function setCompliantPci($compliantPci): void
    {
        $this->compliantPci = $compliantPci;
    }

    public function getPciCertNumber(): ?string
    {
        return $this->pciCertNumber;
    }

    public function setPciCertNumber(?string $pciCertNumber): self
    {
        $this->pciCertNumber = $pciCertNumber;

        return $this;
    }

    public function getPciCertDate(): ?\DateTimeInterface
    {
        return $this->pciCertDate;
    }

    public function setPciCertDate(?\DateTimeInterface $pciCertDate): self
    {
        $this->pciCertDate = $pciCertDate;

        return $this;
    }

    public function getPciPaymentPlan(): ?string
    {
        return $this->pciPaymentPlan;
    }

    public function setPciPaymentPlan(?string $pciPaymentPlan): self
    {
        $this->pciPaymentPlan = $pciPaymentPlan;

        return $this;
    }

    public function getAnnualVolume(): ?string
    {
        return $this->annualVolume;
    }

    public function setAnnualVolume(?string $annualVolume): self
    {
        $this->annualVolume = $annualVolume;

        return $this;
    }

    public function getStoreCardholder()
    {
        return $this->storeCardholder;
    }

    public function setStoreCardholder($storeCardholder): void
    {
        $this->storeCardholder = $storeCardholder;
    }

    public function getGoodServicesOn(): ?string
    {
        return $this->goodServicesOn;
    }

    public function setGoodServicesOn(?string $goodServicesOn): self
    {
        $this->goodServicesOn = $goodServicesOn;

        return $this;
    }

    public function getGoodServicesDelivered(): ?string
    {
        return $this->goodServicesDelivered;
    }

    public function setGoodServicesDelivered(?string $goodServicesDelivered): self
    {
        $this->goodServicesDelivered = $goodServicesDelivered;

        return $this;
    }

    public function getBankType(): ?string
    {
        return $this->bankType;
    }

    public function setBankType(?string $bankType): self
    {
        $this->bankType = $bankType;

        return $this;
    }

    public function getBank2Type(): ?string
    {
        return $this->bank2Type;
    }

    public function setBank2Type(?string $bank2Type): self
    {
        $this->bank2Type = $bank2Type;

        return $this;
    }

    public function getRefundPolicy(): ?string
    {
        return $this->refundPolicy;
    }

    public function setRefundPolicy(?string $refundPolicy): self
    {
        $this->refundPolicy = $refundPolicy;

        return $this;
    }

    public function getRefundPolicyOther()
    {
        return $this->refundPolicyOther;
    }

    public function setRefundPolicyOther($refundPolicyOther): void
    {
        $this->refundPolicyOther = $refundPolicyOther;
    }

    public function getLocationType(): ?string
    {
        return $this->locationType;
    }

    public function setLocationType(?string $locationType): self
    {
        $this->locationType = $locationType;

        return $this;
    }

    public function getTxAtRestaurant(): ?int
    {
        return $this->txAtRestaurant;
    }

    public function setTxAtRestaurant(?int $txAtRestaurant): self
    {
        $this->txAtRestaurant = $txAtRestaurant;

        return $this;
    }

    public function getTxAtInternet(): ?int
    {
        return $this->txAtInternet;
    }

    public function setTxAtInternet(?int $txAtInternet): self
    {
        $this->txAtInternet = $txAtInternet;

        return $this;
    }

    public function getFulfillmentContact(): ?string
    {
        return $this->fulfillmentContact;
    }

    public function setFulfillmentContact(?string $fulfillmentContact): self
    {
        $this->fulfillmentContact = $fulfillmentContact;

        return $this;
    }

    public function getFulfillmentPci(): ?string
    {
        return $this->fulfillmentPci;
    }

    public function setFulfillmentPci(?string $fulfillmentPci): self
    {
        $this->fulfillmentPci = $fulfillmentPci;

        return $this;
    }

    public function getFulfillmentPercent(): ?int
    {
        return $this->fulfillmentPercent;
    }

    public function setFulfillmentPercent(?int $fulfillmentPercent): self
    {
        $this->fulfillmentPercent = $fulfillmentPercent;

        return $this;
    }

    public function getActiveMonths(): ?array
    {
        return $this->activeMonths;
    }

    public function setActiveMonths(?array $activeMonths): void
    {
        $this->activeMonths = $activeMonths;
    }

    public function getStorePaper(): ?bool
    {
        return $this->storePaper;
    }

    public function setStorePaper(bool $storePaper): self
    {
        $this->storePaper = $storePaper;

        return $this;
    }

    public function getStoreElectronic(): ?bool
    {
        return $this->storeElectronic;
    }

    public function setStoreElectronic(bool $storeElectronic): self
    {
        $this->storeElectronic = $storeElectronic;

        return $this;
    }

    public function getPciSecAssessor(): ?string
    {
        return $this->pciSecAssessor;
    }

    public function setPciSecAssessor(?string $pciSecAssessor): self
    {
        $this->pciSecAssessor = $pciSecAssessor;

        return $this;
    }

    public function getPciSelfAssessment(): ?string
    {
        return $this->pciSelfAssessment;
    }

    public function setPciSelfAssessment(?string $pciSelfAssessment): self
    {
        $this->pciSelfAssessment = $pciSelfAssessment;

        return $this;
    }

    public function getAccCompromise(): ?string
    {
        return $this->accCompromise;
    }

    public function setAccCompromise(?string $accCompromise): self
    {
        $this->accCompromise = $accCompromise;

        return $this;
    }

    public function getAccRemediation(): ?string
    {
        return $this->accRemediation;
    }

    public function setAccRemediation(?string $accRemediation): self
    {
        $this->accRemediation = $accRemediation;

        return $this;
    }

    public function getAchAvgTransaction(): ?string
    {
        return $this->achAvgTransaction;
    }

    public function setAchAvgTransaction(?string $achAvgTransaction): self
    {
        $this->achAvgTransaction = $achAvgTransaction;

        return $this;
    }

    public function getAchAvgMonthly(): ?string
    {
        return $this->achAvgMonthly;
    }

    public function setAchAvgMonthly(?string $achAvgMonthly): self
    {
        $this->achAvgMonthly = $achAvgMonthly;

        return $this;
    }

    public function getAchHighMonthly(): ?string
    {
        return $this->achHighMonthly;
    }

    public function setAchHighMonthly(?string $achHighMonthly): self
    {
        $this->achHighMonthly = $achHighMonthly;

        return $this;
    }

    public function getAchHighTicket(): ?string
    {
        return $this->achHighTicket;
    }

    public function setAchHighTicket(?string $achHighTicket): self
    {
        $this->achHighTicket = $achHighTicket;

        return $this;
    }

    public function getMerchantAdvertise(): ?array
    {
        return $this->merchantAdvertise;
    }

    public function setMerchantAdvertise(?array $merchantAdvertise): self
    {
        $this->merchantAdvertise = $merchantAdvertise;

        return $this;
    }

    public function getB2bPercent(): ?int
    {
        return $this->b2bPercent;
    }

    public function setB2bPercent(?int $b2bPercent): self
    {
        $this->b2bPercent = $b2bPercent;

        return $this;
    }

    public function getB2bMerchant(): ?string
    {
        return $this->b2bMerchant;
    }

    public function setB2bMerchant(?string $b2bMerchant): self
    {
        $this->b2bMerchant = $b2bMerchant;

        return $this;
    }

    public function getMerchantAdvertiseWeb(): ?string
    {
        return $this->merchantAdvertiseWeb;
    }

    public function setMerchantAdvertiseWeb(?string $merchantAdvertiseWeb): self
    {
        $this->merchantAdvertiseWeb = $merchantAdvertiseWeb;

        return $this;
    }

    public function getMerchantAdvertiseEmail(): ?string
    {
        return $this->merchantAdvertiseEmail;
    }

    public function setMerchantAdvertiseEmail(?string $merchantAdvertiseEmail): self
    {
        $this->merchantAdvertiseEmail = $merchantAdvertiseEmail;

        return $this;
    }

    public function getMerchantAdvertiseOther(): ?string
    {
        return $this->merchantAdvertiseOther;
    }

    public function setMerchantAdvertiseOther(?string $merchantAdvertiseOther): self
    {
        $this->merchantAdvertiseOther = $merchantAdvertiseOther;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }

    public function getMerchantId(): ?string
    {
        return $this->merchantId;
    }

    public function setMerchantId(?string $merchantId): self
    {
        $this->merchantId = $merchantId;

        return $this;
    }

    public function getAgreement(): array
    {
        return $this->agreement;
    }

    public function setAgreement(array $agreement): self
    {
        $this->agreement = $agreement;

        return $this;
    }

    public function getAsArray(): array
    {
        return get_object_vars($this);
    }

    public function getBuyerBankStatement(): ?string
    {
        return $this->buyerBankStatement;
    }

    public function setBuyerBankStatement(?string $buyerBankStatement): self
    {
        $this->buyerBankStatement = $buyerBankStatement;

        return $this;
    }

    public function getPhoneBankStatement(): ?string
    {
        return $this->phoneBankStatement;
    }

    public function setPhoneBankStatement(?string $phoneBankStatement): self
    {
        $this->phoneBankStatement = $phoneBankStatement;

        return $this;
    }
}
