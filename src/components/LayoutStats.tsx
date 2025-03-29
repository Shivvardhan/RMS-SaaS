
import React from 'react';
import { useLayoutStore } from '@/store/layoutStore';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

const LayoutStats = () => {
  const { items } = useLayoutStore();
  
  const shelves = items.filter(item => item.type === 'shelf');
  const aisles = items.filter(item => item.type === 'aisle');
  
  const zoneCount = items.reduce((acc, item) => {
    if (item.zone) {
      acc[item.zone] = (acc[item.zone] || 0) + 1;
    }
    return acc;
  }, {} as Record<string, number>);

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
          
          <div className="col-span-2 mt-2 font-medium">Zone Distribution:</div>
          {Object.entries(zoneCount).map(([zone, count]) => (
            <React.Fragment key={zone}>
              <div className="capitalize">{zone}:</div>
              <div className="font-medium">{count}</div>
            </React.Fragment>
          ))}
        </div>
      </CardContent>
    </Card>
  );
};

export default LayoutStats;
