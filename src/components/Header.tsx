
import { Button } from '@/components/ui/button';
import { useToast } from '@/hooks/use-toast';
import { useLayoutStore } from '@/store/layoutStore';

const Header = () => {
  const { items } = useLayoutStore();
  const { toast } = useToast();
  
  const handleSave = () => {
    // In a real app, this would send data to a backend
    // For now, we just show a success toast
    toast({
      title: "Layout Saved",
      description: `Successfully saved layout with ${items.length} items.`,
    });
  };
  
  const handleExport = () => {
    const layout = {
      items: useLayoutStore.getState().items,
      gridSize: useLayoutStore.getState().gridSize,
    };
    
    const blob = new Blob([JSON.stringify(layout, null, 2)], { type: 'application/json' });
    const url = URL.createObjectURL(blob);
    
    const a = document.createElement('a');
    a.href = url;
    a.download = 'retail-layout.json';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
    URL.revokeObjectURL(url);
    
    toast({
      title: "Layout Exported",
      description: "Layout has been exported as JSON.",
    });
  };

  return (
    <header className="bg-white border-b border-gray-200 py-4">
      <div className="container mx-auto px-4 flex justify-between items-center">
        <h1 className="text-2xl font-bold text-gray-800">Retail Layout Builder</h1>
        
        <div className="flex gap-2">
          <Button variant="outline" onClick={handleExport}>
            Export Layout
          </Button>
          <Button onClick={handleSave}>
            Save Layout
          </Button>
        </div>
      </div>
    </header>
  );
};

export default Header;
