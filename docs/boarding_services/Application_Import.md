Application API for import.   Allows third-parties to import applications into Boarding-App system.

## Import

This web service method allows information to be posted to the current application.

| End-Point | Method | Content-Type |
|---------|---------| ------------|
| /api/import | POST | application/json

### Request
| Field | Type | Required | Description |
|---------|---------| ------------| ------------|
businessEmail | String(150) | Y | Email for Login and Contact usage
businessContactFirst | String(50) | Y | Contact's First Name
businessContactLast | String(50) | Y | Contact's Last Name
businessName | String(100) | Y | Legal Business Name
businessAddress1 | String(150) | Y | Legal Address
businessCity | String(50) | Y | Legal City
businessState | String(2) | Y | Legal State 
businessZip | String(10) | Y | Legal Zip
businessPhone | String(14) | Y | Legal Phone : (XXX) XXX-XXXX
businessTaxid | String(9) | Y | Federal Tax ID
businessDba | String(100) | Y | DBA
businessDbaAddress1 | String(150) | Y | DBA's Address
businessDbaCity | String(50) | Y | DBA's City
businessDbaState | String(2) | Y | DBA's State
businessDbaZip | String(10) | Y | DBA's Zip
businessDbaPhone | String(14) | Y | DBA's Phone : (XXX) XXX-XXXX
businessNumLocations | Integer | Y | Number of Locations
heardAbout | String(100) | Y | How did you hear about us?
businessWebsite | String(100) | N | Website Address
bankNameOnAccount | String(50) | Y | Name On Account
bankName | String(50) | Y | Bank Name
bankPhone | String(14) | Y | Bank Phone : (XXX) XXX-XXXX
bankCity | String(50) | Y | Bank City
bankState | String(2) | Y | Bank State
bankRouting | String(20) | Y | Bank Routing Number
bankAccount | String(20) | Y | Bank Account Number
bankType | String(20) | Y | C -> Checking <br/> S -> Savings
bank2 | String(1) | Y | Specify an additional bank? <br/> y -> YES <br/> n -> NO
bank2Routing | String(20) | N | 2nd Bank Routing Number
bank2Account | String(20) | N | 2nd Bank Routing Account
bank2Usedfor | String(20) | N | Chargebacks -> Chargebacks <br/> Credits -> Credits <br/> Discount -> Discount <br/> Fees -> Fees
bank2Type | String(20) | N | C -> Checking <br/> S -> Savings
businessFax | String(14) | N | DBA's Phone : (XXX) XXX-XXXX
ownershipType | String(30) | N | Corporation -> C Corporation <br/> S Corporation -> S Corporation <br/> Government Entity -> Government <br/> LLC -> Limited Liability Corporation <br/> LLP -> Limited Liability Partnership <br/> Non-Profit -> Not For Profit <br/> Partnership -> Partnership <br/> Sole Proprietor -> Sole Proprietorship
businessOpenDate | Date | N | Business Open Date : YYYY-MM-DD
ownerFirst | String(50) | N | Controlling Owner First Name
ownerLast | String(50) | N | Controlling Owner Last Name
ownerTitle | String(100) | N | Controlling Owner Title
ownerDob | Date | N | Controlling Owner Date of Birth : YYYY-MM-DD
ownerPercent | Integer | N | Percent Owned
ownerDl | String(20) | N | Controlling Owner Driver's License
ownerDlState | String(2) | N | Controlling Owner Driver's License State
ownerSsn | String(11) | N | Controlling Owner SSN : XXX-XX-XXXX
ownerAddress1 | String(150) | N | Controlling Owner Address
ownerCity | String(50) | N | Controlling Owner City
ownerState | String(2) | N | Controlling Owner State
ownerZip | String(10) | N | Controlling Owner Zip
ownerPhone | String(14) | N | Controlling Owner Phone : (XXX) XXX-XXXX
ownerEmail | String(255) | N | Controlling Owner Email
owner2First | String(50) | N | Beneficial  Owner First Name
owner2Last | String(50) | N | Beneficial  Owner Last Name
owner2Title | String(100) | N | Beneficial Owner Title
owner2Dob | Date | N | Beneficial  Owner Date of Birth : YYYY-MM-DD
owner2Percent | Integer | N | Percent Owned
owner2Dl | String(20) | N | Beneficial  Owner Driver's License
owner2DlState | String(2) | N | Beneficial  Owner Driver's License State
owner2Ssn | String(11) | N | Beneficial  Owner SSN : XXX-XX-XXXX
owner2Address1 | String(150) | N | Beneficial  Owner Address
owner2City | String(50) | N | Beneficial  Owner City
owner2State | String(2) | N | Beneficial  Owner State
owner2Zip | String(10) | N | Beneficial  Owner Zip
owner2Phone | String(14) | N | Beneficial  Owner Phone : (XXX) XXX-XXXX
owner2Email | String(255) | N | Beneficial  Owner Email
isoId | String(50) | N | ISO ID
notes | String(500) | N | Additional Notes

