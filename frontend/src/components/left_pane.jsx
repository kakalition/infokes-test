import { useMemo, useState } from 'react';

import "react-contexify/dist/ReactContexify.css";
import IconChevronRight from './icons/chevron_right.jsx';
import IconChevronDown from './icons/chevron_down.jsx';
import FileHandler from '../file_handler.js';

export default function LeftPane({data, onBackgroundContextMenu, onItemContextMenu, rightPaneId, onRightPaneIdChange}) {
  const fileHandler = new FileHandler();

  function leftPaneElementMapper(level, folders) {
    const elements = [];
    folders.forEach((folder) => {
      const children = leftPaneElementMapper(level + 1, folder.children);
      elements.push(
        <LeftPaneItem key={folder.id} 
          folder={folder} 
          level={level} 
          onItemContextMenu={onItemContextMenu} 
          onRightPaneIdChange={onRightPaneIdChange} 
          rightPaneId={rightPaneId}
        >
          {children}
        </LeftPaneItem>
      )
    });

    return elements;
  }

  const folderStructures = useMemo(() => { return fileHandler.createFolderStructure(data, null); }, [data]) 
  const leftPaneElements = useMemo(() => { return leftPaneElementMapper(1, folderStructures) }, [rightPaneId, folderStructures]) ;

  return <div className='flex h-full w-96 select-none flex-col overflow-y-scroll border-r-2 border-r-gray-200  p-2' 
    onContextMenu={(e) => onBackgroundContextMenu({event: e, props: {id: null}})}
    onDoubleClick={() => onRightPaneIdChange(null)}
  >
    {leftPaneElements}
  </div>
}

function LeftPaneItem({folder, level, rightPaneId, onRightPaneIdChange, onItemContextMenu, children}) {
  const [hide, setHide] = useState(true)

  return (<div>
    <div style={{ paddingLeft: `${level * 12}px` }}
      className={`flex cursor-pointer flex-row gap-2 rounded-xl ${rightPaneId == folder.id ? "bg-gray-200" : "bg-gray-50"} p-2 transition hover:bg-gray-200`}
      onClick={() => onRightPaneIdChange(folder.id)}
      onContextMenu={(e) => onItemContextMenu({ event: e, props: folder })}
    >
      <button type='button' 
        className='flex items-center justify-center rounded-full p-1 transition hover:bg-gray-300'
        onClick={() => setHide(!hide)}
      >
        {hide ? <IconChevronRight className="size-5 stroke-gray-500 stroke-[3px]" /> : <IconChevronDown className="size-5 stroke-gray-500 stroke-[3px]" />}
      </button>
      <p>{folder.name}</p>
    </div>
    <div className={`${hide ? 'hidden' : ''}`}>
      {children}
    </div>
  </div>
  )
}