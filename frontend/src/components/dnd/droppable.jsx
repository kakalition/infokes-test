import {useDroppable} from '@dnd-kit/core';

function Droppable({id, className, children}) {
  const {isOver, setNodeRef} = useDroppable({
    id,
  });

  return (
    <div className={`${isOver ? "rounded-md border-2 border-dotted border-gray-400" : ""} ${className}`} ref={setNodeRef}>
      {children}
    </div>
  );
}

export default Droppable;