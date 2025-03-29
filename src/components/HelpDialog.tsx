
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { HelpCircle } from 'lucide-react';

const HelpDialog = () => {
  return (
    <Dialog>
      <DialogTrigger asChild>
        <Button variant="ghost" size="icon">
          <HelpCircle className="h-5 w-5" />
        </Button>
      </DialogTrigger>
      <DialogContent className="sm:max-w-[600px]">
        <DialogHeader>
          <DialogTitle>Layout Builder Help</DialogTitle>
        </DialogHeader>
        <div className="space-y-4 text-sm">
          <div>
            <h3 className="font-bold mb-1">Getting Started</h3>
            <p>This application allows you to create a 2D layout for retail stores. You can place shelves and aisles on a grid to design your store layout.</p>
          </div>
          
          <div>
            <h3 className="font-bold mb-1">Drag and Drop</h3>
            <p>Drag shelf and aisle items from the toolbar on the left and drop them onto the grid. You can also drag items already on the grid to reposition them.</p>
          </div>
          
          <div>
            <h3 className="font-bold mb-1">Zones</h3>
            <p>Zones represent different areas of your store, like Grocery, Frozen, etc. Select a zone before dragging items to assign them to that zone.</p>
          </div>
          
          <div>
            <h3 className="font-bold mb-1">Editing Items</h3>
            <p>Click on any item on the grid to edit its properties, including size, zone, and type.</p>
          </div>
          
          <div>
            <h3 className="font-bold mb-1">Saving</h3>
            <p>Your layout is automatically saved to your browser's local storage. You can also export your layout as a JSON file.</p>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  );
};

export default HelpDialog;
