
import { ReactNode } from 'react';
import { DndProvider as ReactDndProvider } from 'react-dnd';
import { HTML5Backend } from 'react-dnd-html5-backend';

interface DndProviderProps {
  children: ReactNode;
}

const DndProvider = ({ children }: DndProviderProps) => {
  // Using console.log to verify the provider is being rendered
  console.log('DndProvider rendering with HTML5Backend');
  
  return (
    <ReactDndProvider backend={HTML5Backend}>
      {children}
    </ReactDndProvider>
  );
};

export default DndProvider;
