
import { Badge } from '@/components/ui/badge';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';

const ZoneManager = () => {
  const categories = [
    { id: 'food', name: 'Food' },
    { id: 'beverage', name: 'Beverage' },
    { id: 'electronics', name: 'Electronics' },
    { id: 'clothing', name: 'Clothing' },
    { id: 'household', name: 'Household' },
    { id: 'other', name: 'Other' },
  ];

  return (
    <Card className="bg-white">
      <CardHeader className="pb-2">
        <CardTitle className="text-lg">Product Categories</CardTitle>
      </CardHeader>
      <CardContent>
        <div className="flex flex-wrap gap-2">
          {categories.map((category) => (
            <Badge
              key={category.id}
              variant="outline"
              className={`
                ${category.id === 'food' ? 'bg-green-100 hover:bg-green-200' : ''}
                ${category.id === 'beverage' ? 'bg-blue-100 hover:bg-blue-200' : ''}
                ${category.id === 'electronics' ? 'bg-purple-100 hover:bg-purple-200' : ''}
                ${category.id === 'clothing' ? 'bg-pink-100 hover:bg-pink-200' : ''}
                ${category.id === 'household' ? 'bg-yellow-100 hover:bg-yellow-200' : ''}
                ${category.id === 'other' ? 'bg-gray-100 hover:bg-gray-200' : ''}
              `}
            >
              {category.name}
            </Badge>
          ))}
        </div>
      </CardContent>
    </Card>
  );
};

export default ZoneManager;
