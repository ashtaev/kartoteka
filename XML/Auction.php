<?php

class Auction
{
    private $document;
    private $xmlStr;

    public function __construct($file) {
        $str = file_get_contents($file);
        $this->xmlStr = preg_replace('/&(?!;{6})/', '&amp;', $str);

        if(simplexml_load_string($this->xmlStr)) {
            $this->createDomDocument($this->xmlStr);
        } else {
            throw new Exception('Bad XML');
        }
    }

    public function getBankruptInfo(): array
    {
        $name = $this->getTag($this->document, 'NameHistoryItem')->nodeValue;
        $bankruptPerson = $this->getTag($this->document, 'BankruptPerson');
        $id = $bankruptPerson->getAttribute('Id');
        $insolventCategoryName = $bankruptPerson
            ->getAttribute('InsolventCategoryName');

        return [
            $id,
            $insolventCategoryName,
            $name
        ];
    }

    public static function xmlValidate($file): array
    {
        libxml_use_internal_errors(true);
        $sxe = simplexml_load_file($file);
        $res = [];
        if (!$sxe) {
            $res['desc'] = "Ошибка загрузки XML";
            foreach(libxml_get_errors() as $error) {
                $res['errors'][] =
                    trim($error->message)
                    . " in line " . $error->line
                    . " in column " . $error->column
                    . " in file: " . $error->file;
            }
        }
        return $res;
    }

    public function getAuctionLots(): array
    {
        $auctions = $this->document
            ->getElementsByTagName('AuctionLot');
        $lots = [];
        foreach ($auctions as $auction) {
            $lot['order'] = $this->getTag($auction, 'Order')->nodeValue;
            $lot['start-price'] = $this->getTag($auction, 'StartPrice')->nodeValue;
            $lot['description'] = $this->getTag($auction, 'Description')->nodeValue;
            $lot['description'] = trim($lot['description']);
            $lots[] = $lot;
        }

        return $lots;
    }

    private function createDomDocument($str) {
        $this->document = new DOMDocument();
        $this->document->loadXML($str);
    }

    private function getTag($obj, $tag) {
        return $obj
            ->getElementsByTagName($tag)
            ->item(0);
    }
}
