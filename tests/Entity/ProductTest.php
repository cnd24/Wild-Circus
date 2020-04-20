<?php


namespace App\Tests\Entity;
use App\Entity\Product;
use PHPUnit\Framework\TestCase;


class ProductTest extends TestCase
{
    /**
     * @dataProvider pricesForFoodProduct
     */
    public function testComputeTVAProductTypeFood($price, $expectedTva)
    {
        $product = new Product('nom', Product::FOOD_PRODUCT, $price);
        $result = $product->computeTVA();

        $this->assertSame($expectedTva, $result);
    }

    public function testComputeTVAProductTypeOther()
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
    }

    public function pricesForFoodProduct(){
        return [
            [10, 0.55],
            [0, 0.0],
            [100, 5.5]
        ];
    }
}
