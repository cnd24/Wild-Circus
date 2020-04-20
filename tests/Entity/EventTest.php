<?php


namespace App\Tests\Entity;
use App\Entity\Event;
use PHPUnit\Framework\TestCase;


class EventTest extends TestCase
{
    /**
     * @dataProvider pricesForAdults
     */
    public function testPricesForAdults($basisPrice, $expectedPrice)
    {
        $event = new Event();
        $result = $event->getPriceByAge(Event::CATEGORIES_PEOPLE[0], $basisPrice);

        $this->assertSame($expectedPrice, $result);
    }

    public function pricesForAdults(){
        return [
            [10, 10],
            [0, 0],
            [20, 20]
        ];
    }

    /**
     * @dataProvider pricesForChildren
     */
    public function testPricesForChildren($basisPrice, $expectedPrice)
    {
        $event = new Event();
        $result = $event->getPriceByAge(Event::CATEGORIES_PEOPLE[1], $basisPrice);

        $this->assertSame($expectedPrice, $result);
    }

    public function pricesForChildren(){
        return [
            [10, 5],
            [0, 0],
            [20, 10]
        ];
    }

/*    public function testComputeTVAProductTypeOther()
    {
        $product = new Product('nom', 'other', 10);
        $result = $product->computeTVA();

        $this->assertSame(1.96, $result);
    }

    public function testNegativePriceComputeTVA()
    {
        $product = new Product('nom', 'other', -1);
        $this->expectException('LogicException');
        $product->computeTVA();
    }*/


}
