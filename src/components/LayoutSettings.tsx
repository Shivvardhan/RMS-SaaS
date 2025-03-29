
import { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useLayoutStore } from '@/store/layoutStore';

const LayoutSettings = () => {
  const { gridSize, cellSize, setGridSize, setCellSize } = useLayoutStore();
  const [width, setWidth] = useState(gridSize.width);
  const [height, setHeight] = useState(gridSize.height);
  const [cell, setCell] = useState(cellSize);

  const handleSave = () => {
    setGridSize({ width, height });
    setCellSize(cell);
  };

  return (
    <div className="bg-white p-4 border border-gray-200 rounded-lg">
      <h3 className="font-medium text-lg mb-4">Layout Settings</h3>
      
      <div className="space-y-4">
        <div className="grid grid-cols-2 gap-4">
          <div>
            <Label htmlFor="grid-width">Grid Width</Label>
            <Input
              id="grid-width"
              type="number"
              min={5}
              max={50}
              value={width}
              onChange={(e) => setWidth(Number(e.target.value))}
            />
          </div>
          <div>
            <Label htmlFor="grid-height">Grid Height</Label>
            <Input
              id="grid-height"
              type="number"
              min={5}
              max={50}
              value={height}
              onChange={(e) => setHeight(Number(e.target.value))}
            />
          </div>
        </div>
        
        <div>
          <Label htmlFor="cell-size">Cell Size (px)</Label>
          <Input
            id="cell-size"
            type="number"
            min={20}
            max={100}
            step={5}
            value={cell}
            onChange={(e) => setCell(Number(e.target.value))}
          />
        </div>
        
        <Button onClick={handleSave}>Apply Settings</Button>
      </div>
    </div>
  );
};

export default LayoutSettings;
