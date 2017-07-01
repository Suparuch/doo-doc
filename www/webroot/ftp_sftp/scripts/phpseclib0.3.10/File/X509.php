<?php

/**
 * Pure-PHP X.509 Parser
 *
 * PHP versions 4 and 5
 *
 * Encode and decode X.509 certificates.
 *
 * The extensions are from {@link http://tools.ietf.org/html/rfc5280 RFC5280} and
 * {@link http://web.archive.org/web/19961027104704/http://www3.netscape.com/eng/security/cert-exts.html Netscape Certificate Extensions}.
 *
 * Note that loading an X.509 certificate and resaving it may invalidate the signature.  The reason being that the signature is based on a
 * portion of the certificate that contains optional parameters with default values.  ie. if the parameter isn't there the default value is
 * used.  Problem is, if the parameter is there and it just so happens to have the default value there are two ways that that parameter can
 * be encoded.  It can be encoded explicitly or left out all together.  This would effect the signature value and thus may invalidate the
 * the certificate all together unless the certificate is re-signed.
 *
 * LICENSE: Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category  File
 * @package   File_X509
 * @author    Jim Wigginton <terrafrost@php.net>
 * @copyright 2012 Jim Wigginton
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      http://phpseclib.sourceforge.net
 */

/**
 * Include File_ASN1
 */
if (!class_exists('File_ASN1')) {
    include_once 'ASN1.php';
}

/**
 * Flag to only accept signatures signed by certificate authorities
 *
 * Not really used anymore but retained all the same to suppress E_NOTICEs from old installs
 *
 * @access public
 */
define('FILE_X509_VALIDATE_SIGNATURE_BY_CA', 1);

/**#@+
 * @access public
 * @see File_X509::getDN()
 */
/**
 * Return internal array representation
 */
define('FILE_X509_DN_ARRAY', 0);
/**
 * Return string
 */
define('FILE_X509_DN_STRING', 1);
/**
 * Return ASN.1 name string
 */
define('FILE_X509_DN_ASN1', 2);
/**
 * Return OpenSSL compatible array
 */
define('FILE_X509_DN_OPENSSL', 3);
/**
 * Return canonical ASN.1 RDNs string
 */
define('FILE_X509_DN_CANON', 4);
/**
 * Return name hash for file indexing
 */
define('FILE_X509_DN_HASH', 5);
/**#@-*/

/**#@+
 * @access public
 * @see File_X509::saveX509()
 * @see File_X509::saveCSR()
 * @see File_X509::saveCRL()
 */
/**
 * Save as PEM
 *
 * ie. a base64-encoded PEM with a header and a footer
 */
define('FILE_X509_FORMAT_PEM', 0);
/**
 * Save as DER
 */
define('FILE_X509_FORMAT_DER', 1);
/**
 * Save as a SPKAC
 *
 * Only works on CSRs. Not currently supported.
 */
define('FILE_X509_FORMAT_SPKAC', 2);
/**#@-*/

/**
 * Attribute value disposition.
 * If disposition is >= 0, this is the index of the target value.
 */
define('FILE_X509_ATTR_ALL', -1); // All attribute values (array).
define('FILE_X509_ATTR_APPEND', -2); // Add a value.
define('FILE_X509_ATTR_REPLACE', -3); // Clear first, then add a value.

/**
 * Pure-PHP X.509 Parser
 *
 * @package File_X509
 * @author  Jim Wigginton <terrafrost@php.net>
 * @access  public
 */
class File_X509
{
    /**
     * ASN.1 syntax for X.509 certificates
     *
     * @var Array
     * @access private
     */
    var $Certificate;

    /**#@+
     * ASN.1 syntax for various extensions
     *
     * @access private
     */
    var $DirectoryString;
    var $PKCS9String;
    var $AttributeValue;
    var $Extensions;
    var $KeyUsage;
    var $ExtKeyUsageSyntax;
    var $BasicConstraints;
    var $KeyIdentifier;
    var $CRLDistributionPoints;
    var $AuthorityKeyIdentifier;
    var $CertificatePolicies;
    var $AuthorityInfoAccessSyntax;
    var $SubjectAltName;
    var $PrivateKeyUsagePeriod;
    var $IssuerAltName;
    var $PolicyMappings;
    var $NameConstraints;

