
import React from 'react';
import { useLayoutStore, ProductCategory } from '@/store/layoutStore';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

const LayoutStats = () => {
  const { items, products } = useLayoutStore();
  
  const shelves = items.filter(item => item.type === 'shelf');
  const aisles = items.filter(item => item.type === 'aisle');
  
  // Count products by category
  const productsByCategory = products.reduce((acc, product) => {
    acc[product.category] = (acc[product.category] || 0) + 1;
    return acc;
  }, {} as Record<ProductCategory, number>);

  // Count total products placed on shelves
  const placedProductsCount = items.reduce((count, item) => {
    if (item.products && Array.isArray(item.products)) {
      count += item.products.length;
    }
    return count;
  }, 0);

  return (
    <Card className="bg-white">
      <CardHeader className="pb-2">
        <CardTitle className="text-lg">Layout Stats</CardTitle>
      </CardHeader>
      <CardContent>
        <div className="grid grid-cols-2 gap-2 text-sm">
          <div>Total Items:</div>
          <div className="font-medium">{items.length}</div>
          
          <div>Shelves:</div>
          <div className="font-medium">{shelves.length}</div>
          
          <div>Aisles:</div>
          <div className="font-medium">{aisles.length}</div>
          
          <div>Products:</div>
          <div className="font-medium">{products.length}</div>
          
          <div>Placed Products:</div>
          <div className="font-medium">{placedProductsCount}</div>
          
          <div className="col-span-2 mt-2 font-medium">Product Categories:</div>
          {Object.entries(productsByCategory).map(([category, count]) => (
            <React.Fragment key={category}>
              <div className="capitalize">{category}:</div>
              <div className="font-medium">{count}</div>
            </React.Fragment>
          ))}
        </div>
      </CardContent>
    </Card>
  );
};

export default LayoutStats;