### Request Example
```
{
    "businessEmail": "daniel@test.com",
    "businessContactFirst": "DBA",
    "businessContactLast": "API",
    "businessName": "dbas street",
    "businessAddress1": "Test Address",
    "businessCity": "Tampa",
    "businessState": "FL",
    "businessZip": "33661",
    "businessPhone": "(564) 166-1655",
    "businessTaxid": "123456678",
    "businessDba": "dba API",
    "businessDbaAddress1": "dbas street",
    "businessDbaCity": "Tampa",
    "businessDbaState": "FL",
    "businessDbaZip": "33661",
    "heardAbout": "sales rep",
    "bankNameOnAccount": "DANIEL TEST BANK",
    "bankName": "DANIEL BANK",
    "bankPhone": "(564) 166-1655",
    "bankCity": "dba",
    "bankState": "AR",
    "bankRouting": "123123123",
    "bankAccount": "532414124",
    "bankType": "C",
    "bank2": "n"
}
```

### Response
```
{
    "applicationId": 47,
    "applicationHash": "99E1684AAA8D11A5B7587A0A3FDF4FF4",
    "businessContactFirst": "DBA",
    "businessContactLast": "API",
    "businessName": "dbas street",
    "businessAddress1": "Test Address",
    "businessCity": "Tampa",
    "businessState": "FL",
    "businessZip": "33661",
    "businessPhone": "(564) 166-1655",
    "businessEmail": "daniel@test.com",
    "businessTaxid": "123456678",
    "businessDba": "dba API",
    "businessDbaAddress1": "dbas street",
    "businessDbaCity": "Tampa",
    "businessDbaState": "FL",
    "businessDbaZip": "33661",
    "businessDbaPhone": null,
    "businessFax": null,
    "businessNumLocations": null,
    "businessWebsite": null,
    "ownershipType": null,
    "businessOpenDate": null,
    "currentlyProcessingCc": null,
    "swipeF2fPercent": null,
    "swipeMotoPercent": null,
    "swipeInternetPercent": null,
    "txAtStore": null,
    "txAtResidence": null,
    "txAtWarehouse": null,
    "txAtMobile": null,
    "ownerFirst": null,
    "ownerLast": null,
    "ownerDob": null,
    "ownerPercent": null,
    "ownerDl": null,
    "ownerDlState": null,
    "ownerSsn": null,
    "ownerAddress1": null,
    "ownerCity": null,
    "ownerState": null,
    "ownerZip": null,
    "ownerPhone": null,
    "ownerEmail": null,
    "ownerLessthan51pct": null,
    "owner2First": null,
    "owner2Last": null,
    "owner2Dob": null,
    "owner2Percent": null,
    "owner2Dl": null,
    "owner2DlState": null,
    "owner2Ssn": null,
    "owner2Address1": null,
    "owner2City": null,
    "owner2State": null,
    "owner2Zip": null,
    "owner2Phone": null,
    "owner2Email": null,
    "bankNameOnAccount": "DANIEL TEST BANK",
    "bankName": "DANIEL BANK",
    "bankPhone": "(564) 166-1655",
    "bankCity": "dba",
    "bankState": "AR",
    "bankRouting": "123123123",
    "bankAccount": "532414124",
    "avgMonthlyVolume": null,
    "highMonthlyVolume": null,
    "avgTicket": null,
    "highTicket": null,
    "businessDescription": null,
    "acceptAdvance": null,
    "advanceDeposits": false,
    "advancePayment": false,
    "advanceMembership": false,
    "advanceAvgDeposits": null,
    "advanceDaysDepositPaid": null,
    "advanceAvgService": null,
    "advancePctVolume": null,
    "seasonal": null,
    "monthsOpen": null,
    "monthsClosed": null,
    "fulfillmentPerformedBy": null,
    "fulfillmentVendor": null,
    "acceptAmex": null,
    "amexNumber": null,
    "amexCap": null,
    "amexVolume": null,
    "amexAvgTicket": null,
    "acceptAch": null,
    "debitMaxSingleAmount": null,
    "debitMaxDailyAmount": null,
    "debitMaxDailyCount": null,
    "debitMaxAmount14days": null,
    "debitMaxCount14days": null,
    "creditMaxSingleAmount": null,
    "creditMaxDailyAmount": null,
    "creditMaxDailyCount": null,
    "creditMaxAmount14days": null,
    "creditMaxCount14days": null,
    "sectypePpd": false,
    "sectypeCcd": false,
    "sectypeTel": false,
    "sectypeWeb": false,
    "sectypePop": false,
    "sectypeCheck21": false,
    "isoId": null,
    "createdAt": {
        "date": "2021-09-21 20:56:01.049212",
        "timezone_type": 3,
        "timezone": "UTC"
    },
    "roles": [],
    "step": "register_complete",
    "acceptCC": null,
    "currentlyProcessingAch": null,
    "achVerification": null,
    "softwareIntegration": null,
    "softwareIntegrationOther": null,
    "heardAbout": "sales rep",
    "applicationDocs": {},
    "boardedAt": null,
    "sectypeArc": false,
    "sectypeBoc": false,
    "achEquipment": null,
    "ccEquipment": null,
    "ownerTitle": null,
    "owner2Title": null,
    "bank2Routing": null,
    "bank2Account": null,
    "bank2Usedfor": null,
    "bank2": null,
    "mccCode": null,
    "sectypeRck": false,
    "compliantPci": null,
    "pciCertNumber": null,
    "pciCertDate": null,
    "pciPaymentPlan": null,
    "annualVolume": null,
    "storeCardholder": null,
    "goodServicesOn": null,
    "goodServicesDelivered": null,
    "bankType": "C",
    "bank2Type": null,
    "refundPolicy": null,
    "refundPolicyOther": null,
    "locationType": null,
    "txAtRestaurant": null,
    "txAtInternet": null,
    "fulfillmentContact": null,
    "fulfillmentPci": null,
    "fulfillmentPercent": null,
    "activeMonths": [],
    "storePaper": false,
    "storeElectronic": false,
    "pciSecAssessor": null,
    "pciSelfAssessment": null,
    "accCompromise": null,
    "accRemediation": null,
    "achAvgTransaction": null,
    "achAvgMonthly": null,
    "achHighMonthly": null,
    "achHighTicket": null,
    "merchantAdvertise": [],
    "b2bPercent": null,
    "b2bMerchant": null,
    "merchantAdvertiseWeb": null,
    "merchantAdvertiseEmail": null,
    "merchantAdvertiseOther": null,
    "notes": null,
    "merchantId": null
}
```