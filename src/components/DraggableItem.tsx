
import { useDrag } from 'react-dnd';
import { LayoutItem, ShelfType, ZoneType } from '@/store/layoutStore';

interface DraggableItemProps {
  id?: string;
  type: 'shelf' | 'aisle';
  shelfType?: ShelfType;
  zone?: ZoneType;
  width: number;
  height: number;
  isDragging?: boolean;
  isPlaced?: boolean;
}

const DraggableItem = ({
  id,
  type,
  shelfType = 'standard',
  zone,
  width,
  height,
  isPlaced = false,
}: DraggableItemProps) => {
  const [{ isDragging }, drag] = useDrag(() => ({
    type: 'LAYOUT_ITEM',
    item: { id, type, shelfType, zone, width, height },
    collect: (monitor) => ({
      isDragging: !!monitor.isDragging(),
    }),
  }));

  const getZoneColor = (zone?: ZoneType) => {
    if (!zone) return 'bg-gray-300';
    
    const zoneColors: Record<ZoneType, string> = {
      grocery: 'bg-zone-grocery',
      frozen: 'bg-zone-frozen',
      bakery: 'bg-zone-bakery',
      produce: 'bg-zone-produce',
      electronics: 'bg-zone-electronics',
      clothing: 'bg-zone-clothing',
    };
    
    return zoneColors[zone];
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
        ${getZoneColor(zone)} 
        ${isDragging ? 'opacity-50' : 'opacity-100'}
        ${type === 'aisle' ? 'border-dashed' : 'border-solid'}
        border-2 border-gray-400 rounded cursor-move flex items-center justify-center
        transition-all duration-200 select-none
      `}
      style={{
        width: `${width * 40}px`,
        height: `${height * 40}px`,
        opacity: isDragging ? 0.5 : 1,
      }}
    >
      <div className="text-xs font-bold text-gray-700">
        {type === 'shelf' && getShelfLabel(shelfType)}
        {isPlaced && id?.substring(0, 4)}
      </div>
    </div>
  );
};

export default DraggableItem;