    var $CPSuri;
    var $UserNotice;

    var $netscape_cert_type;
    var $netscape_comment;
    var $netscape_ca_policy_url;

    var $Name;
    var $RelativeDistinguishedName;
    var $CRLNumber;
    var $CRLReason;
    var $IssuingDistributionPoint;
    var $InvalidityDate;
    var $CertificateIssuer;
    var $HoldInstructionCode;
    var $SignedPublicKeyAndChallenge;
    /**#@-*/

    /**
     * ASN.1 syntax for Certificate Signing Requests (RFC2986)
     *
     * @var Array
     * @access private
     */
    var $CertificationRequest;

    /**
     * ASN.1 syntax for Certificate Revocation Lists (RFC5280)
     *
     * @var Array
     * @access private
     */
    var $CertificateList;

    /**
     * Distinguished Name
     *
     * @var Array
     * @access private
     */
    var $dn;

    /**
     * Public key
     *
     * @var String
     * @access private
     */
    var $publicKey;

    /**
     * Private key
     *
     * @var String
     * @access private
     */
    var $privateKey;

    /**
     * Object identifiers for X.509 certificates
     *
     * @var Array
     * @access private
     * @link http://en.wikipedia.org/wiki/Object_identifier
     */
    var $oids;

    /**
     * The certificate authorities
     *
     * @var Array
     * @access private
     */
    var $CAs;

    /**
     * The currently loaded certificate
     *
     * @var Array
     * @access private
     */
    var $currentCert;

    /**
     * The signature subject
     *
     * There's no guarantee File_X509 is going to reencode an X.509 cert in the same way it was originally
     * encoded so we take save the portion of the original cert that the signature would have made for.
     *
     * @var String
     * @access private
     */
    var $signatureSubject;

    /**
     * Certificate Start Date
     *
     * @var String
     * @access private
     */
    var $startDate;

    /**
     * Certificate End Date
     *
     * @var String
     * @access private
     */
    var $endDate;

    /**
     * Serial Number
     *
     * @var String
     * @access private
     */
    var $serialNumber;

    /**
     * Key Identifier
     *
     * See {@link http://tools.ietf.org/html/rfc5280#section-4.2.1.1 RFC5280#section-4.2.1.1} and
     * {@link http://tools.ietf.org/html/rfc5280#section-4.2.1.2 RFC5280#section-4.2.1.2}.
     *
     * @var String
     * @access private
     */
    var $currentKeyIdentifier;

    /**
     * CA Flag
     *
     * @var Boolean
     * @access private
     */
    var $caFlag = false;

    /**
     * SPKAC Challenge
     *
     * @var String
     * @access private
     */
    var $challenge;

    /**
     * Default Constructor.
     *
     * @return File_X509
     * @access public
     */
    function File_X509()
    {
        if (!class_exists('Math_BigInteger')) {
            include_once 'Math/BigInteger.php';
        }

        // Explicitly Tagged Module, 1988 Syntax
        // http://tools.ietf.org/html/rfc5280#appendix-A.1

        $this->DirectoryString = array(
            'type'     => FILE_ASN1_TYPE_CHOICE,
            'children' => array(
                'teletexString'   => array('type' => FILE_ASN1_TYPE_TELETEX_STRING),
                'printableString' => array('type' => FILE_ASN1_TYPE_PRINTABLE_STRING),
                'universalString' => array('type' => FILE_ASN1_TYPE_UNIVERSAL_STRING),
                'utf8String'      => array('type' => FILE_ASN1_TYPE_UTF8_STRING),
                'bmpString'       => array('type' => FILE_ASN1_TYPE_BMP_STRING)
            )
        );

        $this->PKCS9String = array(
            'type'     => FILE_ASN1_TYPE_CHOICE,
            'children' => array(
                'ia5String'       => array('type' => FILE_ASN1_TYPE_IA5_STRING),
                'directoryString' => $this->DirectoryString
            )
        );

        $this->AttributeValue = array('type' => FILE_ASN1_TYPE_ANY);

        $AttributeType = array('type' => FILE_ASN1_TYPE_OBJECT_IDENTIFIER);

        $AttributeTypeAndValue = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'children' => array(
                'type' => $AttributeType,
                'value'=> $this->AttributeValue
            )
        );

