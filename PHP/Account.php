<?php

// В условии было указанно, что данные должны поступать в метод,
// но я думаю счет было бы лучше передавать в конструктор
class Account {

    /** Ставка НДС по умолчанию */
    private $vat_rate = 20;

    /**
     * Возвращает стоимость без НДС
     *
     * @param string $amount Счет, в котором указана сумма с НДС, есть дата счета и все прочие атрибуты
     * @return float Стоимость без НДС
     * @throws Exception
     */
    public function getAmountWithoutNDS(string $amount): float {

        $objAmount = json_decode($amount);

        if(!$objAmount) {
            throw new Exception('Неверный формат счета');
        }

        if(!isset($objAmount->sum)
            || !is_numeric($objAmount->sum)
            || $objAmount->sum < 0)
        {
            throw new Exception('Не заданна сумма или неверный формат суммы');
        }

        $vat_rate = $objAmount->vat_rate ?? $this->vat_rate;

        if(!is_numeric($vat_rate) || $vat_rate < 0)
        {
            throw new Exception('Неверный формат ставки НДС');
        }

        $vat = $objAmount->sum * $objAmount->vat_rate
            / ($objAmount->vat_rate + 100);

        return round($objAmount->sum - $vat, 2);
    }
}
