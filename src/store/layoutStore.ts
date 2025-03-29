
import { create } from 'zustand';
import { persist } from 'zustand/middleware';

export type ProductCategory = 'food' | 'beverage' | 'electronics' | 'clothing' | 'household' | 'other';

export type ShelfType = 'standard' | 'wide' | 'endcap' | 'island';

export interface Product {
  id: string;
  name: string;
  category: ProductCategory;
  price: number;
  stock: number;
}

export interface LayoutItem {
  id: string;
  type: 'shelf' | 'aisle';
  shelfType?: ShelfType;
  x: number;
  y: number;
  width: number;
  height: number;
  products: Product[];
}

interface LayoutState {
  items: LayoutItem[];
  gridSize: { width: number; height: number };
  cellSize: number;
  products: Product[];
  addItem: (item: Omit<LayoutItem, 'id' | 'products'>) => void;
  updateItem: (id: string, updates: Partial<Omit<LayoutItem, 'id'>>) => void;
  removeItem: (id: string) => void;
  addProduct: (product: Omit<Product, 'id'>) => void;
  removeProduct: (id: string) => void;
  assignProductToShelf: (productId: string, shelfId: string) => void;
  removeProductFromShelf: (productId: string, shelfId: string) => void;
  setGridSize: (size: { width: number; height: number }) => void;
  setCellSize: (size: number) => void;
}

export const useLayoutStore = create<LayoutState>()(
  persist(
    (set) => ({
      items: [],
      gridSize: { width: 20, height: 15 },
      cellSize: 40,
      products: [],
      addItem: (item) =>
        set((state) => ({
          items: [...state.items, { ...item, id: crypto.randomUUID(), products: [] }],
        })),
      updateItem: (id, updates) =>
        set((state) => ({
          items: state.items.map((item) =>
            item.id === id ? { ...item, ...updates } : item
          ),
        })),
      removeItem: (id) =>
        set((state) => ({
          items: state.items.filter((item) => item.id !== id),
        })),
      addProduct: (product) =>
        set((state) => ({
          products: [...state.products, { ...product, id: crypto.randomUUID() }],
        })),
      removeProduct: (id) =>
        set((state) => ({
          products: state.products.filter((product) => product.id !== id),
          items: state.items.map((item) => ({
            ...item,
            products: item.products.filter((product) => product.id !== id),
          })),
        })),
      assignProductToShelf: (productId, shelfId) =>
        set((state) => {
          const product = state.products.find((p) => p.id === productId);
          if (!product) return state;
          
          return {
            items: state.items.map((item) =>
              item.id === shelfId
                ? { ...item, products: [...item.products, product] }
                : item
            ),
          };
        }),
      removeProductFromShelf: (productId, shelfId) =>
        set((state) => ({
          items: state.items.map((item) =>
            item.id === shelfId
              ? { ...item, products: item.products.filter((p) => p.id !== productId) }
              : item
          ),
        })),
      setGridSize: (size) => set({ gridSize: size }),
      setCellSize: (size) => set({ cellSize: size }),
    }),
    {
      name: 'layout-storage',
    }
  )
);