        /*
        In practice, RDNs containing multiple name-value pairs (called "multivalued RDNs") are rare,
        but they can be useful at times when either there is no unique attribute in the entry or you
        want to ensure that the entry's DN contains some useful identifying information.

        - https://www.opends.org/wiki/page/DefinitionRelativeDistinguishedName
        */
        $this->RelativeDistinguishedName = array(
            'type'     => FILE_ASN1_TYPE_SET,
            'min'      => 1,
            'max'      => -1,
            'children' => $AttributeTypeAndValue
        );

        // http://tools.ietf.org/html/rfc5280#section-4.1.2.4
        $RDNSequence = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            // RDNSequence does not define a min or a max, which means it doesn't have one
            'min'      => 0,
            'max'      => -1,
            'children' => $this->RelativeDistinguishedName
        );

        $this->Name = array(
            'type'     => FILE_ASN1_TYPE_CHOICE,
            'children' => array(
                'rdnSequence' => $RDNSequence
            )
        );

        // http://tools.ietf.org/html/rfc5280#section-4.1.1.2
        $AlgorithmIdentifier = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'children' => array(
                'algorithm'  => array('type' => FILE_ASN1_TYPE_OBJECT_IDENTIFIER),
                'parameters' => array(
                                    'type'     => FILE_ASN1_TYPE_ANY,
                                    'optional' => true
                                )
            )
        );

        /*
           A certificate using system MUST reject the certificate if it encounters
           a critical extension it does not recognize; however, a non-critical
           extension may be ignored if it is not recognized.

           http://tools.ietf.org/html/rfc5280#section-4.2
        */
        $Extension = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'children' => array(
                'extnId'   => array('type' => FILE_ASN1_TYPE_OBJECT_IDENTIFIER),
                'critical' => array(
                                  'type'     => FILE_ASN1_TYPE_BOOLEAN,
                                  'optional' => true,
                                  'default'  => false
                              ),
                'extnValue' => array('type' => FILE_ASN1_TYPE_OCTET_STRING)
            )
        );

        $this->Extensions = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'min'      => 1,
            // technically, it's MAX, but we'll assume anything < 0 is MAX
            'max'      => -1,
            // if 'children' isn't an array then 'min' and 'max' must be defined
            'children' => $Extension
        );

        $SubjectPublicKeyInfo = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'children' => array(
                'algorithm'        => $AlgorithmIdentifier,
                'subjectPublicKey' => array('type' => FILE_ASN1_TYPE_BIT_STRING)
            )
        );

        $UniqueIdentifier = array('type' => FILE_ASN1_TYPE_BIT_STRING);

        $Time = array(
            'type'     => FILE_ASN1_TYPE_CHOICE,
            'children' => array(
                'utcTime'     => array('type' => FILE_ASN1_TYPE_UTC_TIME),
                'generalTime' => array('type' => FILE_ASN1_TYPE_GENERALIZED_TIME)
            )
        );

        // http://tools.ietf.org/html/rfc5280#section-4.1.2.5
        $Validity = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'children' => array(
                'notBefore' => $Time,
                'notAfter'  => $Time
            )
        );

        $CertificateSerialNumber = array('type' => FILE_ASN1_TYPE_INTEGER);

        $Version = array(
            'type'    => FILE_ASN1_TYPE_INTEGER,
            'mapping' => array('v1', 'v2', 'v3')
        );

        // assert($TBSCertificate['children']['signature'] == $Certificate['children']['signatureAlgorithm'])
        $TBSCertificate = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'children' => array(
                // technically, default implies optional, but we'll define it as being optional, none-the-less, just to
                // reenforce that fact
                'version'             => array(
                                             'constant' => 0,
                                             'optional' => true,
                                             'explicit' => true,
                                             'default'  => 'v1'
                                         ) + $Version,
                'serialNumber'         => $CertificateSerialNumber,
                'signature'            => $AlgorithmIdentifier,
                'issuer'               => $this->Name,
                'validity'             => $Validity,
                'subject'              => $this->Name,
                'subjectPublicKeyInfo' => $SubjectPublicKeyInfo,
                // implicit means that the T in the TLV structure is to be rewritten, regardless of the type
                'issuerUniqueID'       => array(
                                               'constant' => 1,
                                               'optional' => true,
                                               'implicit' => true
                                           ) + $UniqueIdentifier,
                'subjectUniqueID'       => array(
                                               'constant' => 2,
                                               'optional' => true,
                                               'implicit' => true
                                           ) + $UniqueIdentifier,
                // <http://tools.ietf.org/html/rfc2459#page-74> doesn't use the EXPLICIT keyword but if
                // it's not IMPLICIT, it's EXPLICIT
                'extensions'            => array(
                                               'constant' => 3,
                                               'optional' => true,
                                               'explicit' => true
                                           ) + $this->Extensions
            )
        );

        $this->Certificate = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'children' => array(
                 'tbsCertificate'     => $TBSCertificate,
                 'signatureAlgorithm' => $AlgorithmIdentifier,
                 'signature'          => array('type' => FILE_ASN1_TYPE_BIT_STRING)
            )
        );

        $this->KeyUsage = array(
            'type'    => FILE_ASN1_TYPE_BIT_STRING,
            'mapping' => array(
                'digitalSignature',
                'nonRepudiation',
                'keyEncipherment',
                'dataEncipherment',
                'keyAgreement',
                'keyCertSign',
                'cRLSign',
                'encipherOnly',
                'decipherOnly'
            )
        );

        $this->BasicConstraints = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'children' => array(
                'cA'                => array(
                                                 'type'     => FILE_ASN1_TYPE_BOOLEAN,
                                                 'optional' => true,
                                                 'default'  => false
                                       ),
                'pathLenConstraint' => array(
                                                 'type' => FILE_ASN1_TYPE_INTEGER,
                                                 'optional' => true
                                       )
            )
        );

        $this->KeyIdentifier = array('type' => FILE_ASN1_TYPE_OCTET_STRING);

        $OrganizationalUnitNames = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'min'      => 1,
            'max'      => 4, // ub-organizational-units
            'children' => array('type' => FILE_ASN1_TYPE_PRINTABLE_STRING)
        );

        $PersonalName = array(
            'type'     => FILE_ASN1_TYPE_SET,
            'children' => array(
                'surname'              => array(
                                           'type' => FILE_ASN1_TYPE_PRINTABLE_STRING,
                                           'constant' => 0,
                                           'optional' => true,
                                           'implicit' => true
                                         ),
                'given-name'           => array(
                                           'type' => FILE_ASN1_TYPE_PRINTABLE_STRING,
                                           'constant' => 1,
                                           'optional' => true,
                                           'implicit' => true
                                         ),
                'initials'             => array(
                                           'type' => FILE_ASN1_TYPE_PRINTABLE_STRING,
                                           'constant' => 2,
                                           'optional' => true,
                                           'implicit' => true
                                         ),
                'generation-qualifier' => array(
                                           'type' => FILE_ASN1_TYPE_PRINTABLE_STRING,
                                           'constant' => 3,
                                           'optional' => true,
                                           'implicit' => true
                                         )
            )
        );

        $NumericUserIdentifier = array('type' => FILE_ASN1_TYPE_NUMERIC_STRING);

        $OrganizationName = array('type' => FILE_ASN1_TYPE_PRINTABLE_STRING);

        $PrivateDomainName = array(
            'type'     => FILE_ASN1_TYPE_CHOICE,
            'children' => array(
                'numeric'   => array('type' => FILE_ASN1_TYPE_NUMERIC_STRING),
                'printable' => array('type' => FILE_ASN1_TYPE_PRINTABLE_STRING)
            )
        );

        $TerminalIdentifier = array('type' => FILE_ASN1_TYPE_PRINTABLE_STRING);

        $NetworkAddress = array('type' => FILE_ASN1_TYPE_NUMERIC_STRING);

        $AdministrationDomainName = array(
            'type'     => FILE_ASN1_TYPE_CHOICE,
            // if class isn't present it's assumed to be FILE_ASN1_CLASS_UNIVERSAL or
            // (if constant is present) FILE_ASN1_CLASS_CONTEXT_SPECIFIC
            'class'    => FILE_ASN1_CLASS_APPLICATION,
            'cast'     => 2,
            'children' => array(
                'numeric'   => array('type' => FILE_ASN1_TYPE_NUMERIC_STRING),
                'printable' => array('type' => FILE_ASN1_TYPE_PRINTABLE_STRING)
            )
        );

        $CountryName = array(
            'type'     => FILE_ASN1_TYPE_CHOICE,
            // if class isn't present it's assumed to be FILE_ASN1_CLASS_UNIVERSAL or
            // (if constant is present) FILE_ASN1_CLASS_CONTEXT_SPECIFIC
            'class'    => FILE_ASN1_CLASS_APPLICATION,
            'cast'     => 1,
            'children' => array(
                'x121-dcc-code'        => array('type' => FILE_ASN1_TYPE_NUMERIC_STRING),
                'iso-3166-alpha2-code' => array('type' => FILE_ASN1_TYPE_PRINTABLE_STRING)
            )
        );

        $AnotherName = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'children' => array(
                 'type-id' => array('type' => FILE_ASN1_TYPE_OBJECT_IDENTIFIER),
                 'value'   => array(
                                  'type' => FILE_ASN1_TYPE_ANY,
                                  'constant' => 0,
                                  'optional' => true,
                                  'explicit' => true
                              )
            )
        );

        $ExtensionAttribute = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'children' => array(
                 'extension-attribute-type'  => array(
                                                    'type' => FILE_ASN1_TYPE_PRINTABLE_STRING,
                                                    'constant' => 0,
                                                    'optional' => true,
                                                    'implicit' => true
                                                ),
                 'extension-attribute-value' => array(
                                                    'type' => FILE_ASN1_TYPE_ANY,
                                                    'constant' => 1,
                                                    'optional' => true,
                                                    'explicit' => true
                                                )
            )
        );

        $ExtensionAttributes = array(
            'type'     => FILE_ASN1_TYPE_SET,
            'min'      => 1,
            'max'      => 256, // ub-extension-attributes
            'children' => $ExtensionAttribute
        );

        $BuiltInDomainDefinedAttribute = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'children' => array(
                 'type'  => array('type' => FILE_ASN1_TYPE_PRINTABLE_STRING),
                 'value' => array('type' => FILE_ASN1_TYPE_PRINTABLE_STRING)
            )
        );

        $BuiltInDomainDefinedAttributes = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'min'      => 1,
            'max'      => 4, // ub-domain-defined-attributes
            'children' => $BuiltInDomainDefinedAttribute
        );

        $BuiltInStandardAttributes =  array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'children' => array(
                'country-name'               => array('optional' => true) + $CountryName,
                'administration-domain-name' => array('optional' => true) + $AdministrationDomainName,
                'network-address'            => array(
                                                 'constant' => 0,
                                                 'optional' => true,
                                                 'implicit' => true
                                               ) + $NetworkAddress,
                'terminal-identifier'        => array(
                                                 'constant' => 1,
                                                 'optional' => true,
                                                 'implicit' => true
                                               ) + $TerminalIdentifier,
                'private-domain-name'        => array(
                                                 'constant' => 2,
                                                 'optional' => true,
                                                 'explicit' => true
                                               ) + $PrivateDomainName,
                'organization-name'          => array(
                                                 'constant' => 3,
                                                 'optional' => true,
                                                 'implicit' => true
                                               ) + $OrganizationName,
                'numeric-user-identifier'    => array(
                                                 'constant' => 4,
                                                 'optional' => true,
                                                 'implicit' => true
                                               ) + $NumericUserIdentifier,
                'personal-name'              => array(
                                                 'constant' => 5,
                                                 'optional' => true,
                                                 'implicit' => true
                                               ) + $PersonalName,
                'organizational-unit-names'  => array(
                                                 'constant' => 6,
                                                 'optional' => true,
                                                 'implicit' => true
                                               ) + $OrganizationalUnitNames
            )
        );

        $ORAddress = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'children' => array(
                 'built-in-standard-attributes'       => $BuiltInStandardAttributes,
                 'built-in-domain-defined-attributes' => array('optional' => true) + $BuiltInDomainDefinedAttributes,
                 'extension-attributes'               => array('optional' => true) + $ExtensionAttributes
            )
        );

        $EDIPartyName = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'children' => array(
                 'nameAssigner' => array(
                                    'constant' => 0,
                                    'optional' => true,
                                    'implicit' => true
                                ) + $this->DirectoryString,
                 // partyName is technically required but File_ASN1 doesn't currently support non-optional constants and
                 // setting it to optional gets the job done in any event.
                 'partyName'    => array(
                                    'constant' => 1,
                                    'optional' => true,
                                    'implicit' => true
                                ) + $this->DirectoryString
            )
        );

        $GeneralName = array(
            'type'     => FILE_ASN1_TYPE_CHOICE,
            'children' => array(
                'otherName'                 => array(
                                                 'constant' => 0,
                                                 'optional' => true,
                                                 'implicit' => true
                                               ) + $AnotherName,
                'rfc822Name'                => array(
                                                 'type' => FILE_ASN1_TYPE_IA5_STRING,
                                                 'constant' => 1,
                                                 'optional' => true,
                                                 'implicit' => true
                                               ),
                'dNSName'                   => array(
                                                 'type' => FILE_ASN1_TYPE_IA5_STRING,
                                                 'constant' => 2,
                                                 'optional' => true,
                                                 'implicit' => true
                                               ),
                'x400Address'               => array(
                                                 'constant' => 3,
                                                 'optional' => true,
                                                 'implicit' => true
                                               ) + $ORAddress,
                'directoryName'             => array(
                                                 'constant' => 4,
                                                 'optional' => true,
                                                 'explicit' => true
                                               ) + $this->Name,
                'ediPartyName'              => array(
                                                 'constant' => 5,
                                                 'optional' => true,
                                                 'implicit' => true
                                               ) + $EDIPartyName,
                'uniformResourceIdentifier' => array(
                                                 'type' => FILE_ASN1_TYPE_IA5_STRING,
                                                 'constant' => 6,
                                                 'optional' => true,
                                                 'implicit' => true
                                               ),
                'iPAddress'                 => array(
                                                 'type' => FILE_ASN1_TYPE_OCTET_STRING,
                                                 'constant' => 7,
                                                 'optional' => true,
                                                 'implicit' => true
                                               ),
                'registeredID'              => array(
                                                 'type' => FILE_ASN1_TYPE_OBJECT_IDENTIFIER,
                                                 'constant' => 8,
                                                 'optional' => true,
                                                 'implicit' => true
                                               )
            )
        );

        $GeneralNames = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'min'      => 1,
            'max'      => -1,
            'children' => $GeneralName
        );

        $this->IssuerAltName = $GeneralNames;

        $ReasonFlags = array(
            'type'    => FILE_ASN1_TYPE_BIT_STRING,
            'mapping' => array(
                'unused',
                'keyCompromise',
                'cACompromise',
                'affiliationChanged',
                'superseded',
                'cessationOfOperation',
                'certificateHold',
                'privilegeWithdrawn',
                'aACompromise'
            )
        );

        $DistributionPointName = array(
            'type'     => FILE_ASN1_TYPE_CHOICE,
            'children' => array(
                'fullName'                => array(
                                                 'constant' => 0,
                                                 'optional' => true,
                                                 'implicit' => true
                                       ) + $GeneralNames,
                'nameRelativeToCRLIssuer' => array(
                                                 'constant' => 1,
                                                 'optional' => true,
                                                 'implicit' => true
                                       ) + $this->RelativeDistinguishedName
            )
        );

        $DistributionPoint = array(
            'type'     => FILE_ASN1_TYPE_SEQUENCE,
            'children' => array(
                'distributionPoint' => array(
                                                 'constant' => 0,
                                                 'optional' => true,
                                                 'explicit' => true
                                       ) + $D