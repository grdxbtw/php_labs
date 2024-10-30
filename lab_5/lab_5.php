<?php

class Product
{
    public string $name;    
    public string $description;
    protected float $price;

    public function __construct(string $name, float $price, string $description)
    {
        if ($price < 0) {
            throw new InvalidArgumentException("Price cannot be negative.");
        }
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public function getInfo(): string
    {
        return "Name: {$this->name}<br>Price: {$this->price}<br>Description: {$this->description}<br>";
    }
}

class DiscountedProduct extends Product
{
    public float $discount;

    public function __construct(string $name, float $price, string $description, float $discount)
    {
        parent::__construct($name, $price, $description);
        $this->discount = $discount;
    }

    public function getDiscountedPrice(): float
    {
        return $this->price * (1 - $this->discount / 100);
    }

    public function getInfo(): string
    {
        $discountedPrice = $this->getDiscountedPrice();
        return parent::getInfo() . "Discount: {$this->discount}%<br>New Price: {$discountedPrice}<br>";
    }
}

class Category
{
    public string $name;
    public array $products;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->products = [];
    }

    public function addProduct(Product $product): void
    {
        $this->products[] = $product;
    }

    public function getProductsInfo(): string
    {
        $info = "Category: {$this->name}<br>";
        foreach ($this->products as $product) {
            $info .= $product->getInfo() . "<br>";
        }
        return $info;
    }
}

$product1 = new Product("Laptop", 1600.00, "Game laptop.");
$product2 = new Product("Ipad", 1000.00, "New ipad model");

$discountedProduct1 = new DiscountedProduct("Phone", 1200.00, "New modern phone.", 10);
$discountedProduct2 = new DiscountedProduct("Airpods", 200.00, "Wairless airpods.", 15);

echo $product1->getInfo() . "<br>";
echo $product2->getInfo() . "<br>";
echo $discountedProduct1->getInfo() . "<br>";
echo $discountedProduct2->getInfo() . "<br>";

$category = new Category("Electronics");
$category->addProduct($product1);
$category->addProduct($product2);

echo $category->getProductsInfo();

$discountCategory = new Category("Promotional Items");
$discountCategory->addProduct($discountedProduct1);
$discountCategory->addProduct($discountedProduct2);

echo $discountCategory->getProductsInfo();

?>