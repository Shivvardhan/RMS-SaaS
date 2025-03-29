
import React from 'react';
import DndProvider from '@/components/DndProvider';
import Header from '@/components/Header';
import GridLayout from '@/components/GridLayout';
import Toolbar from '@/components/Toolbar';
import LayoutSettings from '@/components/LayoutSettings';
import ProductManager from '@/components/ProductManager';
import LayoutStats from '@/components/LayoutStats';
import HelpDialog from '@/components/HelpDialog';

const Index = () => {
  return (
    <DndProvider>
      <div className="min-h-screen bg-slate-100">
        <Header />
        
        <main className="container mx-auto px-4 py-6">
          <div className="grid grid-cols-1 lg:grid-cols-4 gap-6">
            {/* Left Sidebar */}
            <div className="lg:col-span-1 space-y-6">
              <div className="flex items-center justify-between">
                <h2 className="text-xl font-bold">Toolbar</h2>
                <HelpDialog />
              </div>
              <Toolbar />
              <ProductManager />
              <LayoutStats />
            </div>
            
            {/* Main Grid Area */}
            <div className="lg:col-span-2 space-y-6">
              <h2 className="text-xl font-bold">Store Layout</h2>
              <div className="bg-white p-4 rounded-lg shadow-sm min-h-[600px] overflow-auto">
                <GridLayout />
              </div>
            </div>
            
            {/* Right Sidebar */}
            <div className="lg:col-span-1 space-y-6">
              <h2 className="text-xl font-bold">Settings</h2>
              <LayoutSettings />
            </div>
          </div>
        </main>
      </div>
    </DndProvider>
  );
};

export default Index;
