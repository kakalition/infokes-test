import "react-contexify/dist/ReactContexify.css";

import {DndContext} from '@dnd-kit/core';
import Draggable from './dnd/draggable';
import IconFolder from './icons/folder';
import Droppable from './dnd/droppable';
import * as EventEmitter from "../event_emitter.js";

export default function FileTiles({onDragEnd, rightPaneFiles, onItemDoubleClicked, onContextMenu}) {
  function getFileExtension(filename) {
    return filename.split('.').pop(); 
  }

  function onDoubleClick(item) {
    onItemDoubleClicked(item);
    EventEmitter.emitter.emit(EventEmitter.ON_FOLDER_OPEN, item.id);
  }

  return (
    <DndContext onDragEnd={onDragEnd}>
      <div className={`grid grid-cols-12 gap-4 ${rightPaneFiles.length == 0 ? "hidden" : "block"}`}>
        {rightPaneFiles.map((item) => {
          const nameElementContent = (
            <Draggable id={item.id} className='flex size-full flex-col items-center justify-between gap-2 rounded-xl border-2 border-gray-200 p-8 transition-colors hover:bg-gray-100'>
              <div className="flex size-32 items-center justify-center rounded-xl border-2 border-gray-200">
                {item.type == "FOLDER" ? <IconFolder className="size-16" /> : <p className="text-center text-4xl">{getFileExtension(item.name)}</p>} 
              </div>
              <div className="h-8">
                <p>{item.name}</p>
              </div>
            </Draggable>
          )

          const nameElement = item.type == "FILE"
            ? nameElementContent
            : <Droppable id={item.id} className="size-full">
              {nameElementContent}
            </Droppable>

          return (
            <div key={item.id} 
              className="col-span-2 aspect-[1/1.2]" 
              onContextMenu={(e) => onContextMenu({event: e, props: item})} 
              onDoubleClick={() => onDoubleClick(item)}>
              {nameElement}
            </div>
          );
        })}
      </div>
      {rightPaneFiles.length == 0 ? <div className="flex h-1/2 w-full items-center justify-center">No Data to Display!</div> : null}
    </DndContext>
  )
}