
import { create } from 'zustand';
import { persist } from 'zustand/middleware';

export type ZoneType = 'grocery' | 'frozen' | 'bakery' | 'produce' | 'electronics' | 'clothing';

export type ShelfType = 'standard' | 'wide' | 'endcap' | 'island';

export interface LayoutItem {
  id: string;
  type: 'shelf' | 'aisle';
  shelfType?: ShelfType;
  zone?: ZoneType;
  x: number;
  y: number;
  width: number;
  height: number;
}

interface LayoutState {
  items: LayoutItem[];
  gridSize: { width: number; height: number };
  cellSize: number;
  addItem: (item: Omit<LayoutItem, 'id'>) => void;
  updateItem: (id: string, updates: Partial<Omit<LayoutItem, 'id'>>) => void;
  removeItem: (id: string) => void;
  setGridSize: (size: { width: number; height: number }) => void;
  setCellSize: (size: number) => void;
}

export const useLayoutStore = create<LayoutState>()(
  persist(
    (set) => ({
      items: [],
      gridSize: { width: 20, height: 15 },
      cellSize: 40,
      addItem: (item) =>
        set((state) => ({
          items: [...state.items, { ...item, id: crypto.randomUUID() }],
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
      setGridSize: (size) => set({ gridSize: size }),
      setCellSize: (size) => set({ cellSize: size }),
    }),
    {
      name: 'layout-storage',
    }
  )
);
