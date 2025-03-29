
import { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { ShelfType, ZoneType } from '@/store/layoutStore';
import DraggableItem from './DraggableItem';

const Toolbar = () => {
  const [selectedZone, setSelectedZone] = useState<ZoneType>('grocery');

  const shelfTypes: { type: ShelfType; width: number; height: number }[] = [
    { type: 'standard', width: 2, height: 1 },
    { type: 'wide', width: 3, height: 1 },
    { type: 'endcap', width: 2, height: 2 },
    { type: 'island', width: 3, height: 2 },
  ];

  const aisleTypes = [
    { width: 1, height: 3 },
    { width: 1, height: 5 },
  ];

  return (
    <div className="bg-white p-4 border border-gray-200 rounded-lg">
      <Tabs defaultValue="shelves">
        <TabsList className="grid w-full grid-cols-2 mb-4">
          <TabsTrigger value="shelves">Shelves</TabsTrigger>
          <TabsTrigger value="aisles">Aisles</TabsTrigger>
        </TabsList>

        <div className="mb-4">
          <label className="block text-sm font-medium mb-2">Zone</label>
          <Select value={selectedZone} onValueChange={(value) => setSelectedZone(value as ZoneType)}>
            <SelectTrigger>
              <SelectValue placeholder="Select Zone" />
            </SelectTrigger>
            <SelectContent>
              <SelectItem value="grocery">Grocery</SelectItem>
              <SelectItem value="frozen">Frozen</SelectItem>
              <SelectItem value="bakery">Bakery</SelectItem>
              <SelectItem value="produce">Produce</SelectItem>
              <SelectItem value="electronics">Electronics</SelectItem>
              <SelectItem value="clothing">Clothing</SelectItem>
            </SelectContent>
          </Select>
        </div>

        <TabsContent value="shelves" className="space-y-3">
          <div className="font-medium">Drag to place:</div>
          <div className="grid grid-cols-2 gap-3">
            {shelfTypes.map((shelf, index) => (
              <div key={`shelf-${index}`} className="flex flex-col items-center justify-center gap-2">
                <DraggableItem
                  type="shelf"
                  shelfType={shelf.type}
                  zone={selectedZone}
                  width={shelf.width}
                  height={shelf.height}
                />
                <span className="text-xs">{shelf.type}</span>
              </div>
            ))}
          </div>
        </TabsContent>

        <TabsContent value="aisles" className="space-y-3">
          <div className="font-medium">Drag to place:</div>
          <div className="grid grid-cols-2 gap-3">
            {aisleTypes.map((aisle, index) => (
              <div key={`aisle-${index}`} className="flex flex-col items-center justify-center gap-2">
                <DraggableItem
                  type="aisle"
                  zone={selectedZone}
                  width={aisle.width}
                  height={aisle.height}
                />
                <span className="text-xs">{`${aisle.width}x${aisle.height}`}</span>
              </div>
            ))}
          </div>
        </TabsContent>
      </Tabs>
    </div>
  );
};

export default Toolbar;
