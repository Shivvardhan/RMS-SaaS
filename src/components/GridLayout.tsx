
import { useLayoutStore, LayoutItem } from '@/store/layoutStore';
import GridCell from './GridCell';
import DraggableItem from './DraggableItem';

const GridLayout = () => {
  const { gridSize, cellSize, items } = useLayoutStore();
  
  // Create a 2D grid representation to help with rendering
  const grid = Array.from({ length: gridSize.height }, () =>
    Array.from({ length: gridSize.width }, () => null)
  );

  // Place items on the grid
  const itemPositions = new Map<string, { x: number; y: number }>();
  
  items.forEach((item) => {
    itemPositions.set(item.id, { x: item.x, y: item.y });
    
    // Mark cells as occupied
    for (let y = item.y; y < item.y + item.height; y++) {
      for (let x = item.x; x < item.x + item.width; x++) {
        if (y < gridSize.height && x < gridSize.width) {
          grid[y][x] = item.id;
        }
      }
    }
  });

  return (
    <div className="relative bg-gray-50 border border-gray-300 rounded-lg overflow-auto">
      <div
        className="grid"
        style={{
          display: 'grid',
          gridTemplateColumns: `repeat(${gridSize.width}, ${cellSize}px)`,
          gridTemplateRows: `repeat(${gridSize.height}, ${cellSize}px)`,
        }}
      >
        {/* Render grid cells */}
        {grid.flatMap((row, y) =>
          row.map((cellItemId, x) => (
            <GridCell key={`cell-${x}-${y}`} x={x} y={y} />
          ))
        )}
      </div>

      {/* Render items on top of the grid */}
      <div className="absolute top-0 left-0 pointer-events-none">
        {items.map((item) => (
          <div
            key={item.id}
            className="absolute pointer-events-auto"
            style={{
              left: `${item.x * cellSize}px`,
              top: `${item.y * cellSize}px`,
            }}
          >
            <DraggableItem
              id={item.id}
              type={item.type}
              shelfType={item.shelfType}
              zone={item.zone}
              width={item.width}
              height={item.height}
              isPlaced={true}
            />
          </div>
        ))}
      </div>
    </div>
  );
};

export default GridLayout;
