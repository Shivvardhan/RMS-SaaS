
import { useState } from 'react';
import { useLayoutStore, Product, ProductCategory } from '@/store/layoutStore';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import DraggableItem from './DraggableItem';

const ProductManager = () => {
  const { products, addProduct, removeProduct } = useLayoutStore();
  const [newProduct, setNewProduct] = useState<Omit<Product, 'id'>>({
    name: '',
    category: 'food',
    price: 0,
    stock: 0,
  });

  const handleAddProduct = () => {
    if (newProduct.name.trim() === '') return;
    addProduct(newProduct);
    setNewProduct({
      name: '',
      category: 'food',
      price: 0,
      stock: 0,
    });
  };

  return (
    <Card className="bg-white">
      <CardHeader className="pb-2">
        <CardTitle className="text-lg">Products</CardTitle>
      </CardHeader>
      <CardContent>
        <div className="space-y-4">
          <div className="space-y-2">
            <Label htmlFor="product-name">Product Name</Label>
            <Input
              id="product-name"
              value={newProduct.name}
              onChange={(e) => setNewProduct({ ...newProduct, name: e.target.value })}
              placeholder="Enter product name"
            />
          </div>
          
          <div className="space-y-2">
            <Label htmlFor="product-category">Category</Label>
            <Select 
              value={newProduct.category} 
              onValueChange={(value) => setNewProduct({ ...newProduct, category: value as ProductCategory })}
            >
              <SelectTrigger id="product-category">
                <SelectValue placeholder="Select category" />
              </SelectTrigger>
              <SelectContent>
                <SelectItem value="food">Food</SelectItem>
                <SelectItem value="beverage">Beverage</SelectItem>
                <SelectItem value="electronics">Electronics</SelectItem>
                <SelectItem value="clothing">Clothing</SelectItem>
                <SelectItem value="household">Household</SelectItem>
                <SelectItem value="other">Other</SelectItem>
              </SelectContent>
            </Select>
          </div>
          
          <div className="grid grid-cols-2 gap-2">
            <div className="space-y-2">
              <Label htmlFor="product-price">Price ($)</Label>
              <Input
                id="product-price"
                type="number"
                min="0"
                step="0.01"
                value={newProduct.price}
                onChange={(e) => setNewProduct({ ...newProduct, price: parseFloat(e.target.value) || 0 })}
              />
            </div>
            <div className="space-y-2">
              <Label htmlFor="product-stock">Stock</Label>
              <Input
                id="product-stock"
                type="number"
                min="0"
                value={newProduct.stock}
                onChange={(e) => setNewProduct({ ...newProduct, stock: parseInt(e.target.value) || 0 })}
              />
            </div>
          </div>
          
          <Button onClick={handleAddProduct} className="w-full">Add Product</Button>
        </div>
        
        <div className="mt-4">
          <h3 className="text-sm font-medium mb-2">Available Products:</h3>
          <div className="space-y-2 max-h-[200px] overflow-y-auto pr-2">
            {products.map((product) => (
              <div key={product.id} className="flex items-center space-x-2">
                <div className="flex-grow">
                  <DraggableItem
                    id={product.id}
                    type="product"
                    product={product}
                    width={1}
                    height={1}
                  />
                </div>
                <Button 
                  variant="ghost" 
                  size="sm"
                  className="h-6 w-6 p-0"
                  onClick={() => removeProduct(product.id)}
                >
                  ×
                </Button>
              </div>
            ))}
          </div>
        </div>
      </CardContent>
    </Card>
  );
};

export default ProductManager;
