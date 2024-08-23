import {useDraggable} from '@dnd-kit/core';
import {CSS} from '@dnd-kit/utilities';

function Draggable({id, className, children}) {
  const {attributes, listeners, setNodeRef, transform} = useDraggable({
    id,
  });

  const style = transform ? {
    transform: CSS.Translate.toString(transform),
  } : undefined;
  
  return (
    <button className={className} ref={setNodeRef} style={style} {...listeners} {...attributes}>
      {children}
    </button>
  );
}

export default Draggable;