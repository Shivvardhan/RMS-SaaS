
import { useDrag } from 'react-dnd';
import { ShelfType, Product, ProductCategory } from '@/store/layoutStore';

interface DraggableItemProps {
  id?: string;
  type: 'shelf' | 'aisle' | 'product';
  shelfType?: ShelfType;
  product?: Product;
  width: number;
  height: number;
  isDragging?: boolean;
  isPlaced?: boolean;
}

const DraggableItem = ({
  id,
  type,
  shelfType = 'standard',
  product,
  width,
  height,
  isPlaced = false,
}: DraggableItemProps) => {
  console.log('Rendering DraggableItem:', { id, type, product });
  
  try {
    const [{ isDragging }, drag] = useDrag(() => ({
      type: 'LAYOUT_ITEM',
      item: { 
        id, 
        type, 
        shelfType, 
        width, 
        height,
        // If it's a product, include the product data
        ...(type === 'product' && product ? { product } : {})
      },
      collect: (monitor) => ({
        isDragging: !!monitor.isDragging(),
      }),
    }));

    const getShelfColor = (shelfType: ShelfType) => {
      const shelfColors: Record<ShelfType, string> = {
        standard: 'bg-amber-200',
        wide: 'bg-amber-300',
        endcap: 'bg-amber-400',
        island: 'bg-amber-500',
      };
      
      return shelfColors[shelfType];
    };

    const getProductColor = (category?: ProductCategory) => {
      if (!category) return 'bg-gray-300';
      
      const categoryColors: Record<ProductCategory, string> = {
        food: 'bg-green-300',
        beverage: 'bg-blue-300',
        electronics: 'bg-purple-300',
        clothing: 'bg-pink-300',
        household: 'bg-yellow-300',
        other: 'bg-gray-300',
      };
      
      return categoryColors[category];
    };

    const getShelfLabel = (shelfType: ShelfType) => {
      const labels: Record<ShelfType, string> = {
        standard: 'Std',
        wide: 'Wide',
        endcap: 'End',
        island: 'Isle',
      };
      return labels[shelfType];
    };

    return (
      <div
        ref={drag}
        className={`
          ${type === 'shelf' ? getShelfColor(shelfType) : ''}
          ${type === 'product' && product ? getProductColor(product.category) : ''}
          ${type === 'aisle' ? 'bg-gray-200 border-dashed' : 'border-solid'}
          ${isDragging ? 'opacity-50' : 'opacity-100'}
          border-2 border-gray-400 rounded cursor-move flex items-center justify-center
          transition-all duration-200 select-none
        `}
        style={{
          width: `${width * 40}px`,
          height: `${height * 40}px`,
          opacity: isDragging ? 0.5 : 1,
        }}
      >
        <div className="text-xs font-bold text-gray-700 flex flex-col items-center">
          {type === 'shelf' && getShelfLabel(shelfType)}
          {type === 'product' && product && (
            <>
              <span className="truncate w-full text-center">{product.name}</span>
              <span className="text-xs">${product.price}</span>
            </>
          )}
          {isPlaced && id?.substring(0, 4)}
        </div>
      </div>
    );
  } catch (error) {
    console.error('Error in DraggableItem:', error);
    
    // Fallback UI when there's an error
    return (
      <div
        className="bg-red-100 border-2 border-red-400 rounded flex items-center justify-center"
        style={{
          width: `${width * 40}px`,
          height: `${height * 40}px`,
        }}
      >
        <div className="text-xs font-bold text-red-700">Error</div>
      </div>
    );
  }
};

export default DraggableItem;
