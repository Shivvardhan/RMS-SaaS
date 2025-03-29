
import { useDrop } from 'react-dnd';
import { useLayoutStore, LayoutItem } from '@/store/layoutStore';
import { useToast } from "@/hooks/use-toast";

interface GridCellProps {
  x: number;
  y: number;
  item?: LayoutItem;
}

const GridCell = ({ x, y, item }: GridCellProps) => {
  const { addItem, updateItem, assignProductToShelf } = useLayoutStore();
  const cellSize = useLayoutStore((state) => state.cellSize);
  const { toast } = useToast();

  console.log(`Rendering GridCell at (${x},${y})`, item);

  try {
    const [{ isOver, canDrop }, drop] = useDrop(() => ({
      accept: 'LAYOUT_ITEM',
      drop: (droppedItem: any) => {
        console.log('Item dropped:', droppedItem, 'at position:', { x, y });
        
        // Handle dropping a product onto a shelf
        if (droppedItem.type === 'product' && droppedItem.product && item?.id && item.type === 'shelf') {
          console.log('Assigning product to shelf:', droppedItem.product.id, 'to shelf:', item.id);
          assignProductToShelf(droppedItem.product.id, item.id);
          toast({
            title: "Product added",
            description: `${droppedItem.product.name} added to shelf`
          });
          return { x, y, target: 'shelf' };
        } 
        // Handle dropping an item (shelf/aisle) that's already placed (has an ID)
        else if (droppedItem.id && droppedItem.type !== 'product') {
          console.log('Moving existing item:', droppedItem.id, 'to:', { x, y });
          updateItem(droppedItem.id, { x, y });
          return { x, y, target: 'grid' };
        } 
        // Handle dropping a new item (doesn't have an ID)
        else if (droppedItem.type !== 'product') {
          console.log('Adding new item at:', { x, y });
          addItem({ 
            type: droppedItem.type, 
            shelfType: droppedItem.shelfType, 
            x, 
            y, 
            width: droppedItem.width, 
            height: droppedItem.height 
          });
          return { x, y, target: 'grid' };
        }
        
        return { x, y, target: 'unknown' };
      },
      canDrop: (droppedItem: any) => {
        // Allow dropping products only on shelves
        if (droppedItem.type === 'product') {
          return item?.type === 'shelf';
        }
        // For other items, check if the cell is empty
        return !item;
      },
      collect: (monitor) => ({
        isOver: !!monitor.isOver(),
        canDrop: !!monitor.canDrop(),
      }),
    }), [x, y, item, assignProductToShelf]);

    return (
      <div
        ref={drop}
        className={`
          border border-gray-200 
          ${isOver && canDrop ? 'bg-blue-100' : 'bg-transparent'}
          ${isOver && !canDrop ? 'bg-red-100' : ''}
          ${item?.type === 'shelf' ? 'cursor-pointer' : ''}
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
