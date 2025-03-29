
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { ZoneType } from '@/store/layoutStore';

const ZoneManager = () => {
  const zones: { id: ZoneType; name: string }[] = [
    { id: 'grocery', name: 'Grocery' },
    { id: 'frozen', name: 'Frozen' },
    { id: 'bakery', name: 'Bakery' },
    { id: 'produce', name: 'Produce' },
    { id: 'electronics', name: 'Electronics' },
    { id: 'clothing', name: 'Clothing' },
  ];

  return (
    <Card className="bg-white">
      <CardHeader className="pb-2">
        <CardTitle className="text-lg">Zones</CardTitle>
      </CardHeader>
      <CardContent>
        <div className="flex flex-wrap gap-2">
          {zones.map((zone) => (
            <Badge
              key={zone.id}
              className={`bg-zone-${zone.id} text-white hover:bg-zone-${zone.id}/80`}
            >
              {zone.name}
            </Badge>
          ))}
        </div>
      </CardContent>
    </Card>
  );
};

export default ZoneManager;
