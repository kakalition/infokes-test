import { useMemo } from 'react';
import { BreadcrumbItem, Breadcrumbs} from '@nextui-org/react';

import "react-contexify/dist/ReactContexify.css";


export default function CustomBreadcrumbs({data, rightPaneId, onRightPaneIdChange}) {
  const breadcrumbItems = useMemo(() => { 
    const items = [];

    let tempId = rightPaneId;
    while (tempId != undefined) {
      const target = data.filter((e) => e.id == tempId)[0];
      items.push(target);
      tempId = target?.parent_id;
    }

    return items.reverse();
  }, [data, rightPaneId]);

  return (
    <Breadcrumbs className='px-4'>
      <BreadcrumbItem onPress={() => onRightPaneIdChange(null)}>Root</BreadcrumbItem>
      {breadcrumbItems.map((e) => {
        return (<BreadcrumbItem key={e.id} onPress={() => onRightPaneIdChange(e.id)}>{e.name}</BreadcrumbItem>)
      })}
    
    </Breadcrumbs>
  )
}