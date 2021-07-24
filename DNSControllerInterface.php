<?php


    namespace App\Models\Midgard\Domaindns;


    interface DNSControllerInterface
    {


        public function WithAuthHeaders();

        public function getDomainDetailsFromName(string $domain);

        public function getDomainDetailsFromLocalDomainId(int $localLocalDomainID);

        public function getDomainDetailsFromRemoteDomainId(int $remoteDomainID);

        public function DnsFromDomainName(string $domainName): array;

        public function DnsFromLocalDomainId(int $localLocalDomainID): array;

        public function DnsFromRemoteDomainId(int $remoteDomainID): array;

        public function UpdateLocalDnsFromRemoteDnsViaDomainName(string $domainName);

        public function UpdateLocalDnsFromRemoteDnsViaLocalDomainID(int $localDomainID);

        public function UpdateLocalDnsFromRemoteDnsViaRemoteDomainID(int $domainRemoteID);

        public function CreateRemoteDnsFromRemoteDomainId(int $remoteDomainID, array $dnsDetails): array;

        public function CreateRemoteDnsViaDomainName(string $domainName, array $dnsDetails): array;

        public function CreateRemoteDnsViaLocalDomainID(int $localDomainID, array $dnsDetails): array;

        public function UpdateRemoteDnsFromRemoteDomainId(int $remoteDomainID, array $dnsDetails, $originalContent);

        public function UpdateRemoteDnsViaDomainName(string $domainName, array $dnsDetails, $originalContent);

        public function UpdateRemoteDnsViaLocalDomainID(int $localDomainID, array $dnsDetails, $originalContent): array;

        public function DeleteRemoteDnsFromRemoteDomainId(int $remoteDomainID, array $dnsDetails);

        public function DeleteRemoteDnsViaDomainName(string $domainName, array $dnsDetails);

        public function DeleteRemoteDnsViaLocalDomainID(int $localDomainID, array $dnsDetails): array;

        public function NameserversFromDomainName(string $domainName): array;

        public function NameserversFromLocalDomainId(int $localLocalDomainID): array;

        public function NameserversFromRemoteDomainId(int $remoteDomainID): array;


        public function UpdateLocalNameserversFromDomainName(string $domainName): array;

        public function UpdateLocalNameserversFromLocalDomainId(int $localLocalDomainID): array;

        public function UpdateLocalNameserversFromRemoteDomainId(int $remoteDomainID): array;


    }
