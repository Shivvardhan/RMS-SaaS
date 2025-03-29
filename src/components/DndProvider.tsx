
import { ReactNode } from 'react';
import { DndProvider as ReactDndProvider } from 'react-dnd';
import { HTML5Backend } from 'react-dnd-html5-backend';

interface DndProviderProps {
  children: ReactNode;
}

const DndProvider = ({ children }: DndProviderProps) => {
  return <ReactDndProvider backend={HTML5Backend}>{children}</ReactDndProvider>;
};

export default DndProvider;
