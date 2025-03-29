
import { useState } from 'react';
import { Button } from '@/components/ui/button';
import { Dialog, DialogContent, DialogHeader, DialogTitle, DialogTrigger } from '@/components/ui/dialog';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useLayoutStore, LayoutItem, ShelfType } from '@/store/layoutStore';

interface ItemEditorProps {
  item: LayoutItem;
}

const ItemEditor = ({ item }: ItemEditorProps) => {
  const { updateItem, removeItem } = useLayoutStore();
  const [open, setOpen] = useState(false);
  const [editedItem, setEditedItem] = useState<LayoutItem>(item);

  const handleSave = () => {
    updateItem(item.id, {
      shelfType: editedItem.shelfType,
      width: editedItem.width,
      height: editedItem.height
    });
    setOpen(false);
  };

  const handleRemove = () => {
    removeItem(item.id);
    setOpen(false);
  };

  return (
    <Dialog open={open} onOpenChange={setOpen}>
      <DialogTrigger asChild>
        <Button variant="outline" size="sm">Edit</Button>
      </DialogTrigger>
      <DialogContent className="sm:max-w-[425px]">
        <DialogHeader>
          <DialogTitle>Edit {item.type}</DialogTitle>
        </DialogHeader>
        
        <div className="grid gap-4 py-4">
          <div className="grid grid-cols-2 gap-4">
            <div>
              <Label htmlFor="width">Width</Label>
              <Input
                id="width"
                type="number"
                min={1}
                max={10}
                value={editedItem.width}
                onChange={(e) => setEditedItem({...editedItem, width: Number(e.target.value)})}
              />
            </div>
            <div>
              <Label htmlFor="height">Height</Label>
              <Input
                id="height"
                type="number"
                min={1}
                max={10}
                value={editedItem.height}
                onChange={(e) => setEditedItem({...editedItem, height: Number(e.target.value)})}
              />
            </div>
          </div>
          
          {item.type === 'shelf' && (
            <div>
              <Label htmlFor="shelf-type">Shelf Type</Label>
              <Select 
                value={editedItem.shelfType} 
                onValueChange={(value) => setEditedItem({...editedItem, shelfType: value as ShelfType})}
              >
                <SelectTrigger id="shelf-type">
                  <SelectValue placeholder="Select shelf type" />
                </SelectTrigger>
                <SelectContent>
                  <SelectItem value="standard">Standard</SelectItem>
                  <SelectItem value="wide">Wide</SelectItem>
                  <SelectItem value="endcap">End Cap</SelectItem>
                  <SelectItem value="island">Island</SelectItem>
                </SelectContent>
              </Select>
            </div>
          )}
        </div>
        
        <div className="flex justify-between">
          <Button variant="destructive" onClick={handleRemove}>Remove</Button>
          <Button onClick={handleSave}>Save Changes</Button>
        </div>
      </DialogContent>
    </Dialog>
  );
};

export default ItemEditor;
