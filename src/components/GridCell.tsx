
import { useDrop } from 'react-dnd';
import { useLayoutStore, LayoutItem } from '@/store/layoutStore';

interface GridCellProps {
  x: number;
  y: number;
  item?: LayoutItem;
}

const GridCell = ({ x, y, item }: GridCellProps) => {
  const { addItem, updateItem } = useLayoutStore();
  const cellSize = useLayoutStore((state) => state.cellSize);

  console.log(`Rendering GridCell at (${x},${y})`);

  try {
    const [{ isOver, canDrop }, drop] = useDrop(() => ({
      accept: 'LAYOUT_ITEM',
      drop: (droppedItem: Omit<LayoutItem, 'id'> & { id?: string }) => {
        console.log('Item dropped:', droppedItem, 'at position:', { x, y });
        if (droppedItem.id) {
          // If item has ID, it's being moved
          updateItem(droppedItem.id, { x, y });
        } else {
          // If it doesn't have ID, it's new
          addItem({ ...droppedItem, x, y });
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
