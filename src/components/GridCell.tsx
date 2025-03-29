
import { useDrop } from 'react-dnd';
import { useLayoutStore, LayoutItem, Product } from '@/store/layoutStore';

interface GridCellProps {
  x: number;
  y: number;
  item?: LayoutItem;
}

const GridCell = ({ x, y, item }: GridCellProps) => {
  const { addItem, updateItem, assignProductToShelf } = useLayoutStore();
  const cellSize = useLayoutStore((state) => state.cellSize);

  console.log(`Rendering GridCell at (${x},${y})`);

  try {
    const [{ isOver, canDrop }, drop] = useDrop(() => ({
      accept: 'LAYOUT_ITEM',
      drop: (droppedItem: any) => {
        console.log('Item dropped:', droppedItem, 'at position:', { x, y });
        
        if (droppedItem.type === 'product' && item?.id) {
          // If it's a product being dropped on a shelf
          assignProductToShelf(droppedItem.id, item.id);
        } else if (droppedItem.id && droppedItem.type !== 'product') {
          // If item has ID, it's being moved (and it's not a product)
          updateItem(droppedItem.id, { x, y });
        } else if (droppedItem.type !== 'product') {
          // If it doesn't have ID, it's new (and it's not a product)
          addItem({ 
            type: droppedItem.type, 
            shelfType: droppedItem.shelfType, 
            x, 
            y, 
            width: droppedItem.width, 
            height: droppedItem.height 
          });
        }
        return { x, y };
      },
      collect: (monitor) => ({
        isOver: !!monitor.isOver(),
        canDrop: !!monitor.canDrop(),
      }),
    }));

    return (
      <div
        ref={drop}
        className={`
          border border-gray-200 
          ${isOver && canDrop ? 'bg-blue-100' : 'bg-transparent'}
          ${isOver && !canDrop ? 'bg-red-100' : ''}
        `}
        style={{
          width: `${cellSize}px`,
          height: `${cellSize}px`,
        }}
      />
    );
  } catch (error) {
    console.error('Error in GridCell:', error);
    // Return a fallback UI when an error occurs
    return (
      <div
        className="border border-gray-200 bg-red-50"
        style={{
          width: `${cellSize}px`,
          height: `${cellSize}px`,
        }}
      />
    );
  }
};

export default GridCell;
