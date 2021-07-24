<?php

    namespace App\Models\Midgard\Domains;


    use App\Models\Midgard\Domaindns\DNSControllerInterface;
    use App\Models\Midgard\Domaindns\Domaindns;
    use Http;

    class DnsMadeEasy implements DNSControllerInterface
    {
      
      protected $version = '1.0.0';

        public  $client;
        private $urlApi;
        private $key;
        private $secret;


        public function __construct()
        {
            $this->key    = config('dnsmadeeasy.apikey');
            $this->secret = config('dnsmadeeasy.secret');
            $this->urlApi = 'https://api.dnsmadeeasy.com/V2.0/';
        }


        /**
         * Adds auth headers to requests. These are generated based on the Api Key and the Secret Key.
         *
         * @return array
         * @throws \Exception
         */
        public function WithAuthHeaders(): array
        {
            $now       = new \DateTime('now', new \DateTimeZone('UTC'));
            $timestamp = $now->format('r');
            $hmac      = hash_hmac('sha1', $timestamp, $this->secret);
            $response  = [
                'Content-Type'        => 'application/json',
                'x-dnsme-hmac'        => $hmac,
                'x-dnsme-apiKey'      => $this->key,
                'x-dnsme-requestDate' => $timestamp,
            ];

            return $response;
        }



        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        /** 
        * This gets all the Domains linked to your account with DNS MAde Easy
         * @return array|mixed
         */
        public function domainsAll()
        {
            return Http::withHeaders(self::WithAuthHeaders())->get($this->urlApi . 'dns/managed/')->json();
        }



     /**
         * @param int $domainRemoteID
         * All the Domains DNS for a specific DNS Domain ID (See domainsAll to find a list of all the domains you may have.
         
         *
         */
        public function DnsFromRemoteDomainId(int $domainRemoteID): array
        {
            return Http::withHeaders(self::WithAuthHeaders())
                       ->get("{$this->urlApi}dns/managed/{$domainRemoteID}/records")
                       ->json();
        }
      
            /// CREATE REMOTE DNS DETAILS

        /**
         * @param int $domainRemoteID
         *
         *
         */
        public function CreateRemoteDnsFromRemoteDomainId(int $domainRemoteID, array $dnsDetails): array
        {
            $formattedDnsDetails = [
                'name'        => $dnsDetails['host'] ?? 'From MyMidgard',
                'type'        => strtoupper($dnsDetails['type']) ?? 'TXT',
                'source'      => $dnsDetails['source'] ?? 1,
                'value'       => $dnsDetails['record'],
                'gtdLocation' => $dnsDetails['gtdLocation'] ?? 'DEFAULT',
                "ttl"         => $dnsDetails['ttl'] ?? 86400,
            ];

            return Http::withHeaders(self::WithAuthHeaders())
                       ->post("{$this->urlApi}dns/managed/{$domainRemoteID}/records", $formattedDnsDetails)
                       ->json();
        }

