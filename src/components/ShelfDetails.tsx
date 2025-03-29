
import { LayoutItem } from '@/store/layoutStore';
import { useLayoutStore } from '@/store/layoutStore';
import { useToast } from "@/hooks/use-toast";

interface ShelfDetailsProps {
  item: LayoutItem;
  cellSize: number;
}

const ShelfDetails = ({ item, cellSize }: ShelfDetailsProps) => {
  const { removeProductFromShelf } = useLayoutStore();
  const { toast } = useToast();

  // Guard clause to ensure item.products exists
  if (!item.products || !Array.isArray(item.products)) {
    console.log("No products on this shelf or invalid products array");
    return null;
  }

  const handleRemoveProduct = (productId: string, productName: string) => {
    removeProductFromShelf(productId, item.id);
    toast({
      title: "Product removed",
      description: `${productName} removed from shelf`
    });
  };

  // Calculate how many products can fit in the shelf
  const maxProductsPerRow = Math.floor(item.width * 2);
  const maxRows = Math.floor(item.height * 2);
  const maxProducts = maxProductsPerRow * maxRows;

  return (
    <div 
      className="absolute inset-0 grid gap-1 p-1 overflow-hidden"
      style={{
        gridTemplateColumns: `repeat(${maxProductsPerRow}, 1fr)`,
        gridTemplateRows: `repeat(${maxRows}, 1fr)`,
      }}
    >
      {item.products.slice(0, maxProducts).map((product, index) => (
        <div 
          key={`${item.id}-product-${product.id}`}
          className={`bg-white rounded-sm flex flex-col justify-center items-center overflow-hidden text-[8px] cursor-pointer border border-gray-300 hover:bg-gray-100`}
          onClick={() => handleRemoveProduct(product.id, product.name)}
          title={`${product.name} - $${product.price} (Click to remove)`}
        >
          <div 
            className={`w-full h-1 mb-[2px]`}
            style={{
              backgroundColor: product.category === 'food' ? '#86efac' : 
                              product.category === 'beverage' ? '#93c5fd' :
                              product.category === 'electronics' ? '#d8b4fe' :
                              product.category === 'clothing' ? '#f9a8d4' :
                              product.category === 'household' ? '#fde047' : '#d1d5db'
            }}
          />
          <div className="truncate w-full text-center">{product.name}</div>
        </div>
      ))}
      {item.products.length > maxProducts && (
        <div className="absolute bottom-0 right-0 bg-white rounded-sm text-[8px] px-1 border border-gray-300">
          +{item.products.length - maxProducts} more
        </div>
      )}
    </div>
  );
};

export default ShelfDetails;
